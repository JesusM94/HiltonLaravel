<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelIndex;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
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
            $p_especiales = DB::table('tbl_especiales AS t1')
                ->leftJoin('tbl_perfumes AS t2', 't2.id', '=', 't1.id_perfume')
                ->leftJoin('tbl_designers AS t3', 't3.id', '=', 't2.id_designer')
                ->select(
                    't1.id AS id',
                    't1.precio AS precio',
                    't1.estado AS estado',
                    't2.id AS id_perfume',
                    't2.nombre AS nombre',
                    DB::raw("(CASE WHEN t2.sexo='M' THEN 'Para Dama' WHEN t2.sexo='H' THEN 'Para Caballero' WHEN t2.sexo='A' THEN 'Para Niña' WHEN t2.sexo='O' THEN 'Para Niño' END) as sexo"),
                    't2.existencia AS existencia',
                    't1.precio AS precio_f',
                    't1.precio AS precio_o',
                    't2.contenido AS contenido',
                    't2.presentacion AS presentacion',
                    't3.nombre AS designer')
                ->where('t2.estado', '!=', 0)
                ->where('t1.estado', '=', 1)
                ->get();

            return response()->json($p_especiales);
        }

        else
        {

            $p_especiales = DB::table('tbl_especiales AS t1')
                ->leftJoin('tbl_perfumes AS t2', 't2.id', '=', 't1.id_perfume')
                ->leftJoin('tbl_designers AS t3', 't3.id', '=', 't2.id_designer')
                ->select(
                    't1.id AS id',
                    't1.precio AS precio',
                    't2.id AS id_perfume',
                    't2.nombre AS nombre',
                    DB::raw("(CASE WHEN t2.sexo='M' THEN 'Para Dama' WHEN t2.sexo='H' THEN 'Para Caballero' WHEN t2.sexo='A' THEN 'Para Niña' WHEN t2.sexo='O' THEN 'Para Niño' END) as sexo"),
                    't2.existencia AS existencia',
                    't2.precio_c AS precio_o',
                    't2.precio_c AS precio_f',
                    't2.contenido AS contenido',
                    't2.presentacion AS presentacion',
                    't3.nombre AS designer')
                ->where('t2.estado', '!=', 0)
                ->where('t1.estado', '=', 1)
                ->get();

            return response()->json($p_especiales);
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
        $p_especiales = new ModelIndex();
        $p_especiales->id_perfume = $request->id_perfume;
        $p_especiales->precio = $request->precio;
        $p_especiales->estado = 1;
        $p_especiales->save();

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
        if (Auth::check())
        {
            $admin = false;
            $clase_usuario = auth()->user()->clase;
            if ($clase_usuario == 'Z') {
                $admin = true;
            }

            return response()->json(array(
                'status' => true,
                'admnistrador' => $admin,
                'id_usuario' => auth()->user()->id,
                'nombre' => auth()->user()->name,
                'apellidop' => auth()->user()->apellido_paterno,
                'apellidom' => auth()->user()->apellido_materno,
                'telefono' => auth()->user()->telefono_local,
                'celular' => auth()->user()->telefono_celular,
                'nextel' => auth()->user()->nextel,
                'email' => auth()->user()->email,
            ));
        }
        else
        {
            return response()->json(array(
                'status' => false,
            ));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $p_especiales = DB::table('tbl_perfumes AS t1')
                ->select(
                    't1.id AS id',
                    't1.id_designer AS id_designer',
                    't1.nombre AS nombre')
                ->where('t1.codigo', '=', $id)
                ->first();

            return response()->json($p_especiales);
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
        $p_especiales = ModelIndex::where('id', '=', $id)->delete();
    }
}
