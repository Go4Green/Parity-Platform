<?php

namespace App\Http\Controllers;

use App\Models\ChargingStation;
use Illuminate\Http\Request;

class ChargingStationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('charging-stations');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChargingStation  $chargingStation
     * @return \Illuminate\Http\Response
     */
    public function show(ChargingStation $chargingStation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChargingStation  $chargingStation
     * @return \Illuminate\Http\Response
     */
    public function edit(ChargingStation $chargingStation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChargingStation  $chargingStation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChargingStation $chargingStation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChargingStation  $chargingStation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChargingStation $chargingStation)
    {
        //
    }
}
