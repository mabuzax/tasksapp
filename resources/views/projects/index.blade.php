@extends('layout.app')

@section('content')
    <h1>Available Projects</h1>
        <div class="container">


            @if(count($projects) > 0)

                <table  class="table" id="projects_tbl">
                    <thead>
                        <tr>                            
                            <th scope="col">Project</th>
                            <th scope="col">Created</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($projects as $project)
                            <tr data-project-id="{{ $project->id }}">
                                <td>{{ $project->project_name }}</td>
                                <td>{{ $project->created_at->format('F j, Y, g:i a') }}</td>
                                <td>
                                  

                                    <a href="{{ route('projects.edit', $project->id) }}">
                                        <button class="edit">Edit</button>
                                    </a>

                                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                 <p>No Projects to show</p>
            @endif
        </div>

    
@endsection
