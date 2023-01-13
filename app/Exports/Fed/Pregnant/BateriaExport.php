<?php

namespace App\Exports;
namespace App\Exports\Fed\Pregnant;

use App\Models\User;
// use Maatwebsite\Excel\Concerns\FromCollection;
use App\Invoice;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Carbon\Carbon;

class BateriaExport implements FromView, ShouldAutoSize
{
    protected $red;
    protected $dist;
    protected $anio;
    protected $mes;

    public function __construct($red, $dist, $anio, $mes)
    {
        $this->red=$red;
        $this->dist=$dist;
        $this->anio=$anio;
        $this->mes=$mes;
    }

    public function view(): View {

        $red = $this->red;
        $dist = $this->dist;
        $anio = $this->anio;
        $mes = $this->mes;

        $fecha = Carbon::parse($anio.'-'.$mes.'-01');
        $nameMonth = ($fecha->monthName);

        if ($red == '01') { $red = 'PASCO'; }
        elseif ($red == '02') { $red = 'DANIEL ALCIDES CARRION'; }
        elseif ($red == '03') { $red = 'OXAPAMPA'; }

        if($red == 'TODOS'){
            $nominal = DB::table('dbo.CONSOLIDADO_BATERIA')
                        ->select('*', (DB::raw("CASE WHEN (CAPTADA IS NULL OR TMZ_ANEMIA IS NULL OR SIFILIS IS NULL OR VIH IS NULL OR BACTERIURIA IS NULL) THEN 'NO'
                            WHEN (TMZ_ANEMIA=CAPTADA AND TMZ_ANEMIA=SIFILIS AND TMZ_ANEMIA=VIH AND TMZ_ANEMIA=BACTERIURIA) THEN 'SI' ELSE 'NO' END 'MIDE'")))
                        ->where('ANIO', $anio) ->where('MES', $mes)
                        ->orderBy('PROVINCIA', 'ASC') ->orderBy('DISTRITO', 'ASC') ->orderBy('IPRESS', 'ASC')
                        ->get();
        }
        else if($red != 'TODOS' && $dist == 'TODOS'){
            $nominal = DB::table('dbo.CONSOLIDADO_BATERIA')
                        ->select('*', (DB::raw("CASE WHEN (TMZ_ANEMIA IS NULL OR SIFILIS IS NULL OR VIH IS NULL OR BACTERIURIA IS NULL) THEN 'NO' WHEN (TMZ_ANEMIA=SIFILIS AND TMZ_ANEMIA=VIH AND TMZ_ANEMIA=BACTERIURIA) THEN 'SI' ELSE 'NO' END 'MIDE'")))
                        ->where('ANIO', $anio) ->where('MES', $mes) ->where('PROVINCIA', $red)
                        ->orderBy('PROVINCIA', 'ASC') ->orderBy('DISTRITO', 'ASC') ->orderBy('IPRESS', 'ASC')
                        ->get();
        }
        else if($dist != 'TODOS'){
            if($dist == 'CONSTITUCIÓN'){ $dist = 'CONSTITUCION'; }
            if($dist == 'SAN FRANCISCO DE ASIS DE YARUSYACAN'){ $dist = 'SAN FCO DE ASIS DE YARUSYACAN'; }
            $nominal = DB::table('dbo.CONSOLIDADO_BATERIA')
                        ->select('*', (DB::raw("CASE WHEN (TMZ_ANEMIA IS NULL OR SIFILIS IS NULL OR VIH IS NULL OR BACTERIURIA IS NULL) THEN 'NO' WHEN (TMZ_ANEMIA=SIFILIS AND TMZ_ANEMIA=VIH AND TMZ_ANEMIA=BACTERIURIA) THEN 'SI' ELSE 'NO' END 'MIDE'")))
                        ->where('ANIO', $anio) ->where('MES', $mes) ->where('DISTRITO', $dist)
                        ->orderBy('PROVINCIA', 'ASC') ->orderBy('DISTRITO', 'ASC') ->orderBy('IPRESS', 'ASC')
                        ->get();
        }

        return view('fed.Pregnant.Bateria.print', [
            'nominal' => $nominal, 'nameMonth' => ucfirst($nameMonth), 'anio' => $anio
        ]);
    }
}