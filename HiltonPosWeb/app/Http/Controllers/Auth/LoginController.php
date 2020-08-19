<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuarios;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        //$credentials = $request->only('email', 'password');
        $credentials = $this->validate(request(), [
            $this->username() => 'required|string',
            'password' => 'required|string'
        ]);

        $fecha_actual = date("Y-m-d");


        //Valida el campo para mostrar el error específico
        $user1 = Usuarios::orderBy('id','ASC')
            ->select('tbl_membresias.*')
            ->where('tbl_membresias.user_name', '=', $credentials['user_name'])
            ///->where('users.session_id', '=', 0)
            ->first();

        if ($user1 == '') {
            return Redirect::back()->withErrors([$this->username() => 'El Usuario y/o Contraseña son incorrectos'])
            ->withInput(request([$this->username()]));
        }

        if ($fecha_actual > $user1->vencimiento) {
            return Redirect::back()->withErrors([$this->username() => 'Membresia Vencida'])
            ->withInput(request([$this->username()]));
        }


        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/');
        }
        return Redirect::back()->withErrors([$this->username() => 'El Usuario y/o Contraseña son incorrectos'])
            ->withInput(request([$this->username()]));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
     public function username()
    {
            return 'user_name';
    }

}
