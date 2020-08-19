<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelCaballero;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CaballeroController extends Controller
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
            $p_caballero = DB::table('tbl_designers AS t3')
                ->leftJoin('tbl_perfumes AS t2', 't3.id', '=', 't2.id_designer')
                ->leftJoin('tbl_especiales AS t1', 't2.id', '=', 't1.id_perfume')
                ->select(
                    't1.precio AS precio_e',
                    't2.id AS id_perfume',
                    't2.nombre AS nombre',
                    DB::raw("(CASE WHEN t2.sexo='H' THEN 'Para Caballero' END) as sexo"),
                    't2.contenido AS contenido',
                    't2.presentacion AS presentacion',
                    't2.descripcion AS descripcion',
                    't2.precio_a AS precio_f',
                    't2.precio_c AS precio_o',
                    't3.nombre AS designer')
                ->where('t2.estado', '!=', 0)
                ->where('t2.sexo', '=', 'H')
                ->get();

            return response()->json($p_caballero);
        }
        else
        {
            $p_caballero = DB::table('tbl_designers AS t3')
                ->leftJoin('tbl_perfumes AS t2', 't3.id', '=', 't2.id_designer')
                ->leftJoin('tbl_especiales AS t1', 't2.id', '=', 't1.id_perfume')
                ->select(
                    't1.precio AS precio_e',
                    't2.id AS id_perfume',
                    't2.nombre AS nombre',
                    DB::raw("(CASE WHEN t2.sexo='H' THEN 'Para Caballero' END) as sexo"),
                    't2.contenido AS contenido',
                    't2.presentacion AS presentacion',
                    't2.descripcion AS descripcion',
                    't2.precio_c AS precio_f',
                    't2.precio_c AS precio_o',
                    't3.nombre AS designer')
                ->where('t2.estado', '!=', 0)
                ->where('t2.sexo', '=', 'H')
                ->get();

            return response()->json($p_caballero);
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
