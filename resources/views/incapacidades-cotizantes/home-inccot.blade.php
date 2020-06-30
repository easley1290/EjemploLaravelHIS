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
                            <h1 >
                                <strong>REGISTRO DE INCAPACIDADES TEMPORALES A COTIZANTES</strong><br>
                                <small>Lista de incapacidades temporales emitidas a los cotizantes</small>
                            </h1>
                        </div>
                        <div class="body">
                            <div class="container">
                                <div class="center-block table-responsive col-md-12">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" >
                                        <thead style="background-color:darkmagenta; color:whitesmoke;">
                                            <tr>
                                                <th>C.I.</th>
                                                <th>COTIZANTE</th>
                                                <th>INCAPACIDAD TEMPORAL</th>
                                                <th>DIAS RECONOCIDOS</th>
                                                <th>MONTO RECONOCIDO</th>
                                                <th>FECHA INICIAL</th>
                                                <th>FECHA FINAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach ($datos as $dat)
                                                <td>{{ $dat->cotCi }}</td>
                                                <td>{{ $dat->cotApePat." ".$dat->cotApeMat." ".$dat->cotNom }}</td>
                                                <td>{{ $dat->incDes }}</td>
                                                <td>{{ $dat->cotIncDiaIni }}</td>
                                                <td>{{ round((float)$dat->cotIncSal, 2) }}</td>
                                                <td>{{ $dat->cotIncFecIni }}</td>
                                                <td>{{ $dat->cotIncFecFin }}</td>
                                                @endforeach
                                            </tr>
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
