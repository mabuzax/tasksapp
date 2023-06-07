@extends('layout.app')

@section('content')
<div class="container">

    <h1>New Project</h1>
    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        

        <div class="form-group">
            <label for="name">Enter Project Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
       
        <button type="submit" class="btn btn-primary">Create Project</button>
    </form>
</div>
@endsection
