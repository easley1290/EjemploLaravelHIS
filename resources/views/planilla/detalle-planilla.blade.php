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
                            <div class="row clearfix">
                                <div class="form-line">
                                    <div class="col-sm-9">
                                        <h1>
                                            <strong>DETALLE DE PLANILLA NRO. {{ $datosPlanilla[0]->plaNro }}</strong>
                                        </h1>
                                    </div>
                                    <div class="col-sm-3">
                                    <a href="{{ route('planilla') }}"><button type="cancel" class="btn btn-danger m-t-15 waves-effect"><i class="material-icons">reply</i>&nbsp;ATRAS</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header">
                            <div class="row clearfix">
                                <div class="form-line">
                                    <div class="col-sm-1"><input type="hidden"></div>
                                    <div class="col-sm-11">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="ver-empresa">EMPRESA:&nbsp;</label>
                                                <input type="text" id="ver-empresa" name="ver-empresa" class="form-control"
                                            placeholder="Empresa de planilla"  value="{{ $empresa[0]->empNom }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="ver-numero">NRO. DE PLANILLA:&nbsp;</label>
                                                <input type="number" id="ver-numero" name="ver-numero" class="form-control"
                                                placeholder="Numero de planilla"  value="{{ $datosPlanilla[0]->plaNro }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-1"><input type="hidden"></div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="form-line">
                                    <div class="col-sm-1"><input type="hidden"></div>
                                    <div class="col-sm-11">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="ver-mes">MES DE PLANILLA:&nbsp;</label>
                                                <input type="text" id="ver-mes" name="ver-mes" class="form-control"
                                                    placeholder="Mes de planilla"  value="{{ $datosPlanilla[0]->plaMesApo }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="ver-gestion">GESTION DE PLANILLA:&nbsp;</label>
                                                <input type="numero" id="ver-gestion" name="ver-gestion" class="form-control"
                                                        placeholder="Detalle de planilla"  value="{{ $datosPlanilla[0]->plaGesApo }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            @if ($datosPlanilla[0]->plaInd == 'NCO')
                                            <div class="form-group">
                                                <label for="ver-altaBaja">PLANILLA ES:&nbsp;</label><br>
                                                <input name="ver-altaBaja" type="radio" class="with-gap" id="altas" value="1" disabled>
                                                <label for="altas">Para cotizantes dados de alta</label>&nbsp;&nbsp;&nbsp;
                                                <input name="ver-altaBaja" type="radio" class="with-gap" id="bajas" value="0" checked disabled>
                                                <label for="bajas">Para cotizantes dados de baja</label>
                                            </div>
                                            @endif
                                            @if ($datosPlanilla[0]->plaInd == 'CO')
                                            <div class="form-group">
                                                <label for="ver-altaBaja">PLANILLA ES:&nbsp;</label><br>
                                                <input name="ver-altaBaja" type="radio" class="with-gap" id="altas" value="1" checked disabled>
                                                <label for="altas">Para cotizantes dados de alta</label>&nbsp;&nbsp;&nbsp;
                                                <input name="ver-altaBaja" type="radio" class="with-gap" id="bajas" value="0"  disabled>
                                                <label for="bajas">Para cotizantes dados de baja</label>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-1"><input type="hidden"></div>
                                </div>

                            </div>
                        </div>
                        <div class="body">
                            <h2>LISTA DE COTIZANTES</h2>
                            <div class="container center-block table-responsive">

                                <table class="table table-bordered table-striped table-hover" style="text-align:center;">
                                        <thead style="background-color: #900c3e; color: whitesmoke;">
                                            <tr height="80" vertical-align="super">
                                                <th>CI</th>
                                                <th>NOMBRE(S)</th>
                                                <th>APELLIDO PATERNO</th>
                                                <th>APELLIDO MATERNO</th>
                                                <th>IMPORTE EN PLANILLA</th>
                                                <th>CARGO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cotizantes as $cot)
                                            <tr>
                                                <td>{{ $cot->cotCi }}</td>
                                                <td>{{ $cot->cotNom }}</td>
                                                <td>{{ $cot->cotApePat }}</td>
                                                <td>{{ $cot->cotApeMat }}</td>
                                                <td>{{ round((float) $cot->cotApo, 2) }}</td>
                                                <td>{{ $cot->cotCargo }}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2"><strong>APORTE TOTAL DE PLANILLA</strong></td>
                                                <td colspan="2"></td>
                                                <td>{{ round((float) $aporteTotal[0]->suma, 2) }}</td>
                                                <td></td>
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
