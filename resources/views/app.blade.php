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
    <div class="container ms-5">
        <h2>Add new task</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="create-form" action="{{ url('/todos') }}" method="POST">
            @csrf
            <input type="text" class="form-control" name="task" placeholder="Add new task" />
            <input type="text" class="form-control mt-3" name="content"
                placeholder="Add new content (can be null)" />
            <button class="btn btn-primary mt-2" type="submit">Store</button>
        </form>
        @if (session('result'))
            <div class="alert alert-success">
                {{ session('result') }}
            </div>
        @endif
    </div>
    <hr />
    <div class="container">
        <h2>Pending tasks</h2>
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
                @include('unordered_list')
            </tbody>
        </table>
    </div>
    <hr />
    <div class="ms-3">
        <h2>Completed Tasks</h2>
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
                @foreach ($todos as $todo)
                    @if ($todo->status == 1)
                        <tr>
                            <th scope="row">{{ $todo->id }}</th>
                            <td>
                                <div class="d-flex flex-row">
                                    <p style="min-width:10%">{{ $todo->task }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-row">
                                    <p style="min-width:10%">{{ $todo->content }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="mt-2">
                                    <div class="card card-body d-flex flex-row justify-content-evenly">
                                        <a href="{{ url('todos/' . $todo->id . '/edit') }}">
                                            <button class="btn btn-primary ms-5" type="button">
                                                Edit
                                            </button>
                                        </a>
                                        <form action="{{ url('todos/' . $todo->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" onclick="deleteItem()">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script>
    function deleteItem() {
        if (confirm('Are you sure?') == true) {
            document.getElementById('deleteForm').submit();
        }
        else {
            event.preventDefault();
            return;
        }
    }
</script>

</html>
