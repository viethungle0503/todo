<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
        @include('toDoApp.add_task')
        @if (session('result'))
            <div class="alert alert-success">
                {{ session('result') }}
            </div>
        @endif
    </div>
    <hr />
    @include('toDoApp.pending_task')
    <hr />
    @include('toDoApp.completed_task')
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
