<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\constants\Constantes;
use App\Models\Producto;
use App\Models\Constante;
use App\Models\Cliente;
class ProductoController extends Controller
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

    public function index(Request $request)
    {
       if($request->has('marca')){
            $productos = Producto::with('marca','sexo')
                        ->whereHas('marca',function($query) use($request){
                            $query->where('id',$request->marca);
                        })->get();
            $marcaPerfume = $request->marca;
        }else{
            $productos = Producto::with('marca','sexo')->get();
            $marcaPerfume = '';          
        }
        $marcas    = Marca::all();
        $marcas    = $marcas->sortBy('nombre');
        return view('tablas',compact('productos','marcas','marcaPerfume'));
    }   
}

