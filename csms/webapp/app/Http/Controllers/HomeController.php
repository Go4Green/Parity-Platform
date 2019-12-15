<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KwhCost;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $latestKwhCost = KwhCost::latest()->first();
        
        $demand = $latestKwhCost->demand;
        $resCapacity = $latestKwhCost->res_capacity;
        $kwhCost = $latestKwhCost->cost;

        return view('home', [
            'demand' => $demand,
            'resCapacity' => $resCapacity,
            'kwhCost' => $kwhCost
        ]);
    }
}
