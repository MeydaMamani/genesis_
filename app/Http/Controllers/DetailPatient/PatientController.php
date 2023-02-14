<?php

namespace App\Http\Controllers\DetailPatient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function index() {
        return view('detailPackage.index');
    }

    public function searchKids(Request $request){
        $doc = $request->doc;
        $dataPn = DB::connection('BD_PADRON_NOMINAL') ->table('NOMINAL_PADRON_NOMINAL') ->select('NOMBRE_PROV', 'NOMBRE_DIST', 'FECHA_NACIMIENTO_NINO')
                ->where('NUM_CNV', $doc) ->orWhere('NUM_DNI', $doc) ->count();

        if($dataPn > 0){
            $nominal = DB::connection('PAQUETE') ->table('DETALLE_NINO_COMPLETO') ->select('*') ->where('DOCUMENTO', $doc) ->get();
        }else{
            $dataHis = DB::connection('BDHIS_MINSA') ->table('T_CONSOLIDADO_NUEVA_TRAMA_HISMINSA') ->select('Provincia_Establecimiento', 'Distrito_Establecimiento', 'Fecha_Nacimiento_Paciente')
                    ->where('Numero_Documento_Paciente', $doc) ->count();

            if($dataHis > 0){
                $nominal = DB::connection('PAQUETE') ->table('DETALLE_NINO_COMPLETO_HIS') ->select('*') ->where('DOCUMENTO', $doc) ->get();
            }else{
                $nominal = '';
            }
        }

        return response()->json($nominal);
    }

    public function searchPregnant(Request $request){
        $doc = $request->doc;
        $dataHis = DB::connection('BDHIS_MINSA') ->table('T_CONSOLIDADO_NUEVA_TRAMA_HISMINSA') ->select('Provincia_Establecimiento', 'Distrito_Establecimiento', 'Fecha_Nacimiento_Paciente')
                    ->where('Numero_Documento_Paciente', $doc) ->count();

        if($dataHis > 0){
            $nominal = DB::connection('PAQUETE') ->table('PADRONGESTANTES') ->select('*') ->where('DOCUMENTO', $doc) ->get();
        }else{
            $nominal = '';
        }

        return response()->json($nominal);
    }

    public function searchPatient(Request $request){
        $doc = $request->doc;
        $dataHis = DB::connection('BDHIS_MINSA') ->table('DETALLE_PACIENTE')
                    ->where('Numero_Documento_Paciente', $doc) ->count();

        if($dataHis > 0){
            $dataHis = DB::connection('BDHIS_MINSA') ->table('dbo.DETALLE_PACIENTE')
                        ->select((DB::raw("distinct(Id_Cita)")), 'Fecha_Atencion', 'Fecha_Nacimiento_Paciente as FechaNacido',
                        'Numero_Documento_Paciente as documento', 'Provincia_Establecimiento as Provincia', 'Distrito_Establecimiento as Distrito',
                        'Nombre_Establecimiento as eess') ->where('Numero_Documento_Paciente', $doc) ->orderBy('Id_Cita', 'DESC')
                        ->get();

            $dataHis2 = DB::connection('BDHIS_MINSA') ->table('dbo.DETALLE_PACIENTE')
                        ->select('Lote', 'Tipo_Diagnostico as tipoDiag', 'Codigo_Item as codigo',
                        'Valor_Lab as lab', 'Descripcion_Item as descripcion', 'Id_Cita as cita')
                        ->where('Numero_Documento_Paciente', $doc) ->where('Fecha_Nacimiento_Paciente', '>=', '1960-01-01')
                        ->get();

            $query[] = json_decode($dataHis, true);
            $query[] = json_decode($dataHis2, true);
            $result= json_encode($query);
        }else{
            $result = '';
        }

        return response(($result), 200);
    }
}
