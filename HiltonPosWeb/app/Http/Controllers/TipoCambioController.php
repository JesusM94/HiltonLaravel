<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipoCambioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monedaOrigen = "USD";
        $monedaDestino = "MXN";
        $cantidad = "1";
        $tipocambioval = $this->conversor_divisas($monedaOrigen, $monedaDestino, $cantidad);

        return response()->json($tipocambioval);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function conversor_divisas($divisa_origen, $divisa_destino, $cantidad){
        //https://www.x-rates.com/calculator/?from=USD&to=EUR&amount=1
        
        $cantidad = urlencode($cantidad);
        $divisa_origen = urlencode($divisa_origen);
        $divisa_destino = urlencode($divisa_destino);

        $url = 'https://www.x-rates.com/calculator/?from=USD&to=MXN&amount=1';
        
        $rawdata = file_get_contents($url);
        $cadena = htmlspecialchars($rawdata, ENT_QUOTES);
        $dv1 = explode('ccOutputRslt', $cadena);
        $dv2 = explode('ccOutputTrail', $dv1[1]);

        $inf = array('span','class=','"', ">", "<");
        $valor = str_replace($inf , '', $dv2[0]);

        $d = html_entity_decode($valor);
        $d1 = str_replace('>', '', $d);
        $d2 = str_replace('"', '', $d1);

        //$variable = $divisa_origen + $divisa_destino + $cantidad;

        return str_replace('<', '', $d2);
    }
}
