<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class CurrencyConverterController extends Controller
{

    public function index()
    {
        $currencies = ['USD', 'EUR', 'GBP', 'LBP', 'KWD'];

        return view('currency_converter', compact('currencies'));
    }



    public function convert(Request $request)
    {
        $currencies = ['USD', 'EUR', 'GBP', 'LBP', 'KWD']; 
    
        $amount = $request->input('amount');
        $fromCurrency = $request->input('from_currency');
        $toCurrency = $request->input('to_currency');
    
        $client = new Client();
        $response = $client->get('https://open.er-api.com/v6/latest/' . $fromCurrency, [
            'query' => [
                'app_id' => env('OPEN_EXCHANGE_RATES_APP_ID'),
            ],
        ]);
    
        $data = json_decode($response->getBody(), true);
    
        $conversionRate = $data['rates'][$toCurrency];
        $convertedAmount = $amount * $conversionRate;
    
        return view('currency_converter', compact('currencies', 'convertedAmount'));
    }

    
}
