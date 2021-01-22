<?php

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Registro_ventas;
use App\Inventario;
use Illuminate\Http\Request;

class VentasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin']);
        $local_id = $request->user()->local_id;

        $inventario = Inventario::where('local_id', $local_id)->first();
        
        if(!$inventario){
            return redirect()->route('inventario.index')->with('primeraVez', 'Aún no has agregado ingredientes. El primer paso para utilizar la aplicación, es agregar los ingredientes que tienes en bodega, luego debes ingresar los gastos fijos de tu local y finalmente, puedes crear productos y comenzar a vender.');
        }

        return view('ventas', compact('local_id'));
    }

    protected function buscar(Request $request, $local_id){

        if($local_id == $request->user()->local_id){
            $ventas = Registro_ventas::where('registro_ventas.local_id', $local_id)
            ->whereBetween('registro_ventas.updated_at', [$request->desde, $request->hasta])
            ->leftJoin('users', 'users.id', '=', 'registro_ventas.users_id')
            ->leftJoin('invitados', 'invitados.id', '=', 'registro_ventas.invitado')
            ->select('registro_ventas.*', 'users.name as userNombre', 'users.email as userEmail', 'users.direccion as userDireccion', 'invitados.nombre as invitadoNombre', 'invitados.email as invitadoEmail', 'invitados.direccion as invitadoDireccion')
            ->get();

            return view('ventas2', compact('ventas', 'local_id'));
        }

        return redirect()->route('ventas.index');
    }

    protected function descargarDocumento(Request $request, $desde, $hasta){

        $request->user()->authorizeRoles(['admin']);

        $ventas = Registro_ventas::where('registro_ventas.local_id', $request->user()->local_id)
            ->whereBetween('registro_ventas.updated_at', [$desde, $hasta])
            ->leftJoin('users', 'users.id', '=', 'registro_ventas.users_id')
            ->leftJoin('invitados', 'invitados.id', '=', 'registro_ventas.invitado')
            ->select('registro_ventas.*', 'users.name as userNombre', 'users.email as userEmail', 'users.direccion as userDireccion', 'invitados.nombre as invitadoNombre', 'invitados.email as invitadoEmail', 'invitados.direccion as invitadoDireccion')
            ->get();

        $spreadsheetResultado = new Spreadsheet();
        $hoja = $spreadsheetResultado->getActiveSheet();

        $titulosTabla = ["ID", "CLIENTE", "CORREO", "TIPO", "VALOR", "FECHA/HORA"];

        $columna = 1;
        foreach($titulosTabla as $titulo){
            $hoja->setCellValueByColumnAndRow($columna, 1, $titulo);
            $columna++;
        }
        
        $fila = 2;
        foreach($ventas as $venta){
            $hoja->setCellValueByColumnAndRow(1, $fila, $venta->id);
            if($venta->users_id){
                $hoja->setCellValueByColumnAndRow(2, $fila, $venta->userNombre);
                $hoja->setCellValueByColumnAndRow(3, $fila, $venta->userEmail);
            }else{
                $hoja->setCellValueByColumnAndRow(2, $fila, $venta->invitadoNombre);
                $hoja->setCellValueByColumnAndRow(3, $fila, $venta->invitadoEmail);
            }
            $hoja->setCellValueByColumnAndRow(4, $fila, $venta->tipo);
            $hoja->setCellValueByColumnAndRow(5, $fila, $venta->valor);
            $hoja->setCellValueByColumnAndRow(6, $fila, $venta->updated_at);
            $fila++;
        }
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment;filename=Ventas(desde:".$desde.", hasta:".$hasta.").xlsx");
            header('Cache-Control: max-age=0');

            $writer = IOFactory::createWriter($spreadsheetResultado, 'Xlsx');
            $writer->save('php://output');

            exit;
        
    }
}
