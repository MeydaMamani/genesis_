<?php
namespace App\Http\Controllers\Fed;

use App\Exports\Fed\Pregnant\BateriaExport;
use App\Exports\SospechaVioExport;
use App\Exports\UsersNewExport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromView;

class PregnantController extends Controller
{
    public function indexBateria(Request $request) {
        return view('fed/Pregnant/Bateria/index');
    }

    public function listBateria(Request $request){
        $red_1 = $request->red;
        $dist = $request->distrito;
        $anio = $request->anio;
        $mes = $request->mes;

        if ($red_1 == '01') { $red = 'PASCO'; }
        elseif ($red_1 == '02') { $red = 'DANIEL ALCIDES CARRION'; }
        elseif ($red_1 == '03') { $red = 'OXAPAMPA'; }

        if($red_1 == 'TODOS'){
            $nominal = DB::table('dbo.CONSOLIDADO_BATERIA')
                        ->select('*', (DB::raw("CASE WHEN (CAPTADA IS NULL OR TMZ_ANEMIA IS NULL OR SIFILIS IS NULL OR VIH IS NULL OR BACTERIURIA IS NULL) THEN 'NO'
                                WHEN (TMZ_ANEMIA=CAPTADA AND TMZ_ANEMIA=SIFILIS AND TMZ_ANEMIA=VIH AND TMZ_ANEMIA=BACTERIURIA) THEN 'SI' ELSE 'NO' END 'MIDE'")))
                        ->where('ANIO', $anio) ->where('MES', $mes)
                        ->orderBy('PROVINCIA', 'ASC') ->orderBy('DISTRITO', 'ASC') ->orderBy('IPRESS', 'ASC')
                        ->get();

            $t_resume = DB::table('DEN_BATERIA')
                        ->select('DEN_BATERIA.PROVINCIA','DEN_BATERIA.DISTRITO','DEN_BATERIA.DENOMINADOR', 'NUM_BATERIA.NUMERADOR')
                        ->leftJoin('NUM_BATERIA', 'DEN_BATERIA.DISTRITO', '=', 'NUM_BATERIA.DISTRITO')
                        ->where('DEN_BATERIA.DENOMINADOR', '>', '0')
                        ->where('DEN_BATERIA.Anio', $anio) ->where('NUM_BATERIA.Anio', $anio)
                        ->where('DEN_BATERIA.Mes', $mes) ->where('NUM_BATERIA.Mes', $mes)
                        ->orderBy('DEN_BATERIA.PROVINCIA', 'ASC') ->orderBy('DEN_BATERIA.DISTRITO', 'ASC')
                        ->get();

            $resum_red = DB::table('DEN_BATERIA')
                        ->select('DEN_BATERIA.PROVINCIA', (DB::raw('SUM(DEN_BATERIA.DENOMINADOR) AS DEN')), (DB::raw('SUM(NUM_BATERIA.NUMERADOR) AS NUM')))
                        ->leftJoin('NUM_BATERIA', 'DEN_BATERIA.DISTRITO', '=', 'NUM_BATERIA.DISTRITO')
                        ->where('DEN_BATERIA.Anio', $anio) ->where('NUM_BATERIA.Anio', $anio)
                        ->where('DEN_BATERIA.Mes', $mes) ->where('NUM_BATERIA.Mes', $mes)
                        ->where('DEN_BATERIA.DENOMINADOR', '>', '0')
                        ->groupBy('DEN_BATERIA.PROVINCIA') ->orderBy('DEN_BATERIA.PROVINCIA', 'ASC')
                        ->get();
        }
        else if($red_1 != 'TODOS' && $dist == 'TODOS'){
            $nominal = DB::table('dbo.CONSOLIDADO_BATERIA')
                        ->select('*', (DB::raw("CASE WHEN (CAPTADA IS NULL OR TMZ_ANEMIA IS NULL OR SIFILIS IS NULL OR VIH IS NULL OR BACTERIURIA IS NULL) THEN 'NO'
                                WHEN (TMZ_ANEMIA=CAPTADA AND TMZ_ANEMIA=SIFILIS AND TMZ_ANEMIA=VIH AND TMZ_ANEMIA=BACTERIURIA) THEN 'SI' ELSE 'NO' END 'MIDE'")))
                        ->where('ANIO', $anio) ->where('MES', $mes) ->where('PROVINCIA', $red)
                        ->orderBy('PROVINCIA', 'ASC') ->orderBy('DISTRITO', 'ASC') ->orderBy('IPRESS', 'ASC')
                        ->get();

            $t_resume = DB::table('DEN_BATERIA')
                        ->select('DEN_BATERIA.PROVINCIA','DEN_BATERIA.DISTRITO','DEN_BATERIA.DENOMINADOR', 'NUM_BATERIA.NUMERADOR')
                        ->leftJoin('NUM_BATERIA', 'DEN_BATERIA.DISTRITO', '=', 'NUM_BATERIA.DISTRITO')
                        ->where('DEN_BATERIA.DENOMINADOR', '>', '0')
                        ->where('DEN_BATERIA.Anio', $anio) ->where('NUM_BATERIA.Anio', $anio)
                        ->where('DEN_BATERIA.Mes', $mes) ->where('NUM_BATERIA.Mes', $mes) ->where('DEN_BATERIA.PROVINCIA', $red)
                        ->orderBy('DEN_BATERIA.PROVINCIA', 'ASC') ->orderBy('DEN_BATERIA.DISTRITO', 'ASC')
                        ->get();

            $resum_red = DB::table('DEN_BATERIA')
                        ->select('DEN_BATERIA.PROVINCIA', (DB::raw('SUM(DEN_BATERIA.DENOMINADOR) AS DEN')), (DB::raw('SUM(NUM_BATERIA.NUMERADOR) AS NUM')))
                        ->leftJoin('NUM_BATERIA', 'DEN_BATERIA.DISTRITO', '=', 'NUM_BATERIA.DISTRITO')
                        ->where('DEN_BATERIA.Anio', $anio) ->where('NUM_BATERIA.Anio', $anio)
                        ->where('DEN_BATERIA.Mes', $mes) ->where('NUM_BATERIA.Mes', $mes)
                        ->where('DEN_BATERIA.DENOMINADOR', '>', '0') ->where('DEN_BATERIA.PROVINCIA', $red)
                        ->groupBy('DEN_BATERIA.PROVINCIA') ->orderBy('DEN_BATERIA.PROVINCIA', 'ASC')
                        ->get();
        }
        else if($dist != 'TODOS'){
            // if($dist == 'CONSTITUCIÓN'){ $dist = 'CONSTITUCION'; }
            // if($dist == 'SAN FRANCISCO DE ASIS DE YARUSYACAN'){ $dist = 'SAN FCO DE ASIS DE YARUSYACAN'; }
            $nominal = DB::table('dbo.CONSOLIDADO_BATERIA')
                        ->select('*', (DB::raw("CASE WHEN (CAPTADA IS NULL OR TMZ_ANEMIA IS NULL OR SIFILIS IS NULL OR VIH IS NULL OR BACTERIURIA IS NULL) THEN 'NO'
                                WHEN (TMZ_ANEMIA=CAPTADA AND TMZ_ANEMIA=SIFILIS AND TMZ_ANEMIA=VIH AND TMZ_ANEMIA=BACTERIURIA) THEN 'SI' ELSE 'NO' END 'MIDE'")))
                        ->where('ANIO', $anio) ->where('MES', $mes) ->where('DISTRITO', $dist)
                        ->orderBy('PROVINCIA', 'ASC') ->orderBy('DISTRITO', 'ASC') ->orderBy('IPRESS', 'ASC')
                        ->get();

            $t_resume = DB::table('DEN_BATERIA')
                        ->select('DEN_BATERIA.PROVINCIA','DEN_BATERIA.DISTRITO','DEN_BATERIA.DENOMINADOR', 'NUM_BATERIA.NUMERADOR')
                        ->leftJoin('NUM_BATERIA', 'DEN_BATERIA.DISTRITO', '=', 'NUM_BATERIA.DISTRITO')
                        ->where('DEN_BATERIA.DENOMINADOR', '>', '0')
                        ->where('DEN_BATERIA.Anio', $anio) ->where('NUM_BATERIA.Anio', $anio)
                        ->where('DEN_BATERIA.Mes', $mes) ->where('NUM_BATERIA.Mes', $mes) ->where('DEN_BATERIA.DISTRITO', $dist)
                        ->orderBy('DEN_BATERIA.PROVINCIA', 'ASC') ->orderBy('DEN_BATERIA.DISTRITO', 'ASC')
                        ->get();

            $resum_red = DB::table('DEN_BATERIA')
                        ->select('DEN_BATERIA.PROVINCIA', (DB::raw('SUM(DEN_BATERIA.DENOMINADOR) AS DEN')), (DB::raw('SUM(NUM_BATERIA.NUMERADOR) AS NUM')))
                        ->leftJoin('NUM_BATERIA', 'DEN_BATERIA.DISTRITO', '=', 'NUM_BATERIA.DISTRITO')
                        ->where('DEN_BATERIA.Anio', $anio) ->where('NUM_BATERIA.Anio', $anio)
                        ->where('DEN_BATERIA.Mes', $mes) ->where('NUM_BATERIA.Mes', $mes)
                        ->where('DEN_BATERIA.DENOMINADOR', '>', '0') ->where('DEN_BATERIA.DISTRITO', $dist)
                        ->groupBy('DEN_BATERIA.PROVINCIA') ->orderBy('DEN_BATERIA.PROVINCIA', 'ASC')
                        ->get();
        }

        $q[] = json_decode($nominal, true);
        $q[] = json_decode($t_resume, true);
        $q[] = json_decode($resum_red, true);
        $r = json_encode($q);
        return response(($r), 200);
    }

    public function printBateria(Request $request){
        $r = $request->r;
        $d = $request->d;
        $a = $request->a;
        $m = $request->m;

        return Excel::download(new BateriaExport($r, $d, $a, $m), 'DEIT_PASCO CG_FT_BATERIA_COMPLETA.xlsx');
    }

    public function indexTratamiento(Request $request) {
        return view('fed/Pregnant/sospecha_tratamiento/index');
    }

    public function listSospecha(Request $request){
        $red_1 = $request->red;
        $dist = $request->distrito;
        $anio = $request->anio;
        $mes = $request->mes;

        if (strlen($mes) == 1){ $mes2 = '0'.$mes; }
        else{ $mes2 = $mes; }

        if ($red_1 == '01') { $red = 'PASCO'; }
        elseif ($red_1 == '02') { $red = 'DANIEL CARRION'; }
        elseif ($red_1 == '03') { $red = 'OXAPAMPA'; }

        if($red_1 == 'TODOS'){
            $nominal = DB::table('dbo.CONSOLIDADO_SOSPECHA')
                        ->select('*') ->where('ANIO', $anio) ->where('MES', $mes)
                        ->orderBy('Provincia_Establecimiento', 'ASC') ->orderBy('Distrito_Establecimiento', 'ASC') ->orderBy('ATENDIDOS', 'ASC')
                        ->get();

            $t_resume = DB::table('DEN_SOSPECHA')
                        ->select('DEN_SOSPECHA.Provincia_Establecimiento','DEN_SOSPECHA.Distrito_Establecimiento','DEN_SOSPECHA.DENOMINADOR', 'NUM_SOSPECHA.NUMERADOR')
                        ->leftJoin('NUM_SOSPECHA', 'DEN_SOSPECHA.Distrito_Establecimiento', '=', 'NUM_SOSPECHA.Distrito_Establecimiento')
                        ->where('DEN_SOSPECHA.DENOMINADOR', '>', '0')
                        ->where('DEN_SOSPECHA.Anio', $anio) ->where('NUM_SOSPECHA.Anio', $anio)
                        ->where('DEN_SOSPECHA.Mes', $mes) ->where('NUM_SOSPECHA.Mes', $mes)
                        ->orderBy('DEN_SOSPECHA.Provincia_Establecimiento', 'ASC') ->orderBy('DEN_SOSPECHA.Distrito_Establecimiento', 'ASC')
                        ->get();

            $resum_red = DB::table('DEN_SOSPECHA')
                        ->select('DEN_SOSPECHA.Provincia_Establecimiento', (DB::raw('SUM(DEN_SOSPECHA.DENOMINADOR) AS DEN')), (DB::raw('SUM(NUM_SOSPECHA.NUMERADOR) AS NUM')))
                        ->leftJoin('NUM_SOSPECHA', 'DEN_SOSPECHA.Distrito_Establecimiento', '=', 'NUM_SOSPECHA.Distrito_Establecimiento')
                        ->where('DEN_SOSPECHA.Anio', $anio) ->where('NUM_SOSPECHA.Anio', $anio)
                        ->where('DEN_SOSPECHA.Mes', $mes) ->where('NUM_SOSPECHA.Mes', $mes)
                        ->where('DEN_SOSPECHA.DENOMINADOR', '>', '0')
                        ->groupBy('DEN_SOSPECHA.Provincia_Establecimiento') ->orderBy('DEN_SOSPECHA.Provincia_Establecimiento', 'ASC')
                        ->get();
        }
        else if($red_1 != 'TODOS' && $dist == 'TODOS'){
            $nominal = DB::table('dbo.CONSOLIDADO_SOSPECHA')
                        ->select('*') ->where('ANIO', $anio) ->where('MES', $mes) ->where('Provincia_Establecimiento', $red)
                        ->orderBy('Provincia_Establecimiento', 'ASC') ->orderBy('Distrito_Establecimiento', 'ASC') ->orderBy('ATENDIDOS', 'ASC')
                        ->get();

            $t_resume = DB::table('DEN_SOSPECHA')
                        ->select('DEN_SOSPECHA.Provincia_Establecimiento','DEN_SOSPECHA.Distrito_Establecimiento','DEN_SOSPECHA.DENOMINADOR', 'NUM_SOSPECHA.NUMERADOR')
                        ->leftJoin('NUM_SOSPECHA', 'DEN_SOSPECHA.Distrito_Establecimiento', '=', 'NUM_SOSPECHA.Distrito_Establecimiento')
                        ->where('DEN_SOSPECHA.DENOMINADOR', '>', '0')
                        ->where('DEN_SOSPECHA.Anio', $anio) ->where('NUM_SOSPECHA.Anio', $anio)
                        ->where('DEN_SOSPECHA.Mes', $mes) ->where('NUM_SOSPECHA.Mes', $mes) ->where('DEN_SOSPECHA.Provincia_Establecimiento', $red)
                        ->orderBy('DEN_SOSPECHA.Provincia_Establecimiento', 'ASC') ->orderBy('DEN_SOSPECHA.Distrito_Establecimiento', 'ASC')
                        ->get();

            $resum_red = DB::table('DEN_SOSPECHA')
                        ->select('DEN_SOSPECHA.Provincia_Establecimiento', (DB::raw('SUM(DEN_SOSPECHA.DENOMINADOR) AS DEN')), (DB::raw('SUM(NUM_SOSPECHA.NUMERADOR) AS NUM')))
                        ->leftJoin('NUM_SOSPECHA', 'DEN_SOSPECHA.Distrito_Establecimiento', '=', 'NUM_SOSPECHA.Distrito_Establecimiento')
                        ->where('DEN_SOSPECHA.Anio', $anio) ->where('NUM_SOSPECHA.Anio', $anio)
                        ->where('DEN_SOSPECHA.Mes', $mes) ->where('NUM_SOSPECHA.Mes', $mes)
                        ->where('DEN_SOSPECHA.DENOMINADOR', '>', '0') ->where('DEN_SOSPECHA.Provincia_Establecimiento', $red)
                        ->groupBy('DEN_SOSPECHA.Provincia_Establecimiento') ->orderBy('DEN_SOSPECHA.Provincia_Establecimiento', 'ASC')
                        ->get();
        }
        else if($dist != 'TODOS'){
            // if($dist == 'CONSTITUCIÓN'){ $dist = 'CONSTITUCION'; }
            // if($dist == 'SAN FRANCISCO DE ASIS DE YARUSYACAN'){ $dist = 'SAN FCO DE ASIS DE YARUSYACAN'; }
            $nominal = DB::table('dbo.CONSOLIDADO_SOSPECHA')
                        ->select('*') ->where('Anio', $anio) ->where('Mes', $mes) ->where('Distrito_Establecimiento', $dist)
                        ->orderBy('Provincia_Establecimiento', 'ASC') ->orderBy('Distrito_Establecimiento', 'ASC') ->orderBy('ATENDIDOS', 'ASC')
                        ->get();

            $t_resume = DB::table('DEN_SOSPECHA')
                        ->select('DEN_SOSPECHA.Provincia_Establecimiento','DEN_SOSPECHA.Distrito_Establecimiento','DEN_SOSPECHA.DENOMINADOR', 'NUM_SOSPECHA.NUMERADOR')
                        ->leftJoin('NUM_SOSPECHA', 'DEN_SOSPECHA.Distrito_Establecimiento', '=', 'NUM_SOSPECHA.Distrito_Establecimiento')
                        ->where('DEN_SOSPECHA.DENOMINADOR', '>', '0') ->where('DEN_SOSPECHA.Distrito_Establecimiento', $dist)
                        ->where('DEN_SOSPECHA.Anio', $anio) ->where('NUM_SOSPECHA.Anio', $anio)
                        ->where('DEN_SOSPECHA.Mes', $mes) ->where('NUM_SOSPECHA.Mes', $mes)
                        ->orderBy('DEN_SOSPECHA.Provincia_Establecimiento', 'ASC') ->orderBy('DEN_SOSPECHA.Distrito_Establecimiento', 'ASC')
                        ->get();

            $resum_red = DB::table('DEN_SOSPECHA')
                        ->select('DEN_SOSPECHA.Provincia_Establecimiento', (DB::raw('SUM(DEN_SOSPECHA.DENOMINADOR) AS DEN')), (DB::raw('SUM(NUM_SOSPECHA.NUMERADOR) AS NUM')))
                        ->leftJoin('NUM_SOSPECHA', 'DEN_SOSPECHA.Distrito_Establecimiento', '=', 'NUM_SOSPECHA.Distrito_Establecimiento')
                        ->where('DEN_SOSPECHA.Anio', $anio) ->where('NUM_SOSPECHA.Anio', $anio)
                        ->where('DEN_SOSPECHA.Mes', $mes) ->where('NUM_SOSPECHA.Mes', $mes)
                        ->where('DEN_SOSPECHA.DENOMINADOR', '>', '0') ->where('DEN_SOSPECHA.Distrito_Establecimiento', $dist)
                        ->groupBy('DEN_SOSPECHA.Provincia_Establecimiento')
                        ->orderBy('DEN_SOSPECHA.Provincia_Establecimiento', 'ASC')
                        ->get();
        }

        $q[] = json_decode($nominal, true);
        $q[] = json_decode($t_resume, true);
        $q[] = json_decode($resum_red, true);
        $r = json_encode($q);
        return response(($r), 200);
    }

    public function printSospecha(Request $request){
        $red_1 = $request->r; $dist = $request->d; $anio = $request->a; $mes = $request->m;

        if (strlen($mes) == 1){ $mes2 = '0'.$mes; }
        else{ $mes2 = $mes; }

        if ($red_1 == '01') { $red = 'PASCO'; }
        elseif ($red_1 == '02') { $red = 'DANIEL CARRION'; }
        elseif ($red_1 == '03') { $red = 'OXAPAMPA'; }

        if($red_1 == 'TODOS'){
            $nominal = DB::table('dbo.CONSOLIDADO_SOSPECHA')
                        ->select('*') ->where('ANIO', $anio) ->where('MES', $mes)
                        ->orderBy('Provincia_Establecimiento', 'ASC') ->orderBy('Distrito_Establecimiento', 'ASC') ->orderBy('ATENDIDOS', 'ASC')
                        ->get();
        }
        else if($red_1 != 'TODOS' && $dist == 'TODOS'){
            $nominal = DB::table('dbo.CONSOLIDADO_SOSPECHA')
                        ->select('*') ->where('ANIO', $anio) ->where('MES', $mes)
                        ->orderBy('Provincia_Establecimiento', 'ASC') ->orderBy('Distrito_Establecimiento', 'ASC') ->orderBy('ATENDIDOS', 'ASC')
                        ->get();
        }
        else if($dist != 'TODOS'){
            // if($dist == 'CONSTITUCIÓN'){ $dist = 'CONSTITUCION'; }
            // if($dist == 'SAN FRANCISCO DE ASIS DE YARUSYACAN'){ $dist = 'SAN FCO DE ASIS DE YARUSYACAN'; }
            $nominal = DB::table('dbo.CONSOLIDADO_SOSPECHA')
                        ->select('*') ->where('Anio', $anio) ->where('Mes', $mes)
                        ->orderBy('Provincia_Establecimiento', 'ASC') ->orderBy('Distrito_Establecimiento', 'ASC') ->orderBy('ATENDIDOS', 'ASC')
                        ->get();
        }

        return Excel::download(new SospechaVioExport($nominal, $anio, $request->nameMonth, $request->his), 'DEIT_PASCO CG_FT_GESTANTES CON SOSPECHA DE VIOLENCIA.xlsx');
    }

    public function listTratamiento(Request $request){
        $red_1 = $request->red2;
        $dist = $request->distrito2;
        $anio = $request->anio2;
        $mes = $request->mes2;

        if ($red_1 == '01') { $red = 'PASCO'; }
        elseif ($red_1 == '02') { $red = 'DANIEL CARRION'; }
        elseif ($red_1 == '03') { $red = 'OXAPAMPA'; }

        $nominal = DB::statement("SELECT *, DATEDIFF (DAY, R456 , diagnostico) AS DIA1,  DATEDIFF (DAY, diagnostico , iniciotto) AS DIA2,
                    CASE WHEN (VIF IS NOT NULL AND R456 IS NOT NULL) AND (diagnostico IS NOT NULL AND iniciotto IS NOT NULL) AND
                    (VIF = R456) AND (((DATEDIFF (DAY, R456 , diagnostico)) <= 15) AND (DATEDIFF (DAY, R456 , diagnostico)) >= 0)
                    AND (((DATEDIFF (DAY, diagnostico , iniciotto)) <= 7) AND (DATEDIFF (DAY, diagnostico , iniciotto)) >= 0)
                    THEN 'SI' ELSE 'NO' END 'MIDE' INTO BDHIS_MINSA_EXTERNO_V2.dbo.CONSOLIDADO_TRATAMIENTO1
                    FROM BDHIS_MINSA_EXTERNO_V2.dbo.CONSOLIDADO_TRATAMIENTO
                    WHERE VIF IS NOT NULL AND R456 IS NOT NULL AND Anio=$anio AND Mes=$mes
                    ORDER BY Provincia_Establecimiento, Distrito_Establecimiento, ATENDIDOS;
                    with c as ( select ATENDIDOS,  ROW_NUMBER() over(partition by ATENDIDOS order by iniciotto) as duplicado
                    from BDHIS_MINSA_EXTERNO_V2.dbo.CONSOLIDADO_TRATAMIENTO1 ) delete from c where duplicado >1;
                    SELECT * FROM BDHIS_MINSA_EXTERNO_V2.dbo.CONSOLIDADO_TRATAMIENTO1");

        $num_den = DB::statement("SELECT Provincia_Establecimiento, Distrito_Establecimiento, COUNT(*) 'DENOMINADOR'
                    INTO BDHIS_MINSA_EXTERNO_V2.dbo.DEN_TRATAMIENTO
                    FROM BDHIS_MINSA_EXTERNO_V2.dbo.CONSOLIDADO_TRATAMIENTO1
                    GROUP BY Provincia_Establecimiento, Distrito_Establecimiento;

                    SELECT Provincia_Establecimiento,Distrito_Establecimiento, COUNT( CASE WHEN (MIDE='SI') THEN 'SI' END) 'NUMERADOR'
                    INTO BDHIS_MINSA_EXTERNO_V2.dbo.NUM_TRATAMIENTO
                    FROM BDHIS_MINSA_EXTERNO_V2.dbo.CONSOLIDADO_TRATAMIENTO1
                    GROUP BY Provincia_Establecimiento,Distrito_Establecimiento");

        if($red_1 == 'TODOS'){
            $nominal2 = DB::table('dbo.CONSOLIDADO_TRATAMIENTO1')
                        ->orderBy('Provincia_Establecimiento', 'ASC') ->orderBy('Distrito_Establecimiento', 'ASC')
                        ->get();

            $t_resume = DB::table('DEN_TRATAMIENTO AS a')
                        ->select('a.Provincia_Establecimiento','a.Distrito_Establecimiento','a.DENOMINADOR', 'b.NUMERADOR')
                        ->leftJoin('NUM_TRATAMIENTO AS b', 'a.Distrito_Establecimiento', '=', 'b.Distrito_Establecimiento')
                        ->where('a.DENOMINADOR', '>', '0')
                        ->orderBy('a.Provincia_Establecimiento', 'ASC') ->orderBy('a.Distrito_Establecimiento', 'ASC')
                        ->get();

            $resum_red = DB::table('DEN_TRATAMIENTO AS a')
                        ->select('a.Provincia_Establecimiento', (DB::raw('SUM(a.DENOMINADOR) AS DEN')), (DB::raw('SUM(b.NUMERADOR) AS NUM')))
                        ->leftJoin('NUM_TRATAMIENTO AS b', 'a.Distrito_Establecimiento', '=', 'b.Distrito_Establecimiento')
                        ->where('a.DENOMINADOR', '>', '0')
                        ->groupBy('a.Provincia_Establecimiento') ->orderBy('a.Provincia_Establecimiento', 'ASC')
                        ->get();
        }
        else if($red_1 != 'TODOS' && $dist == 'TODOS'){
            $nominal2 = DB::table('dbo.CONSOLIDADO_TRATAMIENTO1') ->where('Provincia_Establecimiento', $red)
                        ->orderBy('Provincia_Establecimiento', 'ASC') ->orderBy('Distrito_Establecimiento', 'ASC')
                        ->get();

            $t_resume = DB::table('DEN_TRATAMIENTO AS a')
                        ->select('a.Provincia_Establecimiento','a.Distrito_Establecimiento','a.DENOMINADOR', 'b.NUMERADOR')
                        ->leftJoin('NUM_TRATAMIENTO AS b', 'a.Distrito_Establecimiento', '=', 'b.Distrito_Establecimiento')
                        ->where('a.DENOMINADOR', '>', '0') ->where('a.Provincia_Establecimiento', $red)
                        ->orderBy('a.Provincia_Establecimiento', 'ASC') ->orderBy('a.Distrito_Establecimiento', 'ASC')
                        ->get();

            $resum_red = DB::table('DEN_TRATAMIENTO AS a')
                        ->select('a.Provincia_Establecimiento', (DB::raw('SUM(a.DENOMINADOR) AS DEN')), (DB::raw('SUM(b.NUMERADOR) AS NUM')))
                        ->leftJoin('NUM_TRATAMIENTO AS b', 'a.Distrito_Establecimiento', '=', 'b.Distrito_Establecimiento')
                        ->where('a.DENOMINADOR', '>', '0') ->where('a.Provincia_Establecimiento', $red)
                        ->groupBy('a.Provincia_Establecimiento') ->orderBy('a.Provincia_Establecimiento', 'ASC')
                        ->get();
        }
        else if($dist != 'TODOS'){
            $nominal2 = DB::table('dbo.CONSOLIDADO_TRATAMIENTO1') ->where('Distrito_Establecimiento', $dist)
                        ->orderBy('Provincia_Establecimiento', 'ASC') ->orderBy('Distrito_Establecimiento', 'ASC')
                        ->get();

            $t_resume = DB::table('DEN_TRATAMIENTO AS a')
                        ->select('a.Provincia_Establecimiento','a.Distrito_Establecimiento','a.DENOMINADOR', 'b.NUMERADOR')
                        ->leftJoin('NUM_TRATAMIENTO AS b', 'a.Distrito_Establecimiento', '=', 'b.Distrito_Establecimiento')
                        ->where('a.DENOMINADOR', '>', '0') ->where('a.Distrito_Establecimiento', $dist)
                        ->orderBy('a.Provincia_Establecimiento', 'ASC') ->orderBy('a.Distrito_Establecimiento', 'ASC')
                        ->get();

            $resum_red = DB::table('DEN_TRATAMIENTO AS a')
                        ->select('a.Provincia_Establecimiento', (DB::raw('SUM(a.DENOMINADOR) AS DEN')), (DB::raw('SUM(b.NUMERADOR) AS NUM')))
                        ->leftJoin('NUM_TRATAMIENTO AS b', 'a.Distrito_Establecimiento', '=', 'b.Distrito_Establecimiento')
                        ->where('a.DENOMINADOR', '>', '0') ->where('a.Distrito_Establecimiento', $dist)
                        ->groupBy('a.Provincia_Establecimiento') ->orderBy('a.Provincia_Establecimiento', 'ASC')
                        ->get();
        }

        $query1 = DB::statement(DB::raw("DROP TABLE BDHIS_MINSA_EXTERNO_V2.dbo.CONSOLIDADO_TRATAMIENTO1
                                        DROP TABLE BDHIS_MINSA_EXTERNO_V2.dbo.DEN_TRATAMIENTO
                                        DROP TABLE BDHIS_MINSA_EXTERNO_V2.dbo.NUM_TRATAMIENTO"));

        $q[] = json_decode($nominal2, true);
        $q[] = json_decode($t_resume, true);
        $q[] = json_decode($resum_red, true);
        $r = json_encode($q);
        return response(($r), 200);
    }

    public function indexNewUsers(Request $request) {
        return view('fed/Pregnant/NewUsers/index');
    }

    public function listNewUsers(Request $request){
        $red_1 = $request->red;
        $dist = $request->distrito;
        $anio = $request->anio;
        $mes = $request->mes;

        if ($red_1 == '01') { $red = 'PASCO'; }
        elseif ($red_1 == '02') { $red = 'DANIEL CARRION'; }
        elseif ($red_1 == '03') { $red = 'OXAPAMPA'; }

        $query = DB::connection('BDHIS_MINSA')
                    ->statement("SELECT distinct try_convert(int,r.Codigo_Unico) renaes, try_convert(date,Fecha_Atencion) fecha_cita, convert(varchar,Tipo_Doc_Paciente)+convert(varchar,Numero_Documento_Paciente) id, den=1
                    into BDHIS_MINSA_EXTERNO_V2.dbo.DEN_USERNEW_GES
                    from BDHIS_MINSA_EXTERNO_V2.dbo.TRAMAHIS_GES h
                    left join BDHIS_MINSA_EXTERNO_V2.dbo.RENAES_GES r ON TRY_CONVERT(INT,h.Codigo_Unico) = TRY_CONVERT(INT,R.Codigo_Unico)
                    where ltrim(rtrim(Codigo_Item)) in ('99208') and ltrim(rtrim(Tipo_Diagnostico)) in ('D')
                    and month(try_convert(date,Fecha_Atencion))='".$mes."' and year(try_convert(date,Fecha_Atencion))='".$anio."'
                    and Numero_Documento_Paciente is not null AND Categoria_Establecimiento IN ('I-1','I-2','I-3','I-4');

                    SELECT distinct try_convert(int,Codigo_Unico) renaes, try_convert(date,Fecha_Atencion) fecha_cita, convert(varchar,Tipo_Doc_Paciente)+convert(varchar,Numero_Documento_Paciente) id, num=1
                    into BDHIS_MINSA_EXTERNO_V2.dbo.NUM_USERNEW_GES
                    from BDHIS_MINSA_EXTERNO_V2.dbo.TRAMAHIS_GES
                    where ((ltrim(rtrim(Codigo_Item)) = '96150' and ltrim(rtrim(Tipo_Diagnostico)) ='D' and ltrim(rtrim(valor_lab)) ='VIF'	)
                    or (ltrim(rtrim(Codigo_Item)) = '96150.01' and ltrim(rtrim(Tipo_Diagnostico)) = 'D' )
                    ) and month(try_convert(date,Fecha_Atencion))='".$mes."' and year(try_convert(date,Fecha_Atencion))='".$anio."';

                    SELECT  m.Provincia,m.Distrito,m.Nombre_Establecimiento,SUBSTRING(d.id,2,10)documento,d.fecha_cita ATE_PLANIFICACION,n.fecha_cita TMZ_VIF
                    intO BDHIS_MINSA_EXTERNO_V2.dbo.PADRONINICIO_GES
                    from BDHIS_MINSA_EXTERNO_V2.dbo.DEN_USERNEW_GES d left join BDHIS_MINSA_EXTERNO_V2.dbo.NUM_USERNEW_GES n on d.id=n.id
                    left join MAESTRO_HIS_ESTABLECIMIENTO m on d.renaes=cast(m.Codigo_Unico as int)
                    ORDER BY Provincia, Distrito, Nombre_Establecimiento;

                    with c as (select DOCUMENTO,  ROW_NUMBER() over(partition by DOCUMENTO order by DOCUMENTO) as duplicado
                    from BDHIS_MINSA_EXTERNO_V2.dbo.PADRONINICIO_GES)
                    delete  from c
                    where duplicado >1;

                    SELECT Provincia, Distrito, COUNT(*) AS 'DENOMINADOR'
                    INTO BDHIS_MINSA_EXTERNO_V2.dbo.DEN_USUARIAS_NUEVAS
                    FROM BDHIS_MINSA_EXTERNO_V2.dbo.PADRONINICIO_GES
                    GROUP BY Provincia, Distrito

                    SELECT Provincia,Distrito, COUNT(CASE WHEN ((ATE_PLANIFICACION = TMZ_VIF) AND (ATE_PLANIFICACION IS NOT NULL) AND (TMZ_VIF IS NOT NULL)) THEN 'CUMPLE' END) AS 'NUMERADOR'
                    into BDHIS_MINSA_EXTERNO_V2.dbo.NUM_USUARIAS_NUEVAS
                    FROM BDHIS_MINSA_EXTERNO_V2.dbo.PADRONINICIO_GES
                    GROUP BY Provincia, Distrito");

        if($red_1 == 'TODOS'){
            $nominal = DB::table('dbo.PADRONINICIO_GES')
                        ->select('*', (DB::raw("CASE WHEN ((ATE_PLANIFICACION = TMZ_VIF) AND (ATE_PLANIFICACION IS NOT NULL) AND
                        (TMZ_VIF IS NOT NULL)) THEN 'CUMPLE' ELSE 'NO CUMPLE' END MIDE")))
                        ->orderBy('Provincia', 'ASC') ->orderBy('Distrito', 'ASC') ->orderBy('Nombre_Establecimiento', 'ASC')
                        ->get();

            $t_resume = DB::table('DEN_USUARIAS_NUEVAS AS A')
                        ->select('A.Provincia','A.Distrito','A.DENOMINADOR', 'B.NUMERADOR')
                        ->leftJoin('NUM_USUARIAS_NUEVAS AS B', 'A.Distrito', '=', 'B.Distrito')
                        ->where('A.DENOMINADOR', '>', '0')
                        ->orderBy('A.Provincia', 'ASC') ->orderBy('A.Distrito', 'ASC')
                        ->get();

            $resum_red = DB::table('DEN_USUARIAS_NUEVAS AS A')
                        ->select('A.Provincia', (DB::raw('SUM(A.DENOMINADOR) AS DEN')), (DB::raw('SUM(B.NUMERADOR) AS NUM')))
                        ->leftJoin('NUM_USUARIAS_NUEVAS AS B', 'A.Distrito', '=', 'B.Distrito')
                        ->where('A.DENOMINADOR', '>', '0')
                        ->groupBy('A.Provincia') ->orderBy('A.Provincia', 'ASC')
                        ->get();
        }
        else if($red_1 != 'TODOS' && $dist == 'TODOS'){
            $nominal = DB::table('dbo.PADRONINICIO_GES')
                        ->select('*', (DB::raw("CASE WHEN ((ATE_PLANIFICACION = TMZ_VIF) AND (ATE_PLANIFICACION IS NOT NULL) AND
                        (TMZ_VIF IS NOT NULL)) THEN 'CUMPLE' ELSE 'NO CUMPLE' END MIDE"))) ->where('Provincia', $red)
                        ->orderBy('Provincia', 'ASC') ->orderBy('Distrito', 'ASC') ->orderBy('Nombre_Establecimiento', 'ASC')
                        ->get();

            $t_resume = DB::table('DEN_USUARIAS_NUEVAS AS A')
                        ->select('A.Provincia','A.Distrito','A.DENOMINADOR', 'B.NUMERADOR')
                        ->leftJoin('NUM_USUARIAS_NUEVAS AS B', 'A.Distrito', '=', 'B.Distrito')
                        ->where('A.DENOMINADOR', '>', '0') ->where('A.Provincia', $red)
                        ->orderBy('A.Provincia', 'ASC') ->orderBy('A.Distrito', 'ASC')
                        ->get();

            $resum_red = DB::table('DEN_USUARIAS_NUEVAS AS A')
                        ->select('A.Provincia', (DB::raw('SUM(A.DENOMINADOR) AS DEN')), (DB::raw('SUM(B.NUMERADOR) AS NUM')))
                        ->leftJoin('NUM_USUARIAS_NUEVAS AS B', 'A.Distrito', '=', 'B.Distrito')
                        ->where('A.DENOMINADOR', '>', '0') ->where('A.Provincia', $red)
                        ->groupBy('A.Provincia') ->orderBy('A.Provincia', 'ASC')
                        ->get();
        }
        else if($dist != 'TODOS'){
            $nominal = DB::table('dbo.PADRONINICIO_GES')
                        ->select('*', (DB::raw("CASE WHEN ((ATE_PLANIFICACION = TMZ_VIF) AND (ATE_PLANIFICACION IS NOT NULL) AND
                        (TMZ_VIF IS NOT NULL)) THEN 'CUMPLE' ELSE 'NO CUMPLE' END MIDE"))) ->where('Distrito', $dist)
                        ->orderBy('Provincia', 'ASC') ->orderBy('Distrito', 'ASC') ->orderBy('Nombre_Establecimiento', 'ASC')
                        ->get();

            $t_resume = DB::table('DEN_USUARIAS_NUEVAS AS A')
                        ->select('A.Provincia','A.Distrito','A.DENOMINADOR', 'B.NUMERADOR')
                        ->leftJoin('NUM_USUARIAS_NUEVAS AS B', 'A.Distrito', '=', 'B.Distrito')
                        ->where('A.DENOMINADOR', '>', '0') ->where('A.Distrito', $dist)
                        ->orderBy('A.Provincia', 'ASC') ->orderBy('A.Distrito', 'ASC')
                        ->get();

            $resum_red = DB::table('DEN_USUARIAS_NUEVAS AS A')
                        ->select('A.Provincia', (DB::raw('SUM(A.DENOMINADOR) AS DEN')), (DB::raw('SUM(B.NUMERADOR) AS NUM')))
                        ->leftJoin('NUM_USUARIAS_NUEVAS AS B', 'A.Distrito', '=', 'B.Distrito')
                        ->where('A.DENOMINADOR', '>', '0') ->where('A.Distrito', $dist)
                        ->groupBy('A.Provincia') ->orderBy('A.Provincia', 'ASC')
                        ->get();
        }

        $query2 = DB::statement(DB::raw("DROP TABLE BDHIS_MINSA_EXTERNO_V2.dbo.NUM_USERNEW_GES
                                        DROP TABLE BDHIS_MINSA_EXTERNO_V2.dbo.DEN_USERNEW_GES
                                        DROP TABLE BDHIS_MINSA_EXTERNO_V2.dbo.PADRONINICIO_GES
                                        DROP TABLE BDHIS_MINSA_EXTERNO_V2.dbo.DEN_USUARIAS_NUEVAS
                                        DROP TABLE BDHIS_MINSA_EXTERNO_V2.dbo.NUM_USUARIAS_NUEVAS"));

        $q[] = json_decode($nominal, true);
        $q[] = json_decode($t_resume, true);
        $q[] = json_decode($resum_red, true);
        $r = json_encode($q);
        return response(($r), 200);
    }

    public function printNewUsers(Request $request){
        $red_1 = $request->r; $dist = $request->d; $anio = $request->a; $mes = $request->m;

        if ($red_1 == '01') { $red = 'PASCO'; }
        elseif ($red_1 == '02') { $red = 'DANIEL CARRION'; }
        elseif ($red_1 == '03') { $red = 'OXAPAMPA'; }

        $query = DB::connection('BDHIS_MINSA')
                    ->statement("SELECT distinct try_convert(int,r.Codigo_Unico) renaes, try_convert(date,Fecha_Atencion) fecha_cita, convert(varchar,Tipo_Doc_Paciente)+convert(varchar,Numero_Documento_Paciente) id, den=1
                    into BDHIS_MINSA_EXTERNO_V2.dbo.DEN_USERNEW_GES
                    from BDHIS_MINSA_EXTERNO_V2.dbo.TRAMAHIS_GES h
                    left join BDHIS_MINSA_EXTERNO_V2.dbo.RENAES_GES r ON TRY_CONVERT(INT,h.Codigo_Unico) = TRY_CONVERT(INT,R.Codigo_Unico)
                    where ltrim(rtrim(Codigo_Item)) in ('99208') and ltrim(rtrim(Tipo_Diagnostico)) in ('D')
                    and month(try_convert(date,Fecha_Atencion))='".$mes."' and year(try_convert(date,Fecha_Atencion))='".$anio."'
                    and Numero_Documento_Paciente is not null AND Categoria_Establecimiento IN ('I-1','I-2','I-3','I-4');

                    SELECT distinct try_convert(int,Codigo_Unico) renaes, try_convert(date,Fecha_Atencion) fecha_cita, convert(varchar,Tipo_Doc_Paciente)+convert(varchar,Numero_Documento_Paciente) id, num=1
                    into BDHIS_MINSA_EXTERNO_V2.dbo.NUM_USERNEW_GES
                    from BDHIS_MINSA_EXTERNO_V2.dbo.TRAMAHIS_GES
                    where ((ltrim(rtrim(Codigo_Item)) = '96150' and ltrim(rtrim(Tipo_Diagnostico)) ='D' and ltrim(rtrim(valor_lab)) ='VIF'	)
                    or (ltrim(rtrim(Codigo_Item)) = '96150.01' and ltrim(rtrim(Tipo_Diagnostico)) = 'D' )
                    ) and month(try_convert(date,Fecha_Atencion))='".$mes."' and year(try_convert(date,Fecha_Atencion))='".$anio."';

                    SELECT  m.Provincia,m.Distrito,m.Nombre_Establecimiento,SUBSTRING(d.id,2,10)documento,d.fecha_cita ATE_PLANIFICACION,n.fecha_cita TMZ_VIF
                    intO BDHIS_MINSA_EXTERNO_V2.dbo.PADRONINICIO_GES
                    from BDHIS_MINSA_EXTERNO_V2.dbo.DEN_USERNEW_GES d left join BDHIS_MINSA_EXTERNO_V2.dbo.NUM_USERNEW_GES n on d.id=n.id
                    left join MAESTRO_HIS_ESTABLECIMIENTO m on d.renaes=cast(m.Codigo_Unico as int)
                    ORDER BY Provincia, Distrito, Nombre_Establecimiento;
                    with c as (select DOCUMENTO,  ROW_NUMBER() over(partition by DOCUMENTO order by DOCUMENTO) as duplicado
                    from BDHIS_MINSA_EXTERNO_V2.dbo.PADRONINICIO_GES)
                    delete  from c
                    where duplicado >1;");

        if($red_1 == 'TODOS'){
            $nominal = DB::table('dbo.PADRONINICIO_GES')
                        ->select('*', (DB::raw("CASE WHEN ((ATE_PLANIFICACION = TMZ_VIF) AND (ATE_PLANIFICACION IS NOT NULL) AND
                        (TMZ_VIF IS NOT NULL)) THEN 'CUMPLE' ELSE 'NO CUMPLE' END MIDE")))
                        ->orderBy('Provincia', 'ASC') ->orderBy('Distrito', 'ASC') ->orderBy('Nombre_Establecimiento', 'ASC')
                        ->get();
        }
        else if($red_1 != 'TODOS' && $dist == 'TODOS'){
            $nominal = DB::table('dbo.PADRONINICIO_GES')
                        ->select('*', (DB::raw("CASE WHEN ((ATE_PLANIFICACION = TMZ_VIF) AND (ATE_PLANIFICACION IS NOT NULL) AND
                        (TMZ_VIF IS NOT NULL)) THEN 'CUMPLE' ELSE 'NO CUMPLE' END MIDE"))) ->where('Provincia', $red)
                        ->orderBy('Provincia', 'ASC') ->orderBy('Distrito', 'ASC') ->orderBy('Nombre_Establecimiento', 'ASC')
                        ->get();
        }
        else if($dist != 'TODOS'){
            $nominal = DB::table('dbo.PADRONINICIO_GES')
                        ->select('*', (DB::raw("CASE WHEN ((ATE_PLANIFICACION = TMZ_VIF) AND (ATE_PLANIFICACION IS NOT NULL) AND
                        (TMZ_VIF IS NOT NULL)) THEN 'CUMPLE' ELSE 'NO CUMPLE' END MIDE"))) ->where('Distrito', $dist)
                        ->orderBy('Provincia', 'ASC') ->orderBy('Distrito', 'ASC') ->orderBy('Nombre_Establecimiento', 'ASC')
                        ->get();
        }

        $query2 = DB::statement(DB::raw("DROP TABLE BDHIS_MINSA_EXTERNO_V2.dbo.NUM_USERNEW_GES
                                        DROP TABLE BDHIS_MINSA_EXTERNO_V2.dbo.DEN_USERNEW_GES
                                        DROP TABLE BDHIS_MINSA_EXTERNO_V2.dbo.PADRONINICIO_GES"));

        return Excel::download(new UsersNewExport($nominal, $anio, $request->nameMonth, $request->his), 'DEIT_PASCO CG_FT_USUAR_NUEVAS_SERV_PLANIF_FAM - PPFF_CON_DX_VIOLENC (TMZ).xlsx');
    }
}