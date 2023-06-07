@extends('layout.app')

@section('content')
<div class="container">
    <h1>Update Project</h1>
    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Project Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $project->project_name }}" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Project</button>
    </form>
</div>
@endsection
