<?php

namespace App\Http\Controllers;

use App\Models\KwhCost;
use Illuminate\Http\Request;

class KwhCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $kwhCost = KwhCost::create([
            'demand' => $request->input('demand'),
            'res_capacity' => $request->input('res_capacity'),
            'cost' => $request->input('cost'),
        ]);

        return $kwhCost;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KwhCost  $kwhCost
     * @return \Illuminate\Http\Response
     */
    public function show(KwhCost $kwhCost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KwhCost  $kwhCost
     * @return \Illuminate\Http\Response
     */
    public function edit(KwhCost $kwhCost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KwhCost  $kwhCost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KwhCost $kwhCost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KwhCost  $kwhCost
     * @return \Illuminate\Http\Response
     */
    public function destroy(KwhCost $kwhCost)
    {
        //
    }
}
