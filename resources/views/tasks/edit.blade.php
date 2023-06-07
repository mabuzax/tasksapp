@extends('layout.app')

@section('content')
<div class="container">
    <h1>Update Task</h1>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Task Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $task->task_name }}" required>
        </div>
        <div class="form-group">
            <label for="priority">Task Priority</label>
            <input type="number" class="form-control" id="priority" name="priority" value="{{ $task->priority }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Task</button>
    </form>
</div>
@endsection
