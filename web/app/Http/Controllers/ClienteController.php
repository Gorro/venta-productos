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
    public function finalizar(Request $request)
    {
        $productos = json_decode($request->data);
        $productoModel = [];
        foreach ($productos as $producto) {
            $data = [
                'id' => $producto->idProducto,
                'nombre' => Producto::find($producto->idProducto)->nombre,
                'cantidad' => $producto->cantidad,
                'precio' => Producto::find($producto->idProducto)->precio_venta,
                'total' => $producto->cantidad * Producto::find($producto->idProducto)->precio_venta
            ];
            array_push($productoModel, $data);
        }
        return view('finalizar_compra', compact('productoModel'));
    } 
}

