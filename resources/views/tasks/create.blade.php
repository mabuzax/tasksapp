@extends('layout.app')

@section('content')
<div class="container">

    <h1>New Task</h1>
    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <select name="project_id" class="select">
                <option value="1">No Project</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" 
                        @if(request('project_id') == $project->id) selected @endif>
                        {{ $project->project_name }}
                    </option>
                @endforeach
            </select>
        <div>        

        <div class="form-group">
            <label for="name">Task Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="priority">Task Priority</label>
            <input type="number" class="form-control" id="priority" name="priority" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
</div>
@endsection
