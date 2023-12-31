<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Todo extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = DB::table('todos')->get();
        return view('app', ['todos' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // validate the form
    $request->validate([
        'task' => 'required|max:100'
    ]);

    // store the data
    DB::table('todos')->insert([
        'task' => $request->task,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // redirect
    return redirect('/')->with('status', 'Task added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate the form
    $request->validate([
        'task' => 'required|max:100'
    ]);

    // update the data
    DB::table('todos')->where('id', $id)->update([
        'task' => $request->task
    ]);

    // redirect
    return redirect('/')->with('status', 'Task updated!');
    }

    public function update_status(Request $request, string $id)
    {
    // update the data
    // $request->validate([
    //     'status' => 'required'
    // ]);
    // DB::table('todos')->where('id', $id)->update([
    //     'status' => $request->status
    // ]);
    return redirect('/')->with('status', 'Status updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete the todo
    DB::table('todos')->where('id', $id)->delete();

    // redirect
    return redirect('/')->with('status', 'Task removed!');
    }
}
