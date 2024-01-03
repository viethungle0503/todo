@extends('layouts.app')

@section('toDoApp')
    <div class="d-flex justify-content-center align-items-center">
        <h1 class="text-center d-inline-block">To-do lists</h1>
        <button type="submit" class="btn btn-success m-5">
            <a href="{{ url('/export/csv') }}" style="text-decoration: none; color:aqua">
                <i class="fa-solid fa-table"></i>
                Export as CSV file
            </a>
        </button>
        <button type="submit" class="btn btn-success m-5">
            <a href="{{ url('/export/xlsx') }}" style="text-decoration: none; color:aqua">
                <i class="fa-solid fa-table"></i>
                Export as XLSX file
            </a>
        </button>
    </div>
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
@endsection
