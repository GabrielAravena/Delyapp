<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventario;
use App\Compras_historicas;
use App\Desperdicio;
use App\Detalle_desperdicio;
use App\Gastos_fijos;
use App\Productos;
use App\Ingredientes;
use App\Local;
use App\Mermas;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Mail;
use App\Mail\CambioEnPrecioSugerido;

class InventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function index(Request $request)
    {

        $request->user()->authorizeRoles(['admin']);

        $local_id = $request->user()->local_id;

        $inventarios = Inventario::where('local_id', $local_id)->get();

        return view('inventario', compact('inventarios', 'local_id'));
    }

    protected function create($local_id, Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        if ($local_id = $request->user()->local_id) {

            $mermas = Mermas::all();
            return view('nuevoIngrediente', compact('mermas'));
        }
        return redirect()->route('inicioAdmin.index');
    }

    protected function store(Request $request)
    {

        $local_id = $request->user()->local_id;

        $valor = request('precio') * request('cantidad');

        $merma = Mermas::find(request('mermaId'));

        $inventario =   Inventario::create([
            'nombre' => $merma->nombre,
            'cantidad' => request('cantidad'),
            'unidad_medida' => request('unidad_medida'),
            'valor' => $valor,
            'pmp' => request('precio'),
            'ultimo_precio' => request('precio'),
            'merma' => $merma->porcentaje,
            'local_id' => $local_id,

        ]);

        Compras_historicas::create([
            'nombre' => $inventario->nombre,
            'cantidad' => $inventario->cantidad,
            'unidad_medida' => $inventario->unidad_medida,
            'valor' => $inventario->valor,
            'inventario_id' => $inventario->id,
        ]);

        return redirect()->route('inventario.index')->with('mensaje', ' El ingrediente se creó correctamente.');
    }

    protected function comprar($inventario_id, Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $local_id = $request->user()->local_id;

        $inventario = Inventario::where('id', $inventario_id)->where('local_id', $local_id)->first();

        if ($inventario) {
            return view('compraIngrediente', compact('inventario'));
        } else {
            return redirect()->route('inventario.index');
        }
    }

    protected function compra(Request $request, Inventario $inventario)
    {
        Compras_historicas::create([
            'nombre' => $inventario->nombre,
            'cantidad' => request('cantidad'),
            'unidad_medida' => $inventario->unidad_medida,
            'valor' => request('valor'),
            'inventario_id' => $inventario->id,
        ]);

        $sumaValores = Compras_historicas::where('inventario_id', $inventario->id)
        ->whereDate('created_at', '>=', Carbon::now()->add(-3, 'month')->format('Y-m-d'))
        ->sum('valor');

        $cantidadinventario = $inventario->cantidad + request('cantidad');

        $precioMedioPonderado = $sumaValores / $cantidadinventario;

        $inventario = Inventario::find($inventario->id);
        $inventario->cantidad = $cantidadinventario;
        $inventario->valor = $precioMedioPonderado * $cantidadinventario;
        $inventario->pmp = $precioMedioPonderado;
        $inventario->ultimo_precio = (request('valor') / request('cantidad'));
        $inventario->save();

        $this->recalcularPrecioSugerido($request, $inventario);


        return redirect()->route('inventario.index')->with('mensaje', ' Se registró la compra de ingrediente correctamente.');
    }

    protected function delete($inventario_id, Request $request)
    {

        $request->user()->authorizeRoles(['admin']);

        $local_id = $request->user()->local_id;

        $inventario = Inventario::where('id', $inventario_id)->where('local_id', $local_id)->get()->first();

        if ($inventario) {
            $compras_historicas = Compras_historicas::where('inventario_id', $inventario->id);
            $compras_historicas->delete();

            $ingredientes = Ingredientes::where('inventario_id', $inventario->id)->get();

            foreach ($ingredientes as $ingrediente) {
                $producto = Productos::find($ingrediente->producto_id);
                Productos::eliminar($producto);
            }

            $ingredientes = Ingredientes::where('inventario_id', $inventario->id);
            $ingredientes->delete();

            Inventario::destroy($inventario->id);
        }
        return redirect()->route('inventario.index')->with('mensaje', ' El ingrediente se eliminó correctamente.');
    }

    protected function realizarInventario(Request $request)
    {

        $request->user()->authorizeRoles(['admin']);

        $local_id = $request->user()->local_id;

        $inventarios = Inventario::where('local_id', $local_id)->get();

        return view('realizarInventario', compact('inventarios'));
    }

    protected function ingresarInventario(Request $request)
    {

        $local_id = $request->user()->local_id;

        $inventarios = Inventario::where('local_id', $local_id)->get();

        $desperdicio = Desperdicio::create([
            'local_id' => $local_id,
        ]);

        foreach ($inventarios as $inventario) {

            Detalle_desperdicio::create([
                'nombre' => $inventario->nombre,
                'cantidad' => request($inventario->id),
                'desperdicio' => $inventario->cantidad - request($inventario->id),
                'unidad_medida' => $inventario->unidad_medida,
                'valor_desperdiciado' => ($inventario->cantidad - request($inventario->id)) * $inventario->pmp,
                'desperdicio_id' => $desperdicio->id,
            ]);

            $inventario->cantidad = request($inventario->id);
            $inventario->valor = request($inventario->id) * $inventario->pmp;
            $inventario->save();
        }
        return redirect()->route('inventario.index')->with('mensaje', 'El inventario se ha actualizado correctamente');
    }

    protected function perdidas(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);

        $local_id = $request->user()->local_id;

        $perdidas = Desperdicio::where('local_id', $local_id)->get();

        $ultimosDoceMeses = $this->ultimosDoceMeses();

        $perdidasDoceMeses = $this->perdidasDoceMeses($local_id);

        $infoMes = ["ultimosDoceMeses" => $ultimosDoceMeses, "perdidasDoceMeses" => $perdidasDoceMeses];
        $infoMes = (object)($infoMes);


        return view('perdidas', compact('perdidas', 'infoMes'));
    }

    protected function detallePerdida(Request $request, $perdida_id){

        $request->user()->authorizeRoles(['admin']);

        $local_id = $request->user()->local_id;

        $desperdicio = Desperdicio::where('local_id', $local_id)->where('id', $perdida_id)->limit(1)->get();

        $detalleDesperdicio = Detalle_desperdicio::where('desperdicio_id', $desperdicio[0]->id)->get();

        $totalPerdida = 0;
        foreach($detalleDesperdicio as $detalle){
            $totalPerdida += $detalle->valor_desperdiciado;
        } 

        return view('detallePerdida', compact('detalleDesperdicio', 'totalPerdida', 'perdida_id'));
    }

    protected function comprasIngredientes(Request $request){

        $request->user()->authorizeRoles(['admin']);
        $local_id = $request->user()->local_id;

        return view('comprasIngredientes', compact('local_id'));
    }

    protected function buscarComprasIngredientes(Request $request, $local_id){

        if($local_id == $request->user()->local_id){
            $compras = Compras_historicas::where('inventarios.local_id', $local_id)
            ->join('inventarios', 'inventarios.id', 'compras_historicas.inventario_id')
            ->select('compras_historicas.*', 'inventarios.local_id')
            ->whereBetween('compras_historicas.created_at', [$request->desde, $request->hasta])
            ->get();

            return view('comprasIngredientes2', compact('compras', 'local_id'));
        }

        return redirect()->route('inventario.comprasIngredientes');
    }

    protected function descargarComprasIngredientes(Request $request, $desde, $hasta){

        $request->user()->authorizeRoles(['admin']);

        $local_id = $request->user()->local_id;

        $compras = Compras_historicas::where('inventarios.local_id', $local_id)
            ->join('inventarios', 'inventarios.id', 'compras_historicas.inventario_id')
            ->select('compras_historicas.*', 'inventarios.local_id')
            ->whereBetween('compras_historicas.created_at', [$request->desde, $request->hasta])
            ->get();

        $spreadsheetResultado = new Spreadsheet();
        $hoja = $spreadsheetResultado->getActiveSheet();

        $titulosTabla = ["NOMBRE", "CANTIDAD", "UNIDAD DE MEDIDA", "VALOR", "FECHA REGISTRO"];

        $columna = 1;
        foreach($titulosTabla as $titulo){
            $hoja->setCellValueByColumnAndRow($columna, 1, $titulo);
            $columna++;
        }
        
        $fila = 2;
        foreach($compras as $compra){
            $hoja->setCellValueByColumnAndRow(1, $fila, $compra->nombre);
            $hoja->setCellValueByColumnAndRow(2, $fila, $compra->cantidad);
            $hoja->setCellValueByColumnAndRow(3, $fila, $compra->unidad_medida);
            $hoja->setCellValueByColumnAndRow(4, $fila, $compra->valor);
            $hoja->setCellValueByColumnAndRow(5, $fila, $compra->created_at);

            $fila++;
        }
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment;filename=Compras de ingredientes (desde:".$desde.", hasta:".$hasta.").xlsx");
            header('Cache-Control: max-age=0');

            $writer = IOFactory::createWriter($spreadsheetResultado, 'Xlsx');
            $writer->save('php://output');

            exit;
        
    }

    private function ultimosDoceMeses()
    {

        $n = date("n");

        $meses = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];
        $ultimosDoce = [];

        for ($i = 0; $i < 12; $i++) {
            if ($n >= 12) {
                $n -= 12;
            }
            $ultimosDoce[] = $meses[$n];
            $n++;
        }
        return $ultimosDoce;
    }

    private function perdidasDoceMeses($local_id)
    {

        $perdidas = Desperdicio::where('local_id', $local_id)
            ->whereMonth('created_at', '>=', date('n') - 12)
            ->limit(12)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            });

        $perdidasDoceMeses = [];
        for ($i = 1; $i < 12; $i++) {

            $perdidasDoceMeses[$i] = 0;
        }
     
        foreach ($perdidas as $fecha => $perdida) {

            $detalle_desperdicio = Detalle_desperdicio::where('desperdicio_id', $perdida[0]->id)->get()->sum('valor_desperdiciado');

            $mes = date('n', strtotime($fecha));

            $perdidasDoceMeses[$mes-1] = $detalle_desperdicio;
        }

        $perdidasDoceMeses2 = [];
        foreach($perdidasDoceMeses as $indice => $valor){

            $perdidasDoceMeses2[] = $valor; 
        }
       
        return $perdidasDoceMeses2;
    }

    protected function descargarDetallePerdida(Request $request, $perdida_id){

        $request->user()->authorizeRoles(['admin']);

        $local_id = $request->user()->local_id;

        $desperdicio = Desperdicio::where('local_id', $local_id)->where('id', $perdida_id)->limit(1)->get();

        $detalleDesperdicio = Detalle_desperdicio::where('desperdicio_id', $desperdicio[0]->id)->get();

        
        $spreadsheetResultado = new Spreadsheet();
        $hoja = $spreadsheetResultado->getActiveSheet();

        $titulosTabla = ["NOMBRE", "CANTIDAD DESPERDICIADA", "UNIDAD DE MEDIDA", "VALOR DESPERDICIADO", "FECHA DE REGISTRO"];

        $columna = 1;
        foreach($titulosTabla as $titulo){
            $hoja->setCellValueByColumnAndRow($columna, 1, $titulo);
            $columna++;
        }

        $fila = 2;
        foreach($detalleDesperdicio as $detalle){
            $hoja->setCellValueByColumnAndRow(1, $fila, $detalle->nombre);
        
            $hoja->setCellValueByColumnAndRow(2, $fila, $detalle->desperdicio);
            $hoja->setCellValueByColumnAndRow(3, $fila, $detalle->unidad_medida);
            $hoja->setCellValueByColumnAndRow(4, $fila, $detalle->valor_desperdiciado);
            $hoja->setCellValueByColumnAndRow(5, $fila, $detalle->created_at);
            $fila++;
        }
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=Pérdidas(".$desperdicio[0]->created_at.").xlsx");
        header('Cache-Control: max-age=0');

        $writer = IOFactory::createWriter($spreadsheetResultado, 'Xlsx');
        $writer->save('php://output');

        exit;

    }

    private function recalcularPrecioSugerido($request, $inventario){

        $ingredientes = Ingredientes::where('inventario_id', $inventario->id)->get();

        $productos = [];
        foreach($ingredientes as $ingrediente){

            $unidadMedidaInv = $inventario->unidad_medida;
            $unidadMedidaIng = $ingrediente->unidad_medida;

            if ($unidadMedidaInv == $unidadMedidaIng) {
                $valorActual = $inventario->pmp * $ingrediente->cantidad;
            } elseif (($unidadMedidaInv == 'Kilogramo' && $unidadMedidaIng == 'Gramo') || ($unidadMedidaInv == 'Litro' && $unidadMedidaIng == 'Ml')) {
                $valorActual = (($inventario->pmp / 1000) * $ingrediente->cantidad);
            } elseif (($unidadMedidaInv == 'Gramo' && $unidadMedidaIng == 'Kilogramo') || ($unidadMedidaInv == 'Ml' && $unidadMedidaIng == 'Litro')) {
                $valorActual = (($inventario->pmp * 1000) * $ingrediente->cantidad);
            } 

            $ingrediente->valor = $valorActual;
            $ingrediente->save();

            $ingredientesProducto = Ingredientes::where('producto_id', $ingrediente->producto_id)->get();

            $sumaPreciosIngredientes = 0;
            foreach($ingredientesProducto as $ingredienteProducto){
                $sumaPreciosIngredientes += $ingredienteProducto->valor * (100 / (100 - $ingredienteProducto->merma));
            }

            $local = Local::find($inventario->local_id);

            $gastosFijos = Gastos_fijos::where('local_id', $local->id)->sum('monto');

            $porcentajeGasto = ($gastosFijos/$local->ingreso_mensual);

            $precioSugerido = round((($sumaPreciosIngredientes / (1 - ($local->ganancia/100)))*(1 + $porcentajeGasto)) * 1.19, -2);
            
            $producto = Productos::find($ingrediente->producto_id);
            $producto->precio_sugerido = $precioSugerido;
            $producto->save();

            $diferencia = $precioSugerido - $producto->precio;

            if($diferencia > $producto->precio * 0.2 || $diferencia < -1 * ($producto->precio * 0.2)){
                $productos[] = $producto; 
            }
        }

        if(count($productos) > 0){

            Mail::to($request->user()->email)->send(new CambioEnPrecioSugerido($productos));

        }
    }
}
