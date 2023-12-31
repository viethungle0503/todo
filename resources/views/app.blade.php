<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
    <!-- Boostrap Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    {{-- Javascript --}}
    <script src="{{ asset('js/web.js') }}" defer></script>

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
            <button class="btn btn-primary mt-2" type="submit">Store</button>
        </form>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
    </div>
    <hr />
    <div class="container">
        <h2>Pending tasks</h2>
        <ul class="list-group">
            @foreach ($todos as $todo)
                <li class="list-group-item">
                    <div class="d-flex flex-row">
                        <p style="min-width:10%">{{ $todo->task }}</p>
                        <button class="btn btn-primary ms-5" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">
                            Edit
                        </button>
                        <div class="ms-3">
                            <form id="statusForm" action="{{ url('todos_status/' . $todo->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <input class="form-check-input mt-2" style="display: block;" type="checkbox"
                                    id="checkboxNoLabel" value="" aria-label="Nothing" name="status"
                                    checked="{{ $todo->status == 1 ? true : false }}"
                                    onchange="document.getElementById('statusForm').submit()">
                            </form>

                            {{ $todo->status ? 'Completed' : 'Pending' }}
                        </div>
                    </div>
                    <div class="collapse mt-2" id="collapse-{{ $loop->index }}">
                        <div class="card card-body d-flex flex-row justify-content-evenly">
                            <form action="{{ url('todos/' . $todo->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="text" name="task" value="{{ $todo->task }}">
                                <button class="btn btn-secondary" type="submit">Update</button>
                            </form>
                            <form action="{{ url('todos/' . $todo->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>

                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    <hr />
    <div class="ms-3">
        <h2>Completed Tasks</h2>
    </div>

</body>

</html>
