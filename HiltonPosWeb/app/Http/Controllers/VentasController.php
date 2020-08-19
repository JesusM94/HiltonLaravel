<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelVentas;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VentasController extends Controller
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
            $ventas = DB::table('tbl_ventas AS t1')
                ->leftjoin('tbl_membresias AS t2', 't1.id_membresia', '=', 't2.id')
                ->select(
                    't2.id AS id_membresia',
                    't2.user_name AS usuario',
                    DB::raw("CONCAT(t2.name,' ',t2.apellido_paterno,' ',t2.apellido_materno) as cliente"),
                    't1.id_vta AS id',
                    't1.id_vta AS id_vta',
                    't1.fecha AS fecha',
                    't1.imp AS imp',
                    't1.observaciones AS observaciones',
                    't1.estado AS estado')
                ->get();

            return response()->json($ventas);
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
        $ventas = new ModelVentas();
        $ventas->fecha = $request->fecha;
        $ventas->id_membresia = $request->id_membresia;
        $ventas->imp = $request->imp;
        $ventas->observaciones = $request->observaciones;
        $ventas->estado = 1;
        $ventas->save();

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
        $ventas_detalle = DB::table('tbl_ventas_detalles AS t1')
            ->leftJoin('tbl_perfumes AS t2', 't1.id_art', '=', 't2.id')
            ->leftJoin('tbl_designers AS t3', 't2.id_designer', '=', 't3.id')
            ->select('t1.*', 't2.nombre AS perfume', 't2.contenido', 't3.nombre AS designer')
            ->where('t1.id_vta', '=', $id)
            ->get();

        return response()->json($ventas_detalle);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ventas = DB::table('tbl_perfumes AS t1')
                ->select(
                    't1.id AS id',
                    't1.precio_a AS precio_a',
                    't1.precio_c AS precio_c',
                    't1.id_designer AS id_designer',
                    't1.nombre AS nombre')
                ->where('t1.codigo', '=', $id)
                ->first();

        return response()->json($ventas);
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
        $ventas = ModelVentas::where('id_vta', '=', $request->id)->update(array(
            'fecha' => $request->fecha,
            'id_membresia' => $request->id_membresia,
            'imp' => $request->imp,
            'observaciones' => $request->observaciones));

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
        //
    }
}
