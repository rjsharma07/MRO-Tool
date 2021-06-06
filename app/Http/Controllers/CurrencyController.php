<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\Support\Facades\Http;

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

    public function addCurrencies()
    {
        try {
            $response = Http::get('https://openexchangerates.org/api/currencies.json');
            // $data = $response->json();
            $data = $response->json();
            foreach($data as $index=>$currency){
                $currencies = [];
                $currencies = [
                    'currency' => $currency,
                    'code' => $index,
                    'created' => \Carbon\Carbon::now(),
                    'updated' => \Carbon\Carbon::now()
                ];
                Currency::addCurrencies($currencies);
            }
            return response([
                'success' => true,
                'message' => 'OK',
                'data' => "All Currencies Added"
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
