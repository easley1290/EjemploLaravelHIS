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
                                <div class="row clearfix">
                                    <div class="form-line">
                                        <div class="col-sm-11">
                                            <h3 class="modal-title">AÑADIR PLANILLA DE FORMA MANUAL</h3><br>

                                        </div>
                                        <div class="col-sm-1">
                                            <a href="{{ route('planilla') }}">
                                                <button type="cancel" class="btn btn-danger m-t-15 waves-effect"><i class="material-icons">clear</i></button>
                                            </a>
                                        </div><br>

                                    </div>
                                </div>
                                <h4 class="modal-title">Lista de cotizantes de su empresa</h4>
                            </div>
                            <div class="body">
                                    <div class="container">
                                        <div class="center-block table-responsive col-md-12">
                                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable" >
                                                <thead style="background-color:darkmagenta; color:whitesmoke;">
                                                    <tr>
                                                        <th>C.I.</th>
                                                        <th>NOMBRE(s)</th>
                                                        <th>APELLIDO PATERNO</th>
                                                        <th>APELLIDO MATERNO</th>
                                                        <th>CARGO</th>
                                                        <th>ESTADO DE COTIZANTE</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($listaCotizantes as $cot)
                                                        <tr>
                                                            <td>{{ $cot->cotCi }}</td>
                                                            <td>{{ $cot->cotNom }}</td>
                                                            <td>{{ $cot->cotApePat }}</td>
                                                            <td>{{ $cot->cotApeMat }}</td>
                                                            <td>{{ $cot->cotCargo }}</td>
                                                            <td>{{ $cot->altTip }}</td>
                                                            <td>
                                                                <form action="{{ route('planilla.darBaja', Crypt::encrypt($cot->cotID)) }}" method="POST">
                                                                    @csrf
                                                                    <button class="btn btn-info waves-effect"><i class="material-icons">delete</i>&nbsp;DAR BAJA</button>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="row clearfix">
                                                <div class="form-line">
                                                    <div class="col-md-10"><input type="hidden"></div>
                                                    <div class="col-md-2"><button type="button" class="btn btn-warning waves-effect m-r-20"
                                                        data-toggle="modal" data-target="#largeModal"><i class="material-icons">fast_forward</i>&nbsp;SIGUIENTE</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <form method="POST" action="{{ route('planilla.store') }}">
                                        {{ csrf_field() }}
                                        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #F44336; color:whitesmoke; text-align:center;">
                                                        <h3 class="modal-title" id="smallModalLabel" >AÑADIR PLANILLA</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row clearfix">
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <label for="anadir-nro-pla">NRO. PLANILLA</label>
                                                                        <input type="number" step="1" id="anadir-nro-pla" name="anadir-nro-pla"
                                                                        class="form-control" placeholder="Gestion del aporte"
                                                                        value="{{ $nroPlanilla }}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <label for="anadir-tipo-pla">TIPO DE PLANILLA</label>
                                                                        <select class="form-control" id="anadir-tipo-pla" name="anadir-tipo-pla">
                                                                            <option value="PLANILLA DE SUELDOS">PLANILLA DE SUELDOS</option>
                                                                            {{-- @foreach ($tipo as $tip)
                                                                                <option value="{{ $tip->subNom }}">{{ $tip->subNom }}</option>
                                                                            @endforeach --}}
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <label for="anadir-estado-pla">ESTADO DE PLANILLA</label>
                                                                        <input type="text" id="anadir-estado-pla" name="anadir-estado-pla"
                                                                        class="form-control" placeholder="Cargo del Cotizante" value="PLANILLA PENDIENTE" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row clearfix">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <label for="anadir-mes-pla">MES DE LA PLANILLA</label>
                                                                        <select class="form-control" id="anadir-mes-pla" name="anadir-mes-pla">
                                                                            <option value="ENERO">ENERO</option>
                                                                            <option value="FEBRERO">FEBRERO</option>
                                                                            <option value="MARZO">MARZO</option>
                                                                            <option value="ABRIL">ABRIL</option>
                                                                            <option value="MAYO">MAYO</option>
                                                                            <option value="JUNIO">JUNIO</option>
                                                                            <option value="JULIO">JULIO</option>
                                                                            <option value="AGOSTO">AGOSTO</option>
                                                                            <option value="SEPTIEMBRE">SEPTIEMBRE</option>
                                                                            <option value="OCTUBRE">OCTUBRE</option>
                                                                            <option value="NOVIEMBRE">NOVIEMBRE</option>
                                                                            <option value="DICIEMBRE">DICIEMBRE</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <label for="anadir-ges-pla">GESTION DE LA PLANILLA</label>
                                                                        <input type="number" id="anadir-ges-pla" name="anadir-ges-pla"
                                                                        class="form-control" placeholder="Gestion del aporte"
                                                                        value="{{ date('Y') }}" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <label for="anadir-empresa-pla">SELECCIONE LA EMPRESA</label>
                                                                <select class="form-control" id="anadir-empresa-pla" name="anadir-empresa-pla" required>
                                                                    <option value="">-- SELECCIONE UNA EMPRESA --</option>
                                                                    @foreach ($empresas as $empresa)
                                                                        <option value="{{ $empresa->empID }}">{{ $empresa->empNom }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="form-line">
                                                                <div class="col-md-2"><input type="hidden" disabled></div>
                                                                <div class="col-md-3">
                                                                    <input name="altaBaja" type="radio" class="with-gap" id="altas" value="1" checked>
                                                                    <label for="altas">Para cotizantes (alta)</label>
                                                                </div>
                                                                <div class="col-md-2"><input type="hidden" disabled></div>
                                                                <div class="col-md-3">
                                                                    <input name="altaBaja" type="radio" class="with-gap" id="bajas" value="0">
                                                                    <label for="bajas">Para cotizantes (baja)</label>
                                                                </div>

                                                                <div class="col-md-2"><input type="hidden" disabled></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success waves-effect"
                                                        data-toggle="modal" data-target="#smallModal"><i class="material-icons">done</i>&nbsp;AÑADIR</button>
                                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" style="border-radius: 0.5em;"><i class="material-icons">clear</i>&nbsp;CANCELAR</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" style="display: none; border-radius: 0.5em;" >
                                            <div class="modal-dialog modal-sm" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #F44336; color:whitesmoke; text-align:center;">
                                                        <h3 class="modal-title" id="smallModalLabel" >¡¡ATENCION!!</h3>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4>¿Esta seguro de ingresar los datos proporcionados?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success waves-effect" style="border-radius: 0.5em;"><i class="material-icons">done</i>&nbsp;SI</button>
                                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" style="border-radius: 0.5em;"><i class="material-icons">clear</i>&nbsp;NO</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
