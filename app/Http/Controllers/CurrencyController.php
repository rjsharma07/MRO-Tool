<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::all();
        return view('currencies.index', [
            'currencies'=>$currencies
        ]);
    }

    public function create()
    {
        return view('currencies.add');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'currency' => 'required',
        ]);
        
        \DB::beginTransaction();
        $countryOb = new Client();
        $countryOb->country = $request->country;
        $countryOb->created = \Carbon\Carbon::now();
        $countryOb->updated = \Carbon\Carbon::now();
        $countryOb->save();
        \DB::commit();

        return redirect()->route('countries.index')
            ->with('success', 'Country updated successfully');
    }

    public function show()
    {   
        //
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'country' => 'required',
        ]);
        $country->update($request->all());

        return redirect()->route('countries.index')
            ->with('success', 'Country updated successfully');
    }

    public function destroy(Country $country)
    {
        $client->delete();

        return redirect()->route('countries.index')
            ->with('success', 'Country deleted successfully');
    }
}
