@extends('layout.app')

@section('content')
    <h1>Available Tasks</h1>
        <div class="container">
            <form action="/tasks" method="GET">
                <select name="project_id" onchange="this.form.submit()" class="select">
                    <option value="">Filter by Project</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" 
                            @if(request('project_id') == $project->id) selected @endif>
                            {{ $project->project_name }}
                        </option>
                    @endforeach
                </select>
            </form>

            @if(count($tasks) > 0)

               

                <table  class="table" id="tasks_tbl">
                    <thead>
                        <tr>
                            
                            <th scope="col">Project</th>
                            <th scope="col">Task</th>
                            <th scope="col">Priority</th>
                            <th scope="col">Created</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($tasks as $task)
                            <tr data-task-id="{{ $task->id }}" draggable="true">                                
                                <td>{{ $task->project->project_name }}</td>
                                <td>{{ $task->task_name }}</td>
                                <td>{{ $task->priority }}</td>
                                <td>{{ $task->created_at->format('F j, Y, g:i a') }}</td>
                                <td>
                                  

                                    <a href="{{ route('tasks.edit', $task->id) }}">
                                        <button class="edit">Edit</button>
                                    </a>

                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline-block;">
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
                 <p>No Tasks to show</p>
            @endif
        </div>

    
@endsection
