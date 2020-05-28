<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticker;

class TradingController extends Controller
{
    public function __construct()
    {
    }

    public function addEntryList(Request $request) {
        if($request->date) {
            $ticker = Ticker::where('date', $request->date)->first();
            $tickerList = json_decode($request->tickerList, true);
            if(count($tickerList) == 0 && $ticker) {
                $ticker->delete();
            } else {
                if(!$ticker) {
                    $ticker = new Ticker();
                    $ticker->date = $request->date;
                }
                $ticker->ticker_data = $request->tickerList;
                $ticker->save();
            }
        }
        return response()->json($request->all());   
    }

    public function getTradingData(Request $request) {
        $date = $request->date;
        $tickerData = Ticker::where('date', $date)->first();
        return response()->json(['tickerList' => $tickerData]);
    }

    public function getAllTradingData(Request $request) {
        $tickerData = Ticker::orderBy('date')->get();
        return response()->json($tickerData);
    }
}