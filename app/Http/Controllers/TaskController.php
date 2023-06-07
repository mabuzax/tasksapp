<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

        $projectId = $request->input('project_id');
        if ($projectId) {
            $tasks = Task::where('project_id', $projectId)->get()->sortBy('priority');
        } else {
            $tasks = Task::all()->sortBy('priority');
        }

        $projects = Project::all();

        return view('tasks.index', compact('tasks', 'projects'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $projects = Project::all();
        return view('tasks.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'priority' => 'required|numeric',
        ]);

        Log::error( $request);
       
            try {

                $task = new Task;
                $task->task_name = $validatedData['name'];
                $task->project_id = $request->input('project_id');
                $task->priority = $validatedData['priority']; 

                $task->save();
                            
                session()->flash('success', 'Task created successfully.');
                return redirect('/tasks');
            } catch (\Exception $e) {
                session()->flash('error', 'Error creating the task.');
                return redirect()->back();
            }
       

        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {   
        return view('tasks.edit', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {   
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {   
        
        $validatedData = $request->validate([
            'name' => 'required',
            'priority' => 'required|numeric',
        ]);

            $taskToUpdate = Task::find($request->id);

            if($taskToUpdate) {
                try {
                    $taskToUpdate->task_name = $validatedData['name'];
                    $taskToUpdate->project_id = $request->input('project_id');
                    $taskToUpdate->priority = $validatedData['priority'];

                    

                    $taskToUpdate->save();

                    session()->flash('success', 'Task updated successfully.');
                    return redirect('/tasks');
                } catch (\Exception $e) {
                    session()->flash('error', 'Error updating task.');
                    return redirect()->back();
                }
            } else {
                session()->flash('error', 'Task not found.');
            }        

        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {   try {
            $task->delete();
            session()->flash('success', 'Task deleted successfully.');
            return redirect('/tasks');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting task.');
            return redirect()->back();
        }
    }

    public function updatePriorities(Request $request)
    {   

        $validatedData = $request->validate([
            'sourceId' => 'required|numeric',
            'targetId' => 'required|numeric',
        ]);
        
       

            DB::beginTransaction();
        
            try {
                
                $sourceTask = Task::find($request->input('sourceId'));
                $targetTask = Task::find($request->input('targetId'));
                
                $tmpPriority = $sourceTask->priority;
                $sourceTask->priority = $targetTask->priority; 
                $targetTask->priority = $tmpPriority; 

                $sourceTask->save();
                $targetTask->save();

                DB::commit();
                session()->flash('success', 'Task priority updated.');
                
            } catch (\Exception $e) {
                DB::rollback();
                session()->flash('error', 'Error updating task.');
                
            }      
        
        return redirect('/tasks');
    }

}
