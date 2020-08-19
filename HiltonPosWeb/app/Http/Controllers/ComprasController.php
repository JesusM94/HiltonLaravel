<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelCompras;
use App\ModelPedidos;
use App\ModelPedidosDetalle;
use App\ModelComprasDetalle;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ComprasController extends Controller
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
            $pedidos = DB::table('tbl_pedidos')
                    ->select(
                        'tbl_pedidos.id_compra AS id',
                        'tbl_pedidos.id_compra AS id_compra',
                        'tbl_pedidos.fecha AS fecha',
                        'tbl_pedidos.id_membresia AS id_membresia',
                        'tbl_pedidos.nombre AS nombre',
                        'tbl_pedidos.telefono AS telefono',
                        'tbl_pedidos.celular AS celular',
                        'tbl_pedidos.nextel AS nextel',
                        'tbl_pedidos.email AS email',
                        'tbl_pedidos.estado AS estado')
                    ->get();

            return response()->json($pedidos);
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
        if ($request->metodo == 1) {
            $pedido = DB::table('tbl_pedidos AS pedidos')
                ->select('pedidos.*')
                ->where('pedidos.id_compra', '=', $request->id)
                ->first();

            $compras = new ModelCompras();
                $compras->fecha = $pedido->fecha;
                $compras->id_membresia =$pedido->id_membresia;
                $compras->nombre = $pedido->nombre;
                $compras->telefono = $pedido->telefono;
                $compras->celular = $pedido->celular;
                $compras->nextel = $pedido->nextel;
                $compras->email = $pedido->email;
                $compras->estado = 1;
                $compras->save();

            $id_compra = $compras->id;

            $pedidos = ModelPedidos::where('id_compra', '=', $request->id)->delete();

            return response()->json(array(
                'status' => true,
                'id_compra' => $id_compra,
                'id_antiguo' => $request->id,
            ));
        }
        else
        {
            $compras_detalle = new ModelComprasDetalle();
            $compras_detalle->id_compra = $request->id_compra;
            $compras_detalle->id_articulo = $request->id_articulo;
            $compras_detalle->cantidad = $request->cantidad;
            $compras_detalle->precio_lista = $request->precio_lista;
            $compras_detalle->precio_final = $request->precio_final;
            $compras_detalle->estado = 1;
            $compras_detalle->save();

            $pedidos_detalle = ModelPedidosDetalle::where('id_compra', '=', $request->id_antiguo)->where('id_articulo', '=', $request->id_articulo)->delete();

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
        $pedido_detalle = DB::table('tbl_pedidos_detalles AS t1')
            ->leftJoin('tbl_perfumes AS t2', 't1.id_articulo', '=', 't2.id')
            ->leftJoin('tbl_designers AS t3', 't2.id_designer', '=', 't3.id')
            ->select('t1.*', 't2.nombre AS perfume', 't2.contenido', 't3.nombre AS designer')
            ->where('t1.id_compra', '=', $id)
            ->get();

        return response()->json($pedido_detalle);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $valores= explode('&',$id);
        $id_compra = $valores[0];
        $id_articulo = $valores[1];

        $pedidos_detalle = ModelPedidosDetalle::where('id_compra', '=', $id_compra)->where('id_articulo', '=', $id_articulo)->delete();

        return response()->json(array(
            'status' => true,
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
        $pedidos_detalle = ModelPedidosDetalle::where('id_compra', '=', $request->id)->where('id_articulo', '=', $request->articulo)->update(array(
            'cantidad' => $request->cantidad));

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
        $pedido = DB::table('tbl_pedidos AS pedidos')
            ->select('pedidos.*')
            ->where('pedidos.id_compra', '=', $id)
            ->first();

        $pedido_detalle = DB::table('tbl_pedidos_detalles As detalles')
            ->select('detalles.*')
            ->where('detalles.id_compra', '=', $id)
            ->get();


        $compras = new ModelCompras();
            $compras->fecha = $pedido->fecha;
            $compras->id_membresia =$pedido->id_membresia;
            $compras->nombre = $pedido->nombre;
            $compras->telefono = $pedido->telefono;
            $compras->celular = $pedido->celular;
            $compras->nextel = $pedido->nextel;
            $compras->email = $pedido->email;
            $compras->estado = 0;
            $compras->save();

        $id_compra = $compras->id;

        foreach ($pedido_detalle as $t) {
            $compras_detalle = new ModelComprasDetalle();
            $compras_detalle->id_compra = $id_compra;
            $compras_detalle->id_articulo = $t->id_articulo;
            $compras_detalle->cantidad = $t->cantidad;
            $compras_detalle->precio_lista = $t->precio_lista;
            $compras_detalle->precio_final = $t->precio_final;
            $compras_detalle->estado = 0;
            $compras_detalle->save();
        }

        $pedidos = ModelPedidos::where('id_compra', '=', $id)->delete();
        $pedidos_detalle = ModelPedidosDetalle::where('id_compra', '=', $id)->delete();

        return response()->json(array(
            'status' => true
        ));
    }
}
