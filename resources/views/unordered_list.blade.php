@foreach ($todos as $todo)
    @if ($todo->status == 0)
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
                        <form action="{{ url('todos/' . $todo->id) }}" method="POST" style="display: inline-block;">
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
