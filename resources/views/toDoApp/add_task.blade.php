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
                        <input type="text" class="form-control" name="content" placeholder="Add some new content..."
                            style="min-width: 40vw" />
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
