<?php

namespace App\Http\Controllers;

use App\Category;
use App\Event;
use App\User;
use Illuminate\Http\Request;
use Validator;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all categories, then get all events for that cat
        $cats = Category::active()->orderBy('order', 'asc')->get();
        $data = [];
        $i = 0;
        foreach($cats as $c) {
            $data[$i]['name'] = $c->name;
            $data[$i]['events'] = $c->events;
            $i++;
        }
        return response()->json(['categories' => $data]);
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
        $cats = Category::active()->orderBy('order', 'asc')->get();

        $hasCats = false;
        $hasUsers = false;

        if($request->has('category')) {
            $val = Validator::make($request->all(), [
                'category.*' => 'exists:categories,id'
            ]);
            if($val->fails()) {
                return response()->json(['status' => false, 'errors' => $val->errors()]);
            }
            $hasCats = true;
        }
        if($request->has('users')) {
            $val = Validator::make($request->all(), [
                'users.*' => 'exists:users,id'
            ]);
            if($val->fails()) {
                return response()->json(['status' => false, 'errors' => $val->errors()]);
            }
            $hasUsers = true;
        }

        $event = new Event();
        $event->name = $request->name;
        $event->user_id = $request->user()->id;
        $event->details = $request->details;
        $event->start = $request->start;
        $event->status = 1;
        $event->save();

        if($hasCats) {
            // build an array
            foreach($request->category as $c) {
                $event->categories()->attach($c);
            }
        }
        if($hasUsers) {
            // build an array
            foreach($request->users as $u) {
                $foundUser = User::find($u);
                if($foundUser) {
                    $event->staff()->attach($u, ['role_id' => $foundUser->role->id]);
                }
            }
        }

        return response()->json(['status' => true, 'event' => $event]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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

    public function postAttend(Request $request, $id) {
        $user = $request->user;
        $event = Event::findOrFail($id);
        $role = Role::where('name', 'Participant')->first();

        $event->users()->attach($user->id, ['role_id', $role->id]);

        return response()->json(['success' => true]);
    }

    public function postReject(Request $request, $id) {
        $user = $request->user;
        $event = Event::findOrFail($id);
        $role = Role::where('name', 'Participant')->first();

        $event->users()->detach($user->id, ['role_id', $role->id]);

        return response()->json(['success' => true]);
    }
}
