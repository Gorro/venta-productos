<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use App\constants\Constantes;
use App\Models\Producto;
use App\Models\Constante;
use App\Models\Cliente;
class HomeController extends Controller
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
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('home');
    }

    public function insertMarcas()
    {
        $marcas = [
        'ANTONIO BANDERAS',
        'ABERCROMBIE',
        'AGATHA RUIZ',
        'ANTONIO PUIG',
        'ANIMALE',
        'ARAMIS',
        'AZZARO',
        'BEYONCE',
        'BEBE',
        'BRITNEY SPEARS',
        'BOND',
        'BENETTON',
        'BOUCHERON',
        'BURBERRY',
        'BVLGARI',
        'CAROLINA HERRERA',
        'CRISTIANO RONALDO',
        'COACH',
        'CHLOE',
        'CACHAREL',
        'GRESS',
        'CALVIN KLEIN',
        'CARTIER',
        'COUTURE',
        'CRISTION DIOR',
        'CANDY CRUSH',
        'CUBA',
        'CLINIQUE',
        'DOLCE & GABBANA',
        'DADDY YANKEE',
        'DAVIDOFF',
        'DISNEY',
        'DIESEL',
        'DONNA KARAN',
        'DUNHILL',
        'ELIZABETH ARDEN',
        'ERMENEGILDO ZEGNA',
        'EMANUEL UNGARO',
        'ESCADA',
        'ESTEE LAUDER',
        'FERRARI',
        'GIORGIO ARMANI',
        'G. BEVERLY HILLS',
        'GIVENCHY',
        'GUESS',
        'GUERLAIN',
        'GUCCI',
        'GUY LAROCHE',
        'GLORIA VANDERBILT',
        'HERMES',
        'HOLLYSTER',
        'HALSTON',
        'HUGO BOSS',
        'ISSEY MIYAKE',
        'JESSICA SIMPSON',
        'JESUS DEL POZO',
        'JIMMY CHOO',
        'JENNIFER LOPEZ',
        'JEAN PAUL GAULTIER',
        'JEANNE ARTHES',
        'JOOP',
        'JOVAN MUSK',
        'JUSTIN BIEBER',
        'KATY PERRY',
        'KARL LAGERFIELD',
        'KENZO',
        'LIZ CLAIBORNE',
        'LOLITA LEMPICKA',
        'LACOSTE',
        'LANVIN',
        'LAPIDUS',
        'LANCOME',
        'MOLINEAUX',
        'MICHAEL KORS',
        'MISCELANEO',
        'MARC JACOBS',
        'MONT BLANC',
        'MOSCHINO',
        'NAUTICA',
        'NICKY MINAJ',
        'NINA RICCI',
        'ONE DIRECTION',
        'OSCAR DE LA RENTA',
        'PUMA',
        'PALOMA PICASSO',
        'PACO RABANNE',
        'PINO SILVESTRE',
        'PARIS HILTON',
        'RALPH LAUREN',
        'REVLON',
        'REALM',
        'RIHANNA',
        'ROCHAS',
        'SANDORA',
        'S. FERRAGAMO',
        'SALVADOR DALI',
        'SEX CITY',
        'SHAKIRA',
        'SWISS ARMY',
        'TERRY MUGLER',
        'TOUS',
        'TOMMY',
        'VELENTINO',
        'VICTORIA SECRET',
        'VIKTOR & ROLF',
        'VAN CLEEF',
        'VERSACE',
        'YVES SAINT LAURENT',
        'ZIPPO'];

        foreach ($marcas as $marca) {
            $marcaModel = new Marca();

            echo $marcaModel->insert(['nombre' => $marca]),'<br>';
        }
    }

    public function insertPRoductos()
    {
        $nombres = [
            'BLUE SEDUCTION DAMA 100 ML',
            'BLUE SEDUCTION DAMA 100 ML ESTUCHE',
            'BLUE SEDUCTION DAMA 200 ML',
            'BLUE SEDUCTION DAMA 100 ML TESTER',
            'BLACK SEDUCTION VARON 100 ML',
            'BLACK SEDUCTION VARON 200 ML',
            'BLUE SEDUCTION VARON 100  ML',
            'BLUE SEDUCTION VARON 200  ML',
            'BLUE SEDUCTION VARON 100  ML TESTER',
            'BLUE SEDUCTION  SPLASH 100 ML ESTUCHE',
            'KING SEDUCTION 100 ML NEW',
            'KING SEDUCTION 200 ML NEW',
            'SECRET VARON 100 ML',
            'SECRET VARON 200 ML',
            'SECRET VARON 100 ML TESTER',
            'SECRET DAMA 80 ML',
            'GOLDEN SECRET DAMA 80 ML',
            'GOLDEN SECRET DAMA 80 ML TESTER',
            'GOLDEN SECRET VARON 200 ML',
            'DIAVOLO VARON 100 ML',
            'DIAVOLO VARON 100 ML TESTER',
            'MEDITERRANEO VARON 100 ML',
            'MEDITERRANEO VARON 200 ML'
        ];
        $sexo = [
            'Mujer',
            'Mujer',
            'Mujer',
            'Mujer',
            'Hombre',
            'Hombre',
            'Hombre',
            'Hombre',
            'Hombre',
            'Hombre',
            'Hombre',
            'Hombre',
            'Hombre',
            'Hombre',
            'Hombre',
            'Mujer',
            'Mujer',
            'Mujer',
            'Hombre',
            'Hombre',
            'Hombre',
            'Hombre',
            'Hombre'
        ];
        $precioCompra = [
            '14900',
            '16900',
            '19900',
            '11900',
            '14900',
            '19900',
            '14900',
            '19900',
            '11900',
            '16900',
            '14900',
            '19900',
            '14900',
            '19900',
            '11900',
            '14900',
            '14900',
            '11900',
            '19900',
            '11900',
            '8900',
            '11900',
            '17900'
        ];
        $precioVenta = [
            '29900',
            '31900',
            '34900',
            '26900',
            '29900',
            '34900',
            '29900',
            '34900',
            '26900',
            '31900',
            '29900',
            '34900',
            '29900',
            '34900',
            '26900',
            '29900',
            '29900',
            '26900',
            '34900',
            '26900',
            '23900',
            '26900',
            '32900'
        ];
        $tamano = count($nombres);
        $i=0;
        for($i = 0; $i < $tamano; $i++){
            $producto = new Producto();
            if($sexo[$i] == 'Hombre'){
                $sexoId = 1; 
            }else{
                $sexoId = 2;
            }

            $producto->insert([
                'nombre' => $nombres[$i],
                'precio_compra' => $precioCompra[$i],
                'precio_venta'  => $precioVenta[$i],
                'sexo_id'       => $sexoId,
                'marca_id'      => 1

            ]);
        }
        return $i;
    }

    public function productos(Request $request)
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
    public function insertPerfumes()
    {
        if (($gestor = fopen("perfumes.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {

                $marcaId = Marca::where('nombre',$datos[0])->first()->id;
                $sexoId = Constante::where('nombre',$datos[2])->first()->id;
                $data = [
                    'nombre'        => $datos[1],
                    'precio_compra' => $datos[3],
                    'precio_venta'  => $datos[4],
                    'sexo_id'       => $sexoId,
                    'marca_id'      => $marcaId,
                ];
                $producto = new Producto();
                $producto->insert($data);
            }
            fclose($gestor);
            echo 'exito';
        }
    }
    public function clientes()
    {
        $clientes = Cliente::all();
        return view('clientes',compact('clientes'));
    }
}

