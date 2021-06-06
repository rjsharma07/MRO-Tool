<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\Client;
use App\Models\Country;
use App\Models\Currency;
use App\Models\User;
use App\Models\Vendor;
use App\Models\VendorDetail;
use App\Models\VendorProjectDetail;
use App\Models\ProjectStatus;

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
        $clients = Client::all();
        $users = User::all();
        $projectstatuses = ProjectStatus::all();
        $calculated_loi = [];
        $calculated_ir = [];
        foreach($projects as $project){
            $total = 0;
            $projectDetails = ProjectDetail::getProjectLOI($project->pki_project_id);
            $diff_in_seconds = 0;
            if(count($projectDetails)>0){
                foreach($projectDetails as $projectDetail){
                    $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $projectDetail->entered);
                    $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $projectDetail->exited);
                    $diff_in_seconds = $diff_in_seconds + $to->diffInSeconds($from);
                }
                $calculated_loi[] = number_format((float)$diff_in_seconds/(count($projectDetails)*$project->loi*60), 2, '.', '');
            }
            if($project->completes_count > 0){
                $calculated_ir[] = $project->completes_count/($project->completes_count+$project->disqualify_count);
            }
        }
        return view('projects.index', [
            'projects'=>$projects,
            'clients'=>$clients,
            'users'=>$users,
            'projectstatuses'=>$projectstatuses,
            'calculated_loi'=>$calculated_loi,
            'calculated_ir'=>$calculated_ir
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
        $rand = mt_rand(1000000, 9999999);
        $user = auth()->user();

        if(isset($request['submit'])){
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
            $projectOb->cui = 'CUI_'.$rand;
            $projectOb->fki_client_id = $request->fki_client_id;
            $projectOb->fki_user_id = $user->pki_user_id;
            $projectOb->created = \Carbon\Carbon::now();
            $projectOb->updated = \Carbon\Carbon::now();

            $projectOb->save();
            \DB::commit();
            if($request->security){
                $projectOb->generateUniqueLinks($request);
            } else {
                $projectOb->generateAlphaLinks($request);
            }
            
        } else {
            $request->validate([
                'cui_name' => 'required',
            ]);
            $project = Project::where('cui', $request->cui_name)->first();
            $projectOb = new Project();
            $projectOb->fki_client_id = $project->fki_client_id;
            $projectOb->fki_user_id = $user->pki_user_id;
            $projectOb->fki_country_id = $project->fki_country_id;
            $projectOb->fki_currency_id = $project->fki_currency_id;
            $projectOb->fki_security_id = $project->fki_security_id;
            $projectOb->cui = $project->cui;
            $projectOb->name = $project->name;
            $projectOb->reference_name = $project->reference_name;
            $projectOb->subject = $project->subject;
            $projectOb->type = $project->type;
            $projectOb->ir = $project->ir;
            $projectOb->loi = $project->loi;
            $projectOb->cpi = $project->cpi;
            $projectOb->required_completes = $project->required_completes;
            $projectOb->complete_url = $project->complete_url;
            $projectOb->disqualify_url = $project->disqualify_url;
            $projectOb->quotafull_url = $project->quotafull_url;
            $projectOb->quality_term_url = $project->quality_term_url;
            $projectOb->created = \Carbon\Carbon::now();
            $projectOb->updated = \Carbon\Carbon::now();
            $projectOb->save();
        }
        return redirect()->route('projects.edit', $projectOb->pki_project_id)
            ->with('success', 'Project updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($project_id)
    {   
        $project = Project::find($project_id);
        $clients = Client::all();
        $users = User::all();
        $countries = Country::all();
        return view('projects.show', [
            'project' => $project,
            'clients' => $clients,
            'users' => $users,
            'countries' => $countries
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id)
    {   
        $project = Project::getProjectDetails($project_id);
        $clients = Client::all();
        $users = User::all();
        $vendors = Vendor::all();
        $countries = Country::all();
        $vendorDetails = VendorDetail::getVendorDetailsByProject($project_id);
        foreach($vendorDetails as $vendorDetail){
            $total = 0;
            $vendorProjectDetails = VendorProjectDetail::getVendorProjectDetailsLOI($vendorDetail->pki_vendordetail_id);
            $diff_in_seconds = 0;
            if(count($vendorProjectDetails)>0){
                foreach($vendorProjectDetails as $vendorProjectDetail){
                    $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $vendorProjectDetail->entered);
                    $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $vendorProjectDetail->exited);
                    $diff_in_seconds = $diff_in_seconds + $to->diffInSeconds($from);
                }
                $calculated_loi[] = number_format((float)$diff_in_seconds/(count($vendorProjectDetails)*$project->loi*60), 2, '.', '');
            }
            if($vendorDetail->completes_count > 0){
                $calculated_ir[] = $vendorDetail->completes_count/($vendorDetail->completes_count+$vendorDetail->disqualify_count);
            }
        }
        $projectstatuses = ProjectStatus::all();
        return view('projects.edit-add', [
            'project' => $project,
            'clients' => $clients,
            'users' => $users,
            'countries' => $countries,
            'vendors' => $vendors,
            'vendordetails' => $vendorDetails,
            'projectstatuses' => $projectstatuses,
            'calculated_loi' => $calculated_loi,
            'calculated_ir' => $calculated_ir
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
            if($request->fki_currency_id){
                $project->fki_currency_id = $request->fki_currency_id;
            }
            if($request->fki_country_id){
                $project->fki_country_id = $request->fki_country_id;
            }
            if($request->cpi){
                $project->cpi = $request->cpi;
            }
            if($request->required_completes){
                $project->required_completes = $request->required_completes;
            }
            if($request->client_survey_url){
                $project->client_survey_url = $request->client_survey_url;
                //$project->maskSurvey($request);
            }
            if($request->status){
                $project->fki_projectstatus_id = $request->status;
            }
            $project->save();
            
            return redirect()->route('projects.edit', $project->pki_project_id)
            ->with('success', 'Project updated successfully');
            
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        Project::updateProjectDetails($request->project_id, [
            'status' => 0
        ]);
        return redirect()->route('projects.index')
            ->with('success', 'Project removed successfully');
    }

    public function getProjectDetails($project_id)
    {
        try {
            $details = Project::getProjectDetails($project_id);
            return response([
                'success' => true,
                'message' => 'OK',
                'data' => $details
            ])->header("Access-Control-Allow-Origin", "*");
        } catch (FunstayException $e) {
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ])->header("Access-Control-Allow-Origin", "*");
        } catch (FunstayQueryException $e) {
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ])->header("Access-Control-Allow-Origin", "*");
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ])->header("Access-Control-Allow-Origin", "*");
        }
    }

    public function updateProjectStatus($project_id, Request $request)
    {
        try {
            $data = [
                'fki_projectstatus_id' => $request->fki_projectstatus_id
            ];
            $response = Project::updateProjectDetails($project_id, $data);
            return response([
                'success' => true,
                'message' => 'OK',
                'data' => $response
            ])->header("Access-Control-Allow-Origin", "*");
        } catch (FunstayException $e) {
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ])->header("Access-Control-Allow-Origin", "*");
        } catch (FunstayQueryException $e) {
            return response([
                'success' => false,
                'message' => $e->getMessage()
            ])->header("Access-Control-Allow-Origin", "*");
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ])->header("Access-Control-Allow-Origin", "*");
        }
    }
}