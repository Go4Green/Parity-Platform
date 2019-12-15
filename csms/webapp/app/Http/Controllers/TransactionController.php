<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\User;
use App\Models\KwhCost;
use Auth;
use Carbon\Carbon;
use App\Models\Wallet;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::user()->id)->get();
        
        return view('transactions', [
            'transactions' => $transactions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('card_id', $request->input('card_id'))->first();
        // get userId by cardId
        $userId = $user->id;

        $chargingStatus = $request->input('charging_status');

        /* Start Charging
        {
            "charging_station_id": 1,
            "charging_status": "start_charging",
            "card_id": "415fab89"
        }
        */
        if ($chargingStatus == 'start_charging') {
            $tx = Transaction::create([
                'user_id' => $userId,
                'charging_station_id' => $request->input('charging_station_id'),
                'charge_start' => now(), 
                'charge_end' => now(), 
            ]);
        }

        /* Stop Charging
        {
            "charging_station_id": 1,
            "charging_status": "stop_charging",
            "card_id": "415fab89"
        }
        */
        elseif ($chargingStatus == 'stop_charging') {
            $tx = Transaction::where('user_id', $userId)->latest()->first();
            $tx->update([
                'charge_end' => now(), 
            ]);

            // Get current kWh cost
            $latestKwhCost = KwhCost::latest()->first()->cost;

            // Calculate charging duration   
            $start = Carbon::parse($tx->charge_start);
            $end = Carbon::parse($tx->charge_end);
            $seconds = $end->diffInSeconds($start);
            // for demo purposes, we assume seconds are minutes
            $chargingDuration = $seconds * 60;         

            // Calculate charging cost
            $chargingkWh = $chargingDuration * 50 / 60;
            $chargingCost = $chargingkWh * $latestKwhCost;
            $tx->update([
                'total_charging_cost' => $chargingCost
            ]);

            // Get user's wallet
            $userWallet = $user->wallet;

            // Reduce wallet by charging cost amount
            $newBalance = $userWallet->balance - $chargingCost;
            $userWallet->update([
                'balance' => $newBalance
            ]);

        } else {
            $tx = null;
        }

        return $tx;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
