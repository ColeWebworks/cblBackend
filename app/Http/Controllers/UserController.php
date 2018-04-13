<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Exceptions\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id =  null)
    {
        $user = $request->user();
        if(isset($id)) {
            $user = User::find($id);
        }

        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'sometimes|required|confirmed|min:6'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $e = new ValidationException('There were some errors');
            $e->setErrors($errors->all());
            throw $e;
        }


        $user = $request->user();
        if(isset($id)) {
            $user = User::find($id);
        }



        if($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return response()->json(['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get list of current user's events
     */
    public function events(Request $request) {
        $user = $request->user();

        $events = $user->events;

        return response()->json(['events' => $events]);
    }

    public function roles() {
        $roles = Role::all();

        return response()->json(['roles' => $roles]);
    }

}
