<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelGastos;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GastosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check())
        {
            $gastos = DB::table('tbl_gastos')
                    ->select(
                          'tbl_gastos.id_gasto AS id',
                          'tbl_gastos.fecha AS fecha',
                          'tbl_gastos.descripcion AS descripcion',
                          'tbl_gastos.total AS total',
                          'tbl_gastos.estado AS estado')
                    ->get();

            return response()->json($gastos);
        }
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
        $gastos = new ModelGastos();
        $gastos->fecha = $request->fecha;
        $gastos->descripcion = $request->descripcion;
        $gastos->total = $request->total;
        $gastos->estado = 1;
        $gastos->save();

        return response()->json(array(
            'status' => true
        ));
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
        $gastos = ModelGastos::where('id_gasto', '=', $id)->update(array(
            'estado' => 1));

        return response()->json(array(
            'status' => true
        ));
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
        $gastos = ModelGastos::where('id_gasto', '=', $request->id)->update(array(
            'fecha' => $request->fecha,
            'descripcion' => $request->descripcion,
            'total' => $request->total));

        return response()->json(array(
            'status' => true
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gastos = ModelGastos::where('id_gasto', '=', $id)->update(array(
            'estado' => 0));

        return response()->json(array(
            'status' => true
        ));
    }
}
