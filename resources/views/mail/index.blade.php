@extends('layouts.base')

@section('content')
    <div class="content-wrapper" id="appEmail">
        <section class="content">
            <div class="overlay-wrapper"></div>
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-8">
                            <h5 class="mb-0">Envio de Correos para Indicadores Fed</h5>
                        </div>
                        <div class="col-sm-4">
                            <ol class="breadcrumb float-sm-right font-14">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active"><a href="#">Enviar Correo</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="container-fluid">
                    <div class="col-md-6">
                        <form method="post" id="formulario">
                            <div class="col-md-12 mb-1 p-0">
                                <select class="form-control select2 show-tick" style="width: 100%;" v-model="red" name="red" id="red" @change="filtersDistricts" v-select2>
                                    <option value="">Seleccione Red</option>
                                    <option v-for="format in provinces" :value="format.Codigo_Red">[[ format.Red ]]</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-1 p-0">
                                <select class="form-control select2 show-tick" style="width: 100%;" v-model="distrito" name="distrito" id="distrito" v-select2>
                                    <option value="">Seleccione Distrito</option>
                                    <option v-for="format in districts" :value="format.Distrito">[[ format.Distrito ]]</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-1 p-0">
                                <select class="form-control select2 show-tick" style="width: 100%;" v-model="anio" id="anio" name="anio" v-select2>
                                    <option value="">Seleccione año</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-1 p-0">
                                <select class="form-control select2 show-tick" style="width: 100%;" v-model="mes" id="mes" name="mes" v-select2>
                                    <option value="">Seleccione mes</option>
                                    <option value="1">ENERO</option>
                                    <option value="2">FEBRERO</option>
                                    <option value="3">MARZO</option>
                                    <option value="4">ABRIL</option>
                                    <option value="5">MAYO</option>
                                    <option value="6">JUNIO</option>
                                    <option value="7">JULIO</option>
                                    <option value="8">AGOSTO</option>
                                    <option value="9">SETIEMBRE</option>
                                    <option value="10">OCTUBRE</option>
                                    <option value="11">NOVIEMBRE</option>
                                    <option value="12">DICIEMBRE</option>
                                </select>
                            </div>
                            <div class="col-md-12 p-0">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-primary btn-sm m-1 font-11" id="search" type="button" @click="searchForm"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                       {{-- <button class="btn btn-primary btn-sm" @click="searchForm">Enviar</button> --}}
                    </div>
                </div>
            </section>
        </section>
    </div>
    <script src="./js/email/prematuro.js"></script>
@endsection

@section('javascript')
@endsection