<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelPedidosDetalle;
use App\ModelPedidos;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PedidoPController extends Controller
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
        if ($request->id_post == 0) {
            $pedidos = new ModelPedidos();
            $pedidos->fecha = $fecha_actual = date("Y-m-d");
            $pedidos->id_membresia = $request->id_membresia;
            $pedidos->nombre = $request->nombre;
            $pedidos->telefono = $request->telefono;
            $pedidos->celular = $request->celular;
            $pedidos->nextel = $request->nextel;
            $pedidos->email = $request->email;
            $pedidos->estado = 1;
            $pedidos->save();

            $id_compra = $pedidos->id;

            return response()->json(array(
                'status' => true,
                'id_compra' => $id_compra,
            ));
        }
        else{

            $pedidos_p = new ModelPedidosDetalle();
            $pedidos_p->id_compra = $request->id_compra;
            $pedidos_p->id_articulo = $request->id_articulo;
            $pedidos_p->cantidad = $request->cantidad;
            $pedidos_p->precio_lista = $request->precio_lista;
            $pedidos_p->precio_final = $request->precio_final;
            $pedidos_p->estado = 1;
            $pedidos_p->save();

            return response()->json(array(
                'status' => true
            ));
        }
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
}
