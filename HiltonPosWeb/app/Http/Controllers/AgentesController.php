<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelAgentes;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AgentesController extends Controller
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
            $agentes = DB::table('tbl_agentes')
                ->select(
                    'tbl_agentes.id_agente AS id',
                    'tbl_agentes.nombre_usuario AS nombre_usuario',
                    'tbl_agentes.contrasena AS contrasena',
                    DB::raw("CONCAT(tbl_agentes.nombre,' ',tbl_agentes.apellido_paterno,' ',tbl_agentes.apellido_materno) as nombre_completo"),
                    'tbl_agentes.nombre AS nombre',
                    'tbl_agentes.apellido_paterno AS apellido_paterno',
                    'tbl_agentes.apellido_materno AS apellido_materno',
                    'tbl_agentes.telefono_local AS telefono_local',
                    'tbl_agentes.telefono_celular AS telefono_celular',
                    'tbl_agentes.nextel AS nextel',
                    'tbl_agentes.email AS email',
                    'tbl_agentes.estado AS estado',
                    'tbl_agentes.fecha_alta AS fecha_alta')
                ->get();

            return response()->json($agentes);
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
        $agente = new ModelAgentes();
        $agente->fecha_alta = $request->fecha_alta;
        $agente->nombre = $request->nombre;
        $agente->apellido_paterno = $request->apellido_paterno;
        $agente->apellido_materno = $request->apellido_materno;
        $agente->telefono_local = $request->telefono_local;
        $agente->telefono_celular = $request->telefono_celular;
        $agente->nextel = $request->nextel;
        $agente->nombre_usuario = $request->nombre_usuario;
        $agente->contrasena = $request->contrasena;
        $agente->email = $request->email;
        $agente->estado = 1;
        $agente->save();

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
        $agente = ModelAgentes::where('id_agente', '=', $id)->update(array(
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
        $agente = ModelAgentes::where('id_agente', '=', $request->id)->update(array(
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'telefono_local' => $request->telefono_local,
            'telefono_celular' => $request->telefono_celular,
            'nextel' => $request->nextel,
            'nombre_usuario' => $request->nombre_usuario,
            'contrasena' => $request->contrasena,
            'email' => $request->email,
            'estado' => 1,
            'fecha_alta' => $request->fecha_alta));

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
        $agente = ModelAgentes::where('id_agente', '=', $id)->update(array(
            'estado' => 0));

        return response()->json(array(
            'status' => true
        ));
    }
}
