<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToDoAppContrller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = DB::table('todos')->get();
        return view('toDoApp.index', ['todos' => $todos]);
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
        'content' => $request->content,
        'status' => 0,
        'created_at' => now(),
        'updated_at' => now()
    ]);

    // redirect
    return redirect('/')->with('result', 'Task added!');
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
        $todo = DB::table('todos')->where('id', $id)->first();
        return view('toDoApp.update_task', ['todo' => $todo]);
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
        'task' => $request->task,
        'content' => $request->content,
        'updated_at' => now()
    ]);

    // redirect
    return redirect('/')->with('result', 'Task updated!');
    }

    public function update_status(Request $request, string $id)
    {
    $result = DB::table('todos')->where('id', $id)->first('status');
    DB::table('todos')->where('id', $id)->update([
        'status' => $result->status == 0 ? 1 : 0,
        'updated_at' => now()
    ]);
    return redirect('/')->with('result', 'Status updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // delete the todo
    DB::table('todos')->where('id', $id)->delete();

    // redirect
    return redirect('/')->with('result', 'Task removed!');
    }
}
