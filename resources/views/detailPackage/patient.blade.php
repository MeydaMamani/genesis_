<div class="row">
    {{-- <ul class="list-group p-1">
        <li class="list-group-item d-flex border-primary text-center">
            <div class="col-md-6">
                <b>Número de DNI: </b><span> 70969129</span>
            </div>
            <div class="col-md-6">
                <b>Fecha de Nacimiento:</b><span> 15-04-2022</span>
            </div>
        </li>
    </ul> --}}
    <div v-for="(format, key) in listPatient" class="col-sm-4 swing animated">
        <div class="card" style="box-shadow: 5px 5px 5px #999;">
            <div class="card-header p-2 text-center font-12" id="colors" style="background: #5ec9b099;">
                <div class="row">
                    <span class="col-md-6"><b>Id Cita:</b> [[ format.Id_Cita ]]</span>
                    <span class="col-md-6"><b>Fecha Atención:</b> [[ format.Fecha_Atencion ]]</span>
                </div>
            </div>
            <div class="card-body pt-2">
                <div class="mb-3 text-center">
                    <span class="col-md-12 font-10"><b><i class="mdi mdi-map-marker-radius"></i>[[ format.Provincia ]] / [[ format.Distrito ]] / [[ format.eess ]] </b></span>
                </div>
                <table class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr class="font-9 text-center">
                            <th class="align-middle">#</th>
                            <th class="align-middle">Lote</th>
                            <th class="align-middle">Tipo Diagnóstico</th>
                            <th class="align-middle">Código Item</th>
                            <th class="align-middle">Valor Lab</th>
                            <th class="align-middle">Descripción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(detail, key2) in listPatientDetail" class="text-center font-8">
                            <template v-if="format.Id_Cita == detail.cita">
                                <td class="align-middle">[[ key2+1 ]]</td>
                                <td class="align-middle">[[ detail.Lote ]]</td>
                                <td class="align-middle">[[ detail.tipoDiag ]]</td>
                                <td class="align-middle">[[ detail.codigo ]]</td>
                                <td class="align-middle">[[ detail.lab ]]</td>
                                <td class="align-middle">[[ detail.descripcion ]]</td>
                            </template>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br>