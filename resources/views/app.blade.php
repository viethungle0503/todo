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
        <form id="create-form">
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
            @include('unordered_list')
        </ul>
    </div>
    <hr />
    <div class="ms-3">
        <h2>Completed Tasks</h2>
    </div>

</body>


<script src="https://code.jquery.com/jquery-2.2.4.min.js"
    integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var create_form = "#create-form";
        $(create_form).on("submit", function(event) {
            event.preventDefault();
            var data = $(create_form).serialize();
            $.ajax({
                url: "/todos",
                method: "post",
                data: data,
            });

        });
    });
</script>


</html>
