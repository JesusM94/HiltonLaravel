<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelDesigner;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DesignerController extends Controller
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
            $designers = DB::table('tbl_designers')
                    ->select(
                          'tbl_designers.id AS id',
                          'tbl_designers.nombre AS nombre',
                          'tbl_designers.estado AS estado')
                    ->get();

            return response()->json($designers);
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
        $designers = new ModelDesigner();
        $designers->nombre = $request->nombre;
        $designers->estado = 1;
        $designers->save();

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
        $designers = ModelDesigner::where('id', '=', $id)->update(array(
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
        $designers = ModelDesigner::where('id', '=', $request->id)->update(array(
            'nombre' => $request->nombre));

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
        $designers = ModelDesigner::where('id', '=', $id)->update(array(
            'estado' => 0));

        return response()->json(array(
            'status' => true
        ));
    }
}
