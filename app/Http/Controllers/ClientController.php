<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Country;
use App\Models\Currency;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $clients = Client::all();
        return view('clients.index', [
            'clients'=>$clients
        ]);
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
            'client' => 'required',
            'email' => 'required',
        ]);
        
        \DB::beginTransaction();
        $clientOb = new Client();
        $clientOb->client = $request->client;
        $clientOb->email = $request->email;
        if($request->phone){
            $clientOb->phone = $request->phone;
        }
        if($request->address){
            $clientOb->billing_address = $request->address;
        }
        $clientOb->created = \Carbon\Carbon::now();
        $clientOb->updated = \Carbon\Carbon::now();

        $clientOb->save();
        \DB::commit();
            
        return redirect()->route('clients.edit', $clientOb->pki_client_id)
            ->with('success', 'Client added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($client_id)
    {   
        $client = Client::find($client_id);
        $countries = Country::all();
        $currencies = Currency::all();
        return view('clients.edit', [
            'client' => $client,
            'currencies' => $currencies,
            'countries' => $countries,
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
    {   
        if($request->_token){
            $client = Client::find($request->pki_client_id);
            if($request->email){
                $client->email = $request->email;
            }
            if($request->phone){
                $client->phone = $request->phone;
            }
            if($request->address){
                $client->billing_address = $request->address;
            }
            $client->save();
            
            return redirect()->route('clients.edit', $client->pki_client_id)
            ->with('success', 'Client updated successfully');
            
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
