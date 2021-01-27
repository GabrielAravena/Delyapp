<?php

namespace App\Http\Controllers;

use App\Inventario;
use App\Local;
use App\Productos;
use App\Registro_ventas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InicioAdminController extends Controller
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

        $local = Local::find($local_id);

        /* info grafico MES */
        $ventasMes = $this->ventasMes($local_id);

        $ventasMesPorDia = $this->ventasMesPorDia($local_id);

        $diasMesActual = $this->diasMesActual();

        $infoMes = ["ventasMes" => $ventasMes, "ventasMesPorDia" => $ventasMesPorDia, "diasMesActual" => $diasMesActual];
        $infoMes = (object)($infoMes);

        /* Info gráfico SEMANA */
        $ventasSemana = $this->ventasSemana($local_id);

        $ventasSemanaPorDia = $this->ventasSemanaPorDia($local_id);
 
        $infoSemana = ["ventasSemana" => $ventasSemana, "ventasSemanaPorDia" => $ventasSemanaPorDia];
        $infoSemana = (object)($infoSemana);

        /* Info día */
        $ventasDia = $this->ventasDia($local_id);

        return view('inicio-admin', compact('infoMes', 'infoSemana', 'ventasDia', 'local'));
    }

    protected function activar(Request $request)
    {

        $request->user()->authorizeRoles(['admin']);

        $local_id = $request->user()->local_id;

        $local = Local::find($local_id);

        if ($local->estado == 'activado') {
            $local->estado = 'desactivado';
            $local->save();
        } else {
            $productos = Productos::where('local_id', $local_id)->first();
            if($productos){
                $local->estado = 'activado';
                $local->save();
            }else{
                return redirect()->route('inicioAdmin.index')->with('error', 'Antes de activar tu local, es necesario que agregues productos a tu menú.');
            }
        }
        return redirect()->route('inicioAdmin.index');
    }

    protected function diasMesActual()
    {
        $numeroDias = cal_days_in_month(CAL_GREGORIAN, date('m'), date('y'));
        for ($i = 1; $i <= $numeroDias; $i++) {
            $numeros[] = $i;
        }
        return $numeros;
    }

    protected function ventasMesPorDia($local_id)
    {
        $ventasMesPorDia = Registro_ventas::select('updated_at', 'valor')
            ->where('local_id', $local_id)
            ->whereMonth('updated_at', date('m'))
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->updated_at)->format('Y-m-d');
            });

        $precioVentasMesPorDia = [];
        foreach ($ventasMesPorDia as $fecha => $ventasPorDia) {
            $sumaPrecios = 0;
            foreach ($ventasPorDia as $venta) {
                $sumaPrecios += $venta->valor;
            }
            $precioVentasMesPorDia[idate("d", strtotime($fecha))] = $sumaPrecios;
        }

        $ventaPorDia = [];
        $numeroDias = cal_days_in_month(CAL_GREGORIAN, date('m'), date('y'));
        for ($i = 1; $i <= $numeroDias; $i++) {
            if (isset($precioVentasMesPorDia[$i])) {
                $ventaPorDia[] = $precioVentasMesPorDia[$i];
            } else {
                $ventaPorDia[] = 0;
            }
        }
        return $ventaPorDia;
    }

    protected function ventasMes($local_id)
    {
        return Registro_ventas::where('local_id', $local_id)
            ->whereMonth('updated_at', date('m'))
            ->get()
            ->sum('valor');
    }

    protected function ventasSemana($local_id)
    {

        if (date("D") == "Mon") {
            $week_start = date("Y-m-d");
        } else {
            $week_start = date("Y-m-d", strtotime('last Monday', time()));
        }

        return Registro_ventas::where('local_id', $local_id)
            ->where('updated_at', '>=', $week_start)
            ->get()
            ->sum('valor');
    }

    protected function ventasSemanaPorDia($local_id)
    {
        if (date("D") == "Mon") {
            $week_start = date("Y-m-d");
        } else {
            $week_start = date("Y-m-d", strtotime('last Monday', time()));
        }

        $ventasSemanaPorDia = Registro_ventas::where('local_id', $local_id)
            ->where('updated_at', '>=', $week_start)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->updated_at)->format('Y-m-d');
            });
     
        $precioVentasSemanaPorDia = [];
        foreach ($ventasSemanaPorDia as $fecha => $ventasDia) {
 
            $precioVentasDia = 0;
            foreach ($ventasDia as $venta) {
                $precioVentasDia += $venta->valor;
            }
            $precioVentasSemanaPorDia[date("N", strtotime($fecha))] = $precioVentasDia;
        }

        $ventaPorDia = [];
        for ($i = 1; $i <= 7; $i++) {
            if (isset($precioVentasSemanaPorDia[$i])) {
                $ventaPorDia[] = $precioVentasSemanaPorDia[$i];
            } else {
                $ventaPorDia[] = 0;
            }
        }

        return $ventaPorDia;
    }

    protected function ventasDia($local_id)
    {
        return Registro_ventas::where('local_id', $local_id)->where('updated_at', ">=", date("Y-m-d"))
            ->get()
            ->sum('valor');
    }
}
