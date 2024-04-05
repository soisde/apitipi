<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\CepController;
use Illuminate\Http\Request;

class CepControllerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cep');

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
     * @param  \App\Models\CepController  $cepController
     * @return \Illuminate\Http\Response
     */
    public function show(CepController $cepController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CepController  $cepController
     * @return \Illuminate\Http\Response
     */
    public function edit(CepController $cepController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CepController  $cepController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CepController $cepController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CepController  $cepController
     * @return \Illuminate\Http\Response
     */
    public function destroy(CepController $cepController)
    {
        //
    }
}
