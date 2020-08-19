<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelMembresia;
use App\ModelSolicitudes;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MembresiaController extends Controller
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
            $membresias = DB::table('tbl_membresias')
                ->select(
                    'tbl_membresias.id AS id',
                    'tbl_membresias.clase AS clase',
                    'tbl_membresias.user_name AS nombre_usuario',
                    'tbl_membresias.contrasena AS contrasena',
                    'tbl_membresias.name AS nombre',
                    'tbl_membresias.apellido_paterno AS apellido_paterno',
                    'tbl_membresias.apellido_materno AS apellido_materno',
                    DB::raw("CONCAT(tbl_membresias.name,' ',tbl_membresias.apellido_paterno,' ',tbl_membresias.apellido_materno) as nombre_completo"),
                    'tbl_membresias.empresa AS empresa',
                    'tbl_membresias.rfc AS rfc',
                    'tbl_membresias.domicilio AS domicilio',
                    'tbl_membresias.telefono_local AS telefono_local',
                    'tbl_membresias.telefono_celular AS telefono_celular',
                    'tbl_membresias.nextel AS nextel',
                    'tbl_membresias.email AS email',
                    'tbl_membresias.fecha_alta AS fecha_alta',
                    'tbl_membresias.antiguedad AS antiguedad',
                    'tbl_membresias.vencimiento AS vencimiento',
                    'tbl_membresias.estado AS estado')
                ->get();

            return response()->json($membresias);
         
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        /*$membresias = DB::table('tbl_membresias')
            ->select('tbl_membresias.*')
            ->where('tbl_membresias.password', '=', '')
            ->get();

        foreach ($membresias as $t) {
            $membership = ModelMembresia::where('id', '=', $t->id)->update(array(
            'password' => Hash::make( $t->contrasena)));
            //$ejemplo = $t->id;
        }

        return response()->json(array(
            'status' => true,
        ));*/
    }
    public function solicitud(Request $request)
    {
        $membresia = new ModelMembresia();
        $membresia->clase = 'C';
        $membresia->user_name = $request->nombre_usuario;
        $membresia->password = Hash::make($request->contrasena);
        $membresia->contrasena = $request->contrasena;
        $membresia->name = $request->nombre;
        $membresia->apellido_paterno = $request->apellido_paterno;
        $membresia->apellido_materno = $request->apellido_materno;
        $membresia->empresa = $request->empresa;
        $membresia->rfc = $request->rfc;
        $membresia->domicilio = $request->domicilio;
        $membresia->telefono_local = $request->telefono_local;
        $membresia->telefono_celular = $request->telefono_celular;
        $membresia->nextel = $request->nextel;
        $membresia->email = $request->email;
        $membresia->fecha_alta = $fecha_actual = date("Y-m-d");
        $membresia->antiguedad = $fecha_actual1 = date("Y-m-d");
        $membresia->vencimiento = $fecha_actual2 = date("Y-m-d");
        $membresia->estado = 1;
        $membresia->save();

        $id_membresia = $membresia->id;

        $solicitudes = new ModelSolicitudes();
        $solicitudes->id_usuario = $id_membresia;
        $solicitudes->fecha = $fecha_actual3 = date("Y-m-d");
        $solicitudes->estado = 1;
        $solicitudes->save();

        return response()->json(array(
            'status' => true
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $membresia = new ModelMembresia();
        $membresia->clase = $request->clase;
        $membresia->user_name = $request->nombre_usuario;
        $membresia->password =  Hash::make($request->contrasena);
        $membresia->contrasena = $request->contrasena;
        $membresia->name = $request->nombre;
        $membresia->apellido_paterno = $request->apellido_paterno;
        $membresia->apellido_materno = $request->apellido_materno;
        $membresia->empresa = $request->empresa;
        $membresia->rfc = $request->rfc;
        $membresia->domicilio = $request->domicilio;
        $membresia->telefono_local = $request->telefono_local;
        $membresia->telefono_celular = $request->telefono_celular;
        $membresia->nextel = $request->nextel;
        $membresia->email = $request->email;
        $membresia->fecha_alta = $request->fecha_alta;
        $membresia->antiguedad = $request->antiguedad;
        $membresia->vencimiento = $request->vencimiento;
        $membresia->estado = $request->estado;;
        $membresia->save();

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
        $membresias = ModelMembresia::where('id', '=', $id)->update(array(
            'estado' => 2));

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
        $agente = ModelMembresia::where('id', '=', $request->id)->update(array(
            'clase' => $request->clase,
            'user_name' => $request->nombre_usuario,
            'password' =>  Hash::make($request->contrasena),
            'contrasena' => $request->contrasena,
            'name' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'empresa' => $request->empresa,
            'rfc' => $request->rfc,
            'domicilio' => $request->domicilio,
            'telefono_local' => $request->telefono_local,
            'telefono_celular' => $request->telefono_celular,
            'nextel' => $request->nextel,
            'email' => $request->email,
            'fecha_alta' => $request->fecha_alta,
            'antiguedad' => $request->antiguedad,
            'vencimiento' => $request->vencimiento,
            'estado' => $request->estado));

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
        $designers = ModelMembresia::where('id', '=', $id)->update(array(
            'estado' => 0));

        return response()->json(array(
            'status' => true
        ));
    }
}
