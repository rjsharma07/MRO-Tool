<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;

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
        $countryOb = new Currency();
        $countryOb->currency = $request->currency;
        $countryOb->created = \Carbon\Carbon::now();
        $countryOb->updated = \Carbon\Carbon::now();
        $countryOb->save();
        \DB::commit();

        return redirect()->route('currencies.index')
            ->with('success', 'Country updated successfully');
    }

    public function show()
    {   
        //
    }

    public function update(Request $request, Currency $country)
    {
        $request->validate([
            'country' => 'required',
        ]);
        $country->update($request->all());

        return redirect()->route('currencies.index')
            ->with('success', 'Currency updated successfully');
    }

    public function destroy(Currency $country)
    {
        $client->delete();

        return redirect()->route('currencies.index')
            ->with('success', 'Currency deleted successfully');
    }
}
