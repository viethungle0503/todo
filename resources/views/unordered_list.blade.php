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