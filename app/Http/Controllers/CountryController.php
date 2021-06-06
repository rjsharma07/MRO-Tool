<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Http;

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

    public function addCountries()
    {
        try {
            $response = Http::get('https://api.printful.com/countries');
            $data = $response->json();
            $countries = [];
            foreach($data['result'] as $index=>$country){
                $countries[$index] = [
                    'country' => $country['name'],
                    'code' => $country['code'],
                    'created' => \Carbon\Carbon::now(),
                    'updated' => \Carbon\Carbon::now()
                ];
                Country::addCountries($countries[$index]);
            }
            return response([
                'success' => true,
                'message' => 'OK',
                'data' => "All Countries Added"
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
