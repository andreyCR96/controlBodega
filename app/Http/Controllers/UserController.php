<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        //Desbloquear cuando este el login
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth()->user()->role == 1) {
            $users = User::select('id', 'name', 'surname', 'role', 'email','servicio')->orderBy('id')->get();
            return view('usuarios.usuarios', array(
                'users' => $users
            ));
        } else {
            abort('404');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth()->user()->role == 1) {
            return view('usuarios.usuariosForm');
        } else {
            abort('404');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth()->user()->role == 1) {
            $validatedData = $this->validate($request, [
                'name' => 'required',
                'surname' => 'required',
                'email' => 'required',
                'tUsuario' => 'required',
                'servicio' => 'required'
            ]);

            $existUsuario = User::where('email', $request->input('email'))->first();
            if ($existUsuario) {
                return redirect()->action('UserController@create')->with('status', 'Usuario ya se encuentra registrado');
            } else {
                $newUser = new User();
                $newUser->name = $request->input('name');
                $newUser->surname = $request->input('surname');
                $newUser->role = $request->input('tUsuario');
                $newUser->email = $request->input('email');
                $newUser->servicio = $request->input('servicio');
                $newUser->password = Hash::make('12345678');
                $newUser->save();
                return redirect()->action('UserController@index')->with('status', 'Usuario registrado correctamente');
            }
        } else {
            abort('404');
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
        if (Auth()->user()->role == 1) {
            $user = User::where('id', $id)->first();
            return view('usuarios.usuariosForm', array(
                'user' => $user
            ));
        } else {
            abort('404');
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
        if (Auth()->user()->role == 1) {
            $validatedData = $this->validate($request, [
                'name' => 'required',
                'surname' => 'required',
                'email' => 'required',
                'tUsuario' => 'required',
            ]);

            $newUser = User::find($id);
            $newUser->name = $request->input('name');
            $newUser->surname = $request->input('surname');
            $newUser->role = $request->input('tUsuario');
            $newUser->email = $request->input('email');
            $newUser->servicio = $request->input('servicio');
            $newUser->password = Hash::make('12345678');
            $newUser->save();
            return redirect()->action('UserController@index')->with('status', 'Usuario actualiado correctamente');
        } else {
            abort('404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth()->user()->role == 1) {
            $user = User::where('id', $id)->first();
            $user->delete();
            return redirect()->action('UserController@index')->with('status', 'Usuario eliminado correctamente');
        } else {
            abort('404');
        }
    }
}
