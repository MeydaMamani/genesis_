<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <div>
        <h2>Levantar Observaciones de Indicadores Fed</h2>
        <p>Por favor levantar observaciones del mes correspondiente</p>
        <table>
            <thead>
                <tr>
                    <td colspan="13" style="font-size: 20px; font-weight: 600; text-align: center;">DIRESA PASCO DEIT</td>
                </tr>
                <tr><td colspan="13"></td></tr>
                <tr>
                    <td colspan="13" style="font-size: 18px; font-weight: 600; text-align: center;">Niños Prematuros CG03 - Enero 2023 </td>
                </tr>
                <br>
            </thead>
            <thead>
                <tr>
                    <th style="background: #e0eff5; font-weight: 600; text-align: center; ">#</th>
                    <th style="background: #e0eff5; font-weight: 600; text-align: center; ">Provincia</th>
                    <th style="background: #e0eff5; font-weight: 600; text-align: center; ">Distrito</th>
                    <th style="background: #e0eff5; font-weight: 600; text-align: center; ">Establecimiento</th>
                    <th style="background: #e0eff5; font-weight: 600; text-align: center; ">Tipo Documento</th>
                    <th style="background: #e0eff5; font-weight: 600; text-align: center; ">Documento</th>
                    <th style="background: #e0eff5; font-weight: 600; text-align: center; ">Apellidos y Nombres</th>
                    <th style="background: #e0eff5; font-weight: 600; text-align: center; ">Fecha Nacido</th>
                    <th style="background: #e0eff5; font-weight: 600; text-align: center; ">Tipo Seguro</th>
                    <th style="background: #e0eff5; font-weight: 600; text-align: center; ">Menor Visitado</th>
                    <th style="background: #e0eff5; font-weight: 600; text-align: center; ">Suplementado</th>
                    <th style="background: #e0eff5; font-weight: 600; text-align: center; ">Se Atiende</th>
                </tr>
            </thead>
            <tbody>
                {{-- <td><img src="{{URL::asset('/images/avartar.png')}}" /></td> --}}
                @foreach($nominal as $pr)
                    <tr style="text-align: center; font-size: 11px;">
                        <td>{{ $loop->iteration }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_PROV }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_DIST }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_EESS }}</td>
                        <td>
                            @if ($pr->Tipo_Doc_Paciente == 1) DNI
                            @elseif ($pr->Tipo_Doc_Paciente == 2) CE
                            @elseif ($pr->Tipo_Doc_Paciente == 3) PASS
                            @elseif ($pr->Tipo_Doc_Paciente == 4) DIE
                            @elseif ($pr->Tipo_Doc_Paciente == 5) SIN DOCUMENTO
                            @elseif ($pr->Tipo_Doc_Paciente == 6) CNV
                            @else -
                            @endif
                        </td>
                        <td>{{ $pr->CNV_O_DNI }}</td>
                        <td>{{ $pr->full_name }}</td>
                        <td>{{ $pr->FECHA_NACIMIENTO_NINO }}</td>
                        <td>{{ $pr->TIPO_SEGURO }}</td>
                        <td>{{ $pr->MENOR_VISITADO }}</td>
                        <td>{{ $pr->SUPLEMENTADO }}</td>
                        <td>{{ $pr->Establecimiento }}</td>
                    </tr>
                @endforeach
                @foreach($nominal as $pr)
                    <tr style="text-align: center; font-size: 11px;">
                        <td>{{ $loop->iteration }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_PROV }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_DIST }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_EESS }}</td>
                        <td>
                            @if ($pr->Tipo_Doc_Paciente == 1) DNI
                            @elseif ($pr->Tipo_Doc_Paciente == 2) CE
                            @elseif ($pr->Tipo_Doc_Paciente == 3) PASS
                            @elseif ($pr->Tipo_Doc_Paciente == 4) DIE
                            @elseif ($pr->Tipo_Doc_Paciente == 5) SIN DOCUMENTO
                            @elseif ($pr->Tipo_Doc_Paciente == 6) CNV
                            @else -
                            @endif
                        </td>
                        <td>{{ $pr->CNV_O_DNI }}</td>
                        <td>{{ $pr->full_name }}</td>
                        <td>{{ $pr->FECHA_NACIMIENTO_NINO }}</td>
                        <td>{{ $pr->TIPO_SEGURO }}</td>
                        <td>{{ $pr->MENOR_VISITADO }}</td>
                        <td>{{ $pr->SUPLEMENTADO }}</td>
                        <td>{{ $pr->Establecimiento }}</td>
                    </tr>
                @endforeach
                @foreach($nominal as $pr)
                    <tr style="text-align: center; font-size: 11px;">
                        <td>{{ $loop->iteration }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_PROV }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_DIST }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_EESS }}</td>
                        <td>
                            @if ($pr->Tipo_Doc_Paciente == 1) DNI
                            @elseif ($pr->Tipo_Doc_Paciente == 2) CE
                            @elseif ($pr->Tipo_Doc_Paciente == 3) PASS
                            @elseif ($pr->Tipo_Doc_Paciente == 4) DIE
                            @elseif ($pr->Tipo_Doc_Paciente == 5) SIN DOCUMENTO
                            @elseif ($pr->Tipo_Doc_Paciente == 6) CNV
                            @else -
                            @endif
                        </td>
                        <td>{{ $pr->CNV_O_DNI }}</td>
                        <td>{{ $pr->full_name }}</td>
                        <td>{{ $pr->FECHA_NACIMIENTO_NINO }}</td>
                        <td>{{ $pr->TIPO_SEGURO }}</td>
                        <td>{{ $pr->MENOR_VISITADO }}</td>
                        <td>{{ $pr->SUPLEMENTADO }}</td>
                        <td>{{ $pr->Establecimiento }}</td>
                    </tr>
                @endforeach
                @foreach($nominal as $pr)
                    <tr style="text-align: center; font-size: 11px;">
                        <td>{{ $loop->iteration }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_PROV }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_DIST }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_EESS }}</td>
                        <td>
                            @if ($pr->Tipo_Doc_Paciente == 1) DNI
                            @elseif ($pr->Tipo_Doc_Paciente == 2) CE
                            @elseif ($pr->Tipo_Doc_Paciente == 3) PASS
                            @elseif ($pr->Tipo_Doc_Paciente == 4) DIE
                            @elseif ($pr->Tipo_Doc_Paciente == 5) SIN DOCUMENTO
                            @elseif ($pr->Tipo_Doc_Paciente == 6) CNV
                            @else -
                            @endif
                        </td>
                        <td>{{ $pr->CNV_O_DNI }}</td>
                        <td>{{ $pr->full_name }}</td>
                        <td>{{ $pr->FECHA_NACIMIENTO_NINO }}</td>
                        <td>{{ $pr->TIPO_SEGURO }}</td>
                        <td>{{ $pr->MENOR_VISITADO }}</td>
                        <td>{{ $pr->SUPLEMENTADO }}</td>
                        <td>{{ $pr->Establecimiento }}</td>
                    </tr>
                @endforeach
                @foreach($nominal as $pr)
                    <tr style="text-align: center; font-size: 11px;">
                        <td>{{ $loop->iteration }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_PROV }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_DIST }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_EESS }}</td>
                        <td>
                            @if ($pr->Tipo_Doc_Paciente == 1) DNI
                            @elseif ($pr->Tipo_Doc_Paciente == 2) CE
                            @elseif ($pr->Tipo_Doc_Paciente == 3) PASS
                            @elseif ($pr->Tipo_Doc_Paciente == 4) DIE
                            @elseif ($pr->Tipo_Doc_Paciente == 5) SIN DOCUMENTO
                            @elseif ($pr->Tipo_Doc_Paciente == 6) CNV
                            @else -
                            @endif
                        </td>
                        <td>{{ $pr->CNV_O_DNI }}</td>
                        <td>{{ $pr->full_name }}</td>
                        <td>{{ $pr->FECHA_NACIMIENTO_NINO }}</td>
                        <td>{{ $pr->TIPO_SEGURO }}</td>
                        <td>{{ $pr->MENOR_VISITADO }}</td>
                        <td>{{ $pr->SUPLEMENTADO }}</td>
                        <td>{{ $pr->Establecimiento }}</td>
                    </tr>
                @endforeach
                @foreach($nominal as $pr)
                    <tr style="text-align: center; font-size: 11px;">
                        <td>{{ $loop->iteration }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_PROV }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_DIST }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_EESS }}</td>
                        <td>
                            @if ($pr->Tipo_Doc_Paciente == 1) DNI
                            @elseif ($pr->Tipo_Doc_Paciente == 2) CE
                            @elseif ($pr->Tipo_Doc_Paciente == 3) PASS
                            @elseif ($pr->Tipo_Doc_Paciente == 4) DIE
                            @elseif ($pr->Tipo_Doc_Paciente == 5) SIN DOCUMENTO
                            @elseif ($pr->Tipo_Doc_Paciente == 6) CNV
                            @else -
                            @endif
                        </td>
                        <td>{{ $pr->CNV_O_DNI }}</td>
                        <td>{{ $pr->full_name }}</td>
                        <td>{{ $pr->FECHA_NACIMIENTO_NINO }}</td>
                        <td>{{ $pr->TIPO_SEGURO }}</td>
                        <td>{{ $pr->MENOR_VISITADO }}</td>
                        <td>{{ $pr->SUPLEMENTADO }}</td>
                        <td>{{ $pr->Establecimiento }}</td>
                    </tr>
                @endforeach
                @foreach($nominal as $pr)
                    <tr style="text-align: center; font-size: 11px;">
                        <td>{{ $loop->iteration }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_PROV }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_DIST }}</td>
                        <td style="text-align: left !important;">{{ $pr->NOMBRE_EESS }}</td>
                        <td>
                            @if ($pr->Tipo_Doc_Paciente == 1) DNI
                            @elseif ($pr->Tipo_Doc_Paciente == 2) CE
                            @elseif ($pr->Tipo_Doc_Paciente == 3) PASS
                            @elseif ($pr->Tipo_Doc_Paciente == 4) DIE
                            @elseif ($pr->Tipo_Doc_Paciente == 5) SIN DOCUMENTO
                            @elseif ($pr->Tipo_Doc_Paciente == 6) CNV
                            @else -
                            @endif
                        </td>
                        <td>{{ $pr->CNV_O_DNI }}</td>
                        <td>{{ $pr->full_name }}</td>
                        <td>{{ $pr->FECHA_NACIMIENTO_NINO }}</td>
                        <td>{{ $pr->TIPO_SEGURO }}</td>
                        <td>{{ $pr->MENOR_VISITADO }}</td>
                        <td>{{ $pr->SUPLEMENTADO }}</td>
                        <td>{{ $pr->Establecimiento }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
