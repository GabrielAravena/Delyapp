<?php

namespace App\Http\Controllers;

use App\Ventas;
use App\Productos_user;
use App\Productos;
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

        /* info grafico MES */
        $ventasMes = $this->ventasMes();

        $ventasMesPorDia = $this->ventasMesPorDia();

        $diasMesActual = $this->diasMesActual();

        $infoMes = ["ventasMes" => $ventasMes, "ventasMesPorDia" => $ventasMesPorDia, "diasMesActual" => $diasMesActual];
        $infoMes = (object)($infoMes);

        /* Info gráfico SEMANA */
        $ventasSemana = $this->ventasSemana();

        $ventasSemanaPorDia = $this->ventasSemanaPorDia();

        $infoSemana = ["ventasSemana" => $ventasSemana, "ventasSemanaPorDia" => $ventasSemanaPorDia];
        $infoSemana = (object)($infoSemana);

        /* Info día */
        $ventasDia = $this->ventasDia();

        return view('inicio-admin', compact('infoMes', 'infoSemana', 'ventasDia'));
    }

    protected function diasMesActual()
    {
        $numeroDias = cal_days_in_month(CAL_GREGORIAN, date('m'), date('y'));
        for ($i = 1; $i <= $numeroDias; $i++) {
            $numeros[] = $i;
        }
        return $numeros;
    }

    protected function ventasMesPorDia()
    {

        $ventasMesPorDia = Ventas::select('created_at', 'precio')->where('estado', 'finalizado')->whereMonth('created_at', date('m'))->addSelect(['producto_id' => Productos_user::select('producto_id')
            ->whereColumn('ventas_id', 'ventas.id')->limit(1)])->addSelect(['local_id' => Productos::select('local_id')
            ->whereColumn('producto_id', 'productos.id')])->get()->where('local_id', 1)->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

        $precioVentasMesPorDia = [];
        foreach ($ventasMesPorDia as $fecha => $ventasPorDia) {
            $sumaPrecios = 0;
            foreach ($ventasPorDia as $venta) {
                $sumaPrecios += $venta->precio;
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

    protected function ventasMes()
    {

        return Ventas::where('estado', 'finalizado')->whereMonth('created_at', date('m'))->addSelect(['producto_id' => Productos_user::select('producto_id')
            ->whereColumn('ventas_id', 'ventas.id')->limit(1)])->addSelect(['local_id' => Productos::select('local_id')
            ->whereColumn('producto_id', 'productos.id')])->get()->where('local_id', 1)->sum('precio');
    }

    protected function ventasSemana()
    {

        if (date("D") == "Mon") {
            $week_start = date("Y-m-d");
        } else {
            $week_start = date("Y-m-d", strtotime('last Monday', time()));
        }

        return Ventas::where('estado', 'finalizado')->where('created_at', '>=', $week_start)->addSelect(['producto_id' => Productos_user::select('producto_id')
            ->whereColumn('ventas_id', 'ventas.id')->limit(1)])->addSelect(['local_id' => Productos::select('local_id')
            ->whereColumn('producto_id', 'productos.id')])->get()->where('local_id', 1)->sum('precio');
    }

    protected function ventasSemanaPorDia()
    {

        if (date("D") == "Mon") {
            $week_start = date("Y-m-d");
        } else {
            $week_start = date("Y-m-d", strtotime('last Monday', time()));
        }

        $ventasSemanaPorDia = Ventas::where('estado', 'finalizado')->where('created_at', '>=', $week_start)->addSelect(['producto_id' => Productos_user::select('producto_id')
            ->whereColumn('ventas_id', 'ventas.id')->limit(1)])->addSelect(['local_id' => Productos::select('local_id')
            ->whereColumn('producto_id', 'productos.id')])->get()->where('local_id', 1)->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });;

        $precioVentasSemanaPorDia = [];
        foreach ($ventasSemanaPorDia as $fecha => $ventasDia) {
            $precioVentasDia = 0;
            foreach ($ventasDia as $venta) {
                $precioVentasDia += $venta->precio;
            }
            $precioVentasSemanaPorDia[date("w", strtotime($fecha))] = $precioVentasDia;
        }

        $ventaPorDia = [];
        for($i=1; $i <= 7; $i++){
            if(isset($precioVentasSemanaPorDia[$i])){
                $ventaPorDia[] = $precioVentasSemanaPorDia[$i];
            }else{
                $ventaPorDia[] = 0;
            }
        }
        return $ventaPorDia;
    }

    protected function ventasDia(){
        return Ventas::where('estado', 'finalizado')->where('created_at', ">=", date("Y-m-d"))->addSelect(['producto_id' => Productos_user::select('producto_id')
            ->whereColumn('ventas_id', 'ventas.id')->limit(1)])->addSelect(['local_id' => Productos::select('local_id')
            ->whereColumn('producto_id', 'productos.id')])->get()->where('local_id', 1)->sum('precio');
    }
}
