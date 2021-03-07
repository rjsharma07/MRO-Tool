<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use App\Models\Currency;
use App\Models\User;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $clients = Client::all();
        $users = User::all();
        $projects = Project::getProjects();
        return view('projects.index', [
            'projects'=>$projects,
            'clients'=>$clients,
            'users'=>$users
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
    {   if(isset($request['submit'])){
            $request->validate([
                'name' => 'required',
                'subject' => 'required',
                'fki_client_id'=> 'required',
                'fki_user_id'=> 'required',
            ]);
            
            \DB::beginTransaction();
            $projectOb = new Project();
            $projectOb->name = $request->name;
            $projectOb->subject = $request->subject;
            $projectOb->epo = 'EPO_'.$request->name;
            $projectOb->fki_client_id = $request->fki_client_id;
            $projectOb->fki_user_id = $request->fki_user_id;
            $projectOb->created = \Carbon\Carbon::now();
            $projectOb->updated = \Carbon\Carbon::now();

            $projectOb->save();
            \DB::commit();
            
            $projectOb->generateLinks($request);
            
            $project = Project::find($projectOb->pki_project_id);
            
            $currencies = Currency::all();
            $clients = Client::all();
            
            return view('projects.edit-add',[
                'project' => $project,
                'clients'=>$clients,
                'currencies'=>$currencies
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($project_id)
    {   
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit-add', compact('project'));
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
            'name' => 'required',
            'subject' => 'required',
            'client'=> 'required',
            'manager'=> 'required',
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