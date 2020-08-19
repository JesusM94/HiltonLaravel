<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelCompras;
use App\ModelComprasDetalle;
use App\ModelPedidos;
use App\ModelPedidosDetalle;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CanceladasController extends Controller
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
            $canceladas = DB::table('tbl_compras')
                ->select(
                    'tbl_compras.id_compra AS id',
                    'tbl_compras.id_compra AS id_compra',
                    'tbl_compras.fecha AS fecha',
                    'tbl_compras.nombre AS nombre',
                    'tbl_compras.id_membresia AS id_membresia',
                    'tbl_compras.telefono AS telefono',
                    'tbl_compras.celular AS celular',
                    'tbl_compras.nextel AS nextel',
                    'tbl_compras.email AS email',
                    'tbl_compras.estado AS estado')
                ->where('tbl_compras.estado', '=', 0)
                ->get();

            return response()->json($canceladas);
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
        $venta_cancelada = DB::table('tbl_compras_detalles AS t1')
            ->leftJoin('tbl_perfumes AS t2', 't1.id_articulo', '=', 't2.id')
            ->leftJoin('tbl_designers AS t3', 't2.id_designer', '=', 't3.id')
            ->select('t1.*', 't2.nombre AS perfume', 't2.contenido', 't3.nombre AS designer')
            ->where('t1.id_compra', '=', $id)
            ->get();

        return response()->json($venta_cancelada);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $compra = DB::table('tbl_compras AS compras')
            ->select('compras.*')
            ->where('compras.id_compra', '=', $id)
            ->first();

        $compra_detalle = DB::table('tbl_compras_detalles As detalles')
            ->select('detalles.*')
            ->where('detalles.id_compra', '=', $id)
            ->get();


        $compras = new ModelPedidos();
            $compras->fecha = $compra->fecha;
            $compras->id_membresia =$compra->id_membresia;
            $compras->nombre = $compra->nombre;
            $compras->telefono = $compra->telefono;
            $compras->celular = $compra->celular;
            $compras->nextel = $compra->nextel;
            $compras->email = $compra->email;
            $compras->estado = 1;
            $compras->save();

        $id_compra = $compras->id;

        foreach ($compra_detalle as $t) {
            $compras_detalle = new ModelPedidosDetalle();
            $compras_detalle->id_compra = $id_compra;
            $compras_detalle->id_articulo = $t->id_articulo;
            $compras_detalle->cantidad = $t->cantidad;
            $compras_detalle->precio_lista = $t->precio_lista;
            $compras_detalle->precio_final = $t->precio_final;
            $compras_detalle->estado = 1;
            $compras_detalle->save();
        }

        $pedidos = ModelCompras::where('id_compra', '=', $id)->delete();
        $pedidos_detalle = ModelComprasDetalle::where('id_compra', '=', $id)->delete();

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
}
