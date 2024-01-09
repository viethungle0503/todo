<?php

namespace App\Http\Controllers;

use App\Exports\TaskExport;
use App\Jobs\SendEmail;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ToDoAppContrller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('toDoApp.index', ['todos' => Task::getAll()]);
        // return view('toDoApp.index', compact($todos));
    }

    /**
     * Show the home page.
     */
    public function home(): View
    {
        return view('main');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // validate the form
        $request->validate([
            'task' => 'required|max:100',
        ]);

        // store the data
        Task::create([
            'task' => $request->task,
            'content' => $request->content,
            'status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $message = [
            'type' => 'Create task',
            'task' => $request->task,
            'content' => 'đã được thêm vào trong To-do List của bạn',
        ];
        $userArray = [
            // Every array will be converted
            // to an object
            [
                'email' => 'younghungold@gmail.com',
            ],
        ];
        SendEmail::dispatch($message, $userArray)->delay(now()->addMinute());

        // redirect
        return redirect('/')->with('result', 'Task added!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        return view('toDoApp.update_task', ['todo' => Task::query()->findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // validate the form
        $request->validate([
            'task' => 'required|max:100',
        ]);

        // update the data
        Task::where('id', $id)->update([
            'task' => $request->task,
            'content' => $request->content,
            'updated_at' => now(),
        ]);
        $message = [
            'type' => 'Update task',
            'task' => $request->task,
            'content' => 'đã được thay đổi thành công',
        ];
        $userArray = [
            // Every array will be converted
            // to an object
            [
                'email' => 'younghungold@gmail.com',
            ],
        ];
        SendEmail::dispatch($message, $userArray)->delay(now()->addMinute());

        // redirect
        return redirect('/')->with('result', 'Task updated!');
    }

    public function updateStatus(Request $request, string $id): RedirectResponse
    {
        $result = Task::query()->findOrFail($id)->first('status');
        Task::find($id)->update([
            'status' => $result->status == 0 ? 1 : 0,
            'updated_at' => now(),
        ]);

        return redirect('/')->with('result', 'Status updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id): RedirectResponse
    {
        // delete the todo
        Task::query()->findOrFail($id)->delete();

        $message = [
            'type' => 'Create task',
            'task' => $request->task,
            'content' => 'đã được xóa khỏi To-do List của bạn',
        ];
        $userArray = [
            // Every array will be converted
            // to an object
            [
                'email' => 'younghungold@gmail.com',
            ],
        ];
        SendEmail::dispatch($message, $userArray)->delay(now()->addMinute());

        // redirect
        return redirect('/')->with('result', 'Task removed!');
    }

    /**
     * Export data to CSV file without using any package
     */
    public function exportCsv(): StreamedResponse
    {
        $todos = Task::all();
        $fileName = 'todos.csv';
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];
        $columns = ['Task', 'Content', 'Status', 'Created at', 'Updated at'];

        $callback = function () use ($todos, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($todos as $todo) {
                $row['Task'] = $todo->task;
                $row['Content'] = $todo->content;
                $row['Status'] = $todo->status;
                $row['Created at'] = $todo->created_at;
                $row['Updated at'] = $todo->updated_at;

                fputcsv($file, [$row['Task'], $row['Content'], $row['Status'], $row['Created at'], $row['Updated at']]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export data to CSV file using Maatwebsite\Excel package
     */
    public function exportXlsx(): BinaryFileResponse
    {
        return Excel::download(new TaskExport(), 'todos.xlsx');
    }
}
