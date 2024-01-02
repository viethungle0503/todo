<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="mt-2 align-middle" style="position: relative; top: 50vh;">
        <div class="card card-body d-flex flex-row justify-content-evenly">
            <form action="{{ url('todos/' . $todo->id) }}" method="POST" style="display: inline-block;">
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
            <form id="statusForm" action="{{ url('todos_status/' . $todo->id) }}" method="POST"
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
