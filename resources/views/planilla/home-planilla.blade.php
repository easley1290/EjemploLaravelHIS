@extends('layouts.main')
@section('content')
<section class="content">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status')}}
            </div>
        @endif
        <div class="container-fluid">
            <div class="content">
                <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h1>
                                <strong>REGISTRO DE PLANILLAS</strong><br>
                                <small>Lista de planillas registradas por la empresa.</small>
                            </h1>
                        </div>
                        <div class="body">
                            {{-- <div class="row clearfix">
                                <div class="form-line">
                                    <div class="col-md-3"><input type="hidden"></div>
                                    <div class="col-md-5"><input type="hidden"></div>
                                    <div class="col-md-3">
                                        <a href="{{ route('planilla.anadir') }}">
                                        <button type="button" class="btn btn-warning waves-effect m-r-20 float-right"><i class="material-icons">add</i>
                                            <span>Registrar planilla</span>
                                        </button>
                                        </a>
                                    </div>
                                    <div class="col-md-3">

                                    </div><br>
                                </div>
                            </div> --}}
                            <div class="container center-block table-responsive">
                                <table class="table table-bordered table-striped table-hover" style="text-align:center;">
                                        <thead style="background-color: #900c3e; color: whitesmoke;">
                                            <tr height="80" vertical-align="super">
                                                <th>NRO DE PLANILLA</th>
                                                <th>TIPO DE PLANILLA</th>
                                                <th>MES y GESTION DE PLANILLA</th>
                                                <th>EMPRESA</th>
                                                <th>NRO DE TRABAJADORES</th>
                                                <th>APORTE TOTAL</th>
                                                <th>ESTADO DE PLANILLA</th>
                                                <th colspan = "2">MAS OPCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($planilla as $pla)
                                                <tr>
                                                    <td>{{ $pla->plaNro }}</td>
                                                    <td>{{ $pla->plaTip }}</td>
                                                    <td>{{ $pla->plaMesApo." ".$pla->plaGesApo}}</td>
                                                    <td>{{ $pla->empNom }}</td>
                                                    <td>{{ $pla->plaNroTrab }}</td>
                                                    <td>{{ round($pla->plaApoTot, 2) }}</td>
                                                    <td>{{ $pla->plaEst }}</td>
                                                    <td><a href="{{ route('planilla.edit', Crypt::encrypt($pla->plaID)) }}">
                                                        <button type="button" class="btn btn-success waves-effect">
                                                            <i class="material-icons">edit</i>&nbsp;Editar
                                                        </button>
                                                    </a></td>
                                                    <td><a href="{{ route('planilla.detalle', Crypt::encrypt($pla->plaID)) }}">
                                                        <button type="button" class="btn btn-primary waves-effect">
                                                            <i class="material-icons">priority_high</i>&nbsp;Ver detalle
                                                        </button>
                                                    </a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
