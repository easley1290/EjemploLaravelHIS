@extends('layouts.main')
@section('content')

    <section class="content">
        <div class="container-fluid">
            @if($errors->any())
            <div class="block-header">
                @foreach($errors->all() as $error)
                    <h2>{{ $error }}</h2>
                @endforeach
            </div>
            @endif
            <div class="content">
                <div class="row clearfix col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h3 class="modal-title">LISTA DE COTIZANTES</h3>
                            </div>
                            <div class="body">
                                <form method="GET" action="{{ route('incapacidadCotizante.anadir') }}">
                                    {{ csrf_field() }}
                                    <label for="buscar-cot"> PRIMERO REALICE LA BUSQUEDA DEL COTIZANTE</label>
                                    <div class="row clearfix">
                                        <div class="form-line">
                                            <div class="col-sm-3"><input type="hidden" disabled></div>
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                <select class="form-control selectpicker" data-live-search="true" id="buscar-cot" name="buscar-cot">
                                                    <option value="" style="padding-left: 45px;">-- SELECCIONE AL COTIZANTE --</option>
                                                    @foreach($cotizantes as $cot)
                                                        <option value="{{ $cot->cotID }}" style="padding-left: 45px;">{{ $cot->cotApePat." ".$cot->cotApeMat." ".$cot->cotNom }}</option>
                                                    @endforeach
                                                </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <button class="btn btn-success waves-effect"><i class="material-icons">search</i>&nbsp;BUSCAR</button>
                                                </div>
                                            </div>
                                            <div class="col-sm-2"><input type="hidden" disabled></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <div class="container">
                                    <div class="center-block table-responsive">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable" >
                                            <thead style="background-color:darkmagenta; color:whitesmoke;">
                                                <tr>
                                                    <th>C.I.</th>
                                                    <th>NOMBRE COMPLETO DEL COTIZANTE</th>
                                                    <th>EMPRESA</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($seleccion as $cot)
                                                    <tr>
                                                        <td>{{$cot->cotCi}}</td>
                                                        <td>{{$cot->cotApePat." ".$cot->cotApeMat." ".$cot->cotNom}}</td>
                                                        <td>{{$cot->empNom}}</td>
                                                        <td>
                                                            <a href="{{ route('incapacidadCotizante.show', Crypt::encrypt($cot->cotID)) }}">
                                                                <button class="btn btn-primary waves-effect"><i class="material-icons">add</i>&nbsp;REGISTRAR INCAPACIDAD</button>
                                                            </a>
                                                        </td>
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
        </div>
    </section>
@endsection
