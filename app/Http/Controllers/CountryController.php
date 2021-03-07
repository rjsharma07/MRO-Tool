<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('countries.index', [
            'countries'=>$countries
        ]);
    }

    public function create()
    {
        return view('countries.add');
    }

    public function store(Request $request)
    {   
        $request->validate([
            'country' => 'required',
        ]);
        
        \DB::beginTransaction();
        $countryOb = new Country();
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
