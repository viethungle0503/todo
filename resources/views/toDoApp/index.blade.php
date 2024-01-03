<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    {{-- Bootstrap 5 --}}
    <link href="{{ url('/css/bootstrap.min.css') }}" rel="stylesheet" />
    <script src="{{ url('/js/bootstrap.bundle.min.js') }}"></script>

    <title>To-do List</title>
</head>

<body>
    <h1 class="text-center">To-do lists</h1>
    <hr />
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="create-form" action="{{ url('/todos') }}" method="POST" class="form-horizontal">
            @csrf
            <div class="card" style="width: fit-content; margin: 0 auto">
                <h5 class="card-header">
                    New Task
                </h5>
                <div class="card-body d-flex flex-row">
                    <div style="width: fit-content">
                        <div>
                            <label class=""><b>Task</b></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="task" placeholder="Enter task..."
                                    style="min-width: 40vw" />
                            </div>
                        </div>
                        <div>
                            <label class=""><b>Content</b></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="content"
                                    placeholder="Add some new content..." style="min-width: 40vw" />
                            </div>
                        </div>
                    </div>
                    <!-- Add Task Button -->
                    <div class="d-flex align-items-center" style="width: fit-content">
                        <button type="submit" class="btn btn-success m-5">
                            <i class="fas fa-plus"></i>
                            Add Task
                        </button>
                    </div>
                </div>
            </div>
        </form>
        @if (session('result'))
            <div class="alert alert-success">
                {{ session('result') }}
            </div>
        @endif
    </div>
    <hr />
    <div class="container">
        <div class="card">
            <h5 class="card-header">
                Pending tasks
            </h5>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Button</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('toDoApp.pending_task')
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <hr />
    <div class="container">
        <div class="card">
            <h5 class="card-header">
                Completed Tasks
            </h5>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Button</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('toDoApp.completed_task')
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
<script>
    function deleteItem() {
        if (confirm('Are you sure?') == true) {
            document.getElementById('deleteForm').submit();
        } else {
            event.preventDefault();
            return;
        }
    }
</script>

</html>
