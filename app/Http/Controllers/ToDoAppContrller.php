<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendEmail;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TaskExport;

class ToDoAppContrller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = DB::table('todos')->get();
        return view('toDoApp.index', ['todos' => $todos]);
        // return view('toDoApp.index', compact($todos));
    }

    /**
     * Show the home page.
     */
    public function home()
    {
        return view('main');
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
        $message = [
            'type' => 'Create task',
            'task' => $request->task,
            'content' => 'đã được thêm vào trong To-do List của bạn',
        ];
        $userArray = array(
            // Every array will be converted 
            // to an object 
            array(
                "email" => "younghungold@gmail.com"
            )
        );
        SendEmail::dispatch($message, $userArray)->delay(now()->addMinute());

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
        $message = [
            'type' => 'Update task',
            'task' => $request->task,
            'content' => 'đã được thay đổi thành công',
        ];
        $userArray = array(
            // Every array will be converted 
            // to an object 
            array(
                "email" => "younghungold@gmail.com"
            )
        );
        SendEmail::dispatch($message, $userArray)->delay(now()->addMinute());

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
    public function destroy(Request $request, string $id)
    {
        // delete the todo
        DB::table('todos')->where('id', $id)->delete();

        $message = [
            'type' => 'Create task',
            'task' => $request->task,
            'content' => 'đã được xóa khỏi To-do List của bạn',
        ];
        $userArray = array(
            // Every array will be converted 
            // to an object 
            array(
                "email" => "younghungold@gmail.com"
            )
        );
        SendEmail::dispatch($message, $userArray)->delay(now()->addMinute());

        // redirect
        return redirect('/')->with('result', 'Task removed!');
    }

    /**
     * Export data to CSV file without using any package
     */
    public function exportCSV() {
        $todos = DB::table('todos')->get();
        $fileName = 'todos.csv';
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );
        $columns = array('Task', 'Content', 'Status', 'Created at', 'Updated at');

        $callback = function() use($todos, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($todos as $todo) {
                $row['Task'] = $todo->task;
                $row['Content'] = $todo->content;
                $row['Status'] = $todo->status;
                $row['Created at'] = $todo->created_at;
                $row['Updated at'] = $todo->updated_at;

                fputcsv($file, array($row['Task'], $row['Content'], $row['Status'], $row['Created at'], $row['Updated at']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export data to CSV file using Maatwebsite\Excel package
     */
    public function exportXLSX() {
        return Excel::download(new TaskExport, 'todos.xlsx');
    }
}
