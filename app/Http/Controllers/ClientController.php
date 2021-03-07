<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('clients.index', [
            'clients'=>$clients
        ]);
    }

    public function create()
    {
        return view('clients.add');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'client' => 'required',
        ]);
        
        \DB::beginTransaction();
        $clientOb = new Client();
        $clientOb->client = $request->client;
        $clientOb->created = \Carbon\Carbon::now();
        $clientOb->updated = \Carbon\Carbon::now();
        $clientOb->save();
        \DB::commit();

        return redirect()->route('client.index')
            ->with('success', 'Client updated successfully');
    }

    public function show($project_id)
    {   
        //
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $client->update($request->all());

        return redirect()->route('client.index')
            ->with('success', 'Client updated successfully');
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()->route('client.index')
            ->with('success', 'Client deleted successfully');
    }
}
