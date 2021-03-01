<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::getProjects();
        return view('projects.index', [
            'projects'=>$projects
        ]);
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
        $request->validate([
            'pname' => 'required',
            'pclient'=> 'required',
            'pir'=> 'required',
            'ploi'=> 'required',
            'pcpi'=> 'required',
            'prcompletes'=> 'required',
            'ptype'=> 'required',
            'pclient'=> 'required',
            'pcurrency'=> 'required',
            'psurveyl'=> 'required',
            'pcompletel'=> 'required',
            'psurveyl'=> 'required',
            'pquotal'=> 'required',
            'pqualityl'=> 'required',
            'pdescription' => 'required'
        ]);

        Product::create($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($project_id)
    {   $project = Project::find($project_id);
        return view('projects.view', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
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
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'pname' => 'required',
            'pclient'=> 'required',
            'pir'=> 'required',
            'ploi'=> 'required',
            'pcpi'=> 'required',
            'prcompletes'=> 'required',
            'ptype'=> 'required',
            'pclient'=> 'required',
            'pcurrency'=> 'required',
            'psurveyl'=> 'required',
            'pcompletel'=> 'required',
            'psurveyl'=> 'required',
            'pquotal'=> 'required',
            'pqualityl'=> 'required',
            'pdescription' => 'required'
        ]);
        $project->update($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('project.index')
            ->with('success', 'Project deleted successfully');
    }
}