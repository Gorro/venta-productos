<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\constants\Constantes;
use App\Models\Producto;
use App\Models\Constante;
use App\Models\Cliente;
class ClienteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes',compact('clientes'));
    }


    public function store(Request $request)
    {
        $cliente = new Cliente();
        $data    = [
            'nombre'        => $request->nombre,
            'direccion'     => $request->direccion,
            'telefono_fijo' => $request->telefono,
            'celular'       => $request->celular,
            'email'         => $request->email
        ];
        return response()->json(['insert' => $cliente->insert($data)]);
    }  
}

