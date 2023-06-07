<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        
        $projects = Project::all();
       
        
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
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
            'name' => 'required|max:50',
        ]);

        if(Project::where('project_name', $validatedData['name'])->get()->count()>0) {

            session()->flash('error', 'Similar project already exists.');
            return redirect()->back();
        } 

        try {
            $project = new Project;
            $project->project_name = $validatedData['name'];
            $project->save();

            session()->flash('success', 'Project created successfully.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting project.');
            
        }
        return redirect('/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
        ]);
        
        
        try{
            $project->project_name = $validatedData['name'];
            $project->save();

            session()->flash('success', 'Project Updated successfully.');
            return redirect('/projects');
        }  catch (\Exception $e) {
            session()->flash('error', 'Error updating project.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {   
        try {
        $project->delete();
        session()->flash('success', 'Project deleted successfully.');
        } catch (\Exception $e) {
            session()->flash('error', 'Error deleting project.');
            
        }
        return redirect('/projects');
    }
}
