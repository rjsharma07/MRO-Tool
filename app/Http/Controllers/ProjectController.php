<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Client;
use App\Models\Country;
use App\Models\Currency;
use App\Models\User;
use App\Models\Vendor;

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
            if($request->security){
                $projectOb->generateUniqueLinks($request);
            } else {
                $projectOb->generateAlphaLinks($request);
            }
            
            $project = Project::find($projectOb->pki_project_id);
            
            $countries = Country::all();
            $clients = Client::all();
            
            return view('projects.edit-add',[
                'project' => $project,
                'clients'=>$clients,
                'countries'=>$countries
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
    public function edit($project_id)
    {   
        $project = Project::find($project_id);
        $clients = Client::all();
        $users = User::all();
        $countries = Country::all();
        $vendors = Vendor::all();
        return view('projects.edit-add', [
            'project' => $project,
            'clients' => $clients,
            'users' => $users,
            'countries' => $countries,
            'vendors' => $vendors
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   if($request->_token){
            $project = Project::find($request->pki_project_id);
            if($request->ir){
                $project->ir = $request->ir;
            }
            if($request->loi){
                $project->loi = $request->loi;
            }
            if($request->cpi){
                $project->cpi = $request->cpi;
            }
            if($request->required_completes){
                $project->required_completes = $request->required_completes;
            }
            if($request->client_survey_url){
                $project->client_survey_url = $request->client_survey_url;
            }
            if($request->complete_url){
                $project->complete_url = $request->complete_url;
            }
            if($request->disqualify_url){
                $project->disqualify_url = $request->disqualify_url;
            }
            if($request->quotafull_url){
                $project->quotafull_url = $request->quotafull_url;
            }
            if($request->quality_url){
                $project->quality_url = $request->quality_url;
            }
            $project->save();

            return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully');
        }
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