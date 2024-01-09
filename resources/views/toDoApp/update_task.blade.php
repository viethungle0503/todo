<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="mt-2 align-middle" style="position: relative; top: 50vh;">
        <div class="card card-body d-flex flex-row justify-content-evenly">
            <form action="{{ url('todos/task/' . $todo->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('PUT')
                <input type="text" name="task" value="{{ $todo->task }}">
                <input type="text" name="content" value="{{ $todo->content }}">
                <button class="btn btn-secondary" type="submit">Update</button>
            </form>
            <form action="{{ url('todos/' . $todo->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" onclick="deleteItem()">Delete</button>
            </form>
            <form id="statusForm" action="{{ url('todos/status/' . $todo->id) }}" method="POST"
                style="display: inline-block;">
                @csrf
                @method('PUT')
                <input class="form-check-input mt-2" style="display: block;" type="checkbox"
                    value="{{ $todo->status == 1 ? 1 : 0 }}" aria-label="Nothing" name="status"
                    onchange="document.getElementById('statusForm').submit()">
                {{ $todo->status == 1 ? 'Done' : 'Pending' }}
            </form>

        </div>
    </div>
</body>
<script>
    Array.from(document.getElementsByClassName('form-check-input')).forEach((element) => {
        element.checked = element.value == 1 ? true : false;
    });

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
