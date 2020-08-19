<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelArticulos;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticulosController extends Controller
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
            $articulos = DB::table('tbl_perfumes AS t1')
                ->leftJoin('tbl_designers AS t2', 't2.id', '=', 't1.id_designer')
                ->select(
                      't1.id AS id',
                      't1.id_designer AS id_designer',
                      't1.nombre AS nombre',
                      't1.sexo AS sexo',
                      't1.tipo AS tipo',
                      't1.contenido AS contenido',
                      't1.presentacion AS presentacion',
                      't1.pca AS pca',
                      't1.precio_a AS precio_a',
                      't1.precio_b AS precio_b',
                      't1.precio_c AS precio_c',
                      't1.precio_p AS precio_p',
                      't1.descripcion AS descripcion',
                      't1.existencia AS existencia',
                      't1.estante AS estante',
                      't1.codigo AS codigo',
                      't1.codigoa1 AS codigoa1',
                      't1.codigoa2 AS codigoa2',
                      't1.codigoa3 AS codigoa3',
                      't1.codigoa4 AS codigoa4',
                      't1.codigoa5 AS codigoa5',
                      't1.fecha_alta AS fecha_alta',
                      't1.estado AS estado',
                      't2.nombre AS designer')
                ->get();

            return response()->json($articulos);
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
           
            $articulo = new ModelArticulos();
            $articulo->id_designer = $request->designer;
            $articulo->nombre = $request->nombre;
            $articulo->sexo = $request->sexo;
            $articulo->tipo = $request->tipo;
            $articulo->contenido = $request->contenido;
            $articulo->presentacion = $request->presentacion;
            $articulo->precio_a = $request->precio_a;
            $articulo->precio_b = $request->precio_b;
            $articulo->precio_c = $request->precio_c;
            $articulo->precio_p = $request->precio_p;
            $articulo->descripcion = $request->descripcion;
            $articulo->existencia = $request->existencia;
            $articulo->estante = $request->estante;
            $articulo->codigo = $request->codigo;
            $articulo->codigoa1 = $request->codigoa1;
            $articulo->codigoa2 = $request->codigoa2;
            $articulo->codigoa3 = $request->codigoa3;
            $articulo->codigoa4 = $request->codigoa4;
            $articulo->codigoa5 = $request->codigoa5;
            $articulo->fecha_alta = $fecha_actual = date("Y-m-d");
            $articulo->estado = 1;
            $articulo->save();

            $id_articulo = $articulo->id;

            if ($request->hasFile('imagen')) {
                //obtiene la extension
                $FotografiaExt = $request->file('imagen')->getClientOriginalExtension();
                //nombre que se guarad en ruta
                $FotografiaStore = $id_articulo.'.'.$FotografiaExt;
                //archivo guardado en ruta local
                Storage::disk('public_uploads')->put($FotografiaStore, fopen($request->file('imagen'), 'r+'));
            }

            return response()->json(array(
                'status' => true,
                'request' => $request->metodo,
            ));
        }

        else
        {
            $articulo = ModelArticulos::where('id', '=', $request->id)->update(array(
                'id_designer' => $request->designer,
                'nombre' => $request->nombre,
                'sexo' => $request->sexo,
                'tipo' => $request->tipo,
                'contenido' => $request->contenido,
                'existencia' => $request->existencia,
                'presentacion' => $request->presentacion,
                'precio_a' => $request->precio_a,
                'precio_b' => $request->precio_b,
                'precio_c' => $request->precio_c,
                'precio_p' => $request->precio_p,
                'descripcion' => $request->descripcion,
                'estante' => $request->estante,
                'codigo' => $request->codigo,
                'codigoa1' => $request->codigoa1,
                'codigoa2' => $request->codigoa2,
                'codigoa3' => $request->codigoa3,
                'codigoa4' => $request->codigoa4,
                'codigoa5' => $request->codigoa5));

            if ($request->hasFile('imagen')) {
                //se elimina la imagen antigua
                Storage::disk('public_uploads')->delete($request->id);

                //obtiene la extension
                $FotografiaExt = $request->file('imagen')->getClientOriginalExtension();
                //nombre que se guarad en ruta
                $FotografiaStore = $request->id.'.'.$FotografiaExt;
                //archivo guardado en ruta local
                Storage::disk('public_uploads')->put($FotografiaStore, fopen($request->file('imagen'), 'r+'));
            }

            return response()->json(array(
                'status' => true,
                'request' => $request->metodo,
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
        $articulo = ModelArticulos::where('id', '=', $id)->update(array(
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
        $articulo = ModelArticulos::where('id', '=', $id)->update(array(
            'estado' => 0));

        return response()->json(array(
            'status' => true
        ));
    }
}
