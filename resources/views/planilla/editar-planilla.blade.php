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
                                <h3 class="modal-title">EDITAR PLANILLA</h3>
                            </div>
                            <div class="body">
                            <form method="POST" action="{{ route('planilla.update', Crypt::encrypt($detalle[0]->plaID)) }}">
                                    @csrf
                                    @method('patch')
                                    <div class="row clearfix">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="anadir-numero-pla">NRO. DE PLANILLA</label>
                                                    <input type="number" step="1" id="anadir-numero-pla" name="anadir-numero-pla"
                                                    class="form-control" placeholder="numero de planilla"
                                                    value="{{ $detalle[0]->plaNro }}" required>
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
                                                    <select class="form-control" id="anadir-estado-pla" name="anadir-estado-pla">
                                                    <option value="{{ $detalle[0]->plaEst }}">{{ $detalle[0]->plaEst }}</option>
                                                    <option value="" disabled></option>
                                                        @foreach ($subdominios as $sub)
                                                            <option value="{{ $sub->subNom }}">{{ $sub->subNom }}</option>
                                                        @endforeach
                                                    </select>
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
                                                        <option value="{{ $detalle[0]->plaMesApo }}">{{ $detalle[0]->plaMesApo }}</option>
                                                        <option value="" disabled></option>
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
                                                    value="{{ $detalle[0]->plaGesApo }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <label for="anadir-empresa-pla">EMPRESA</label>
                                            <input type="text" id="anadir-empresa-pla" name="anadir-empresa-pla"
                                                    class="form-control" placeholder="Empresa de planilla"
                                                    value="{{ $empresa[0]->empNom }}" required>
                                        </div>
                                    </div>

                                    {{-- <div class="form-group">
                                        <div class="form-line">
                                            @if ($detalle[0]->plaInd == 'CO')
                                                <div class="col-md-2"><input type="hidden" disabled></div>
                                                <div class="col-md-3">
                                                    <input name="altaBaja" type="radio" class="with-gap" id="altas" value="1" checked>
                                                    <label for="altas">Para cotizantes dados de alta</label>
                                                </div>
                                                <div class="col-md-2"><input type="hidden" disabled></div>
                                                <div class="col-md-3">
                                                    <input name="altaBaja" type="radio" class="with-gap" id="bajas" value="0">
                                                    <label for="bajas">Para cotizantes dados de baja</label>
                                                </div>
                                                <div class="col-md-2"><input type="hidden" disabled></div>
                                            @endif
                                            @if ($detalle[0]->plaInd == 'NCO')
                                            <div class="col-md-2"><input type="hidden" disabled></div>
                                            <div class="col-md-3">
                                                <input name="altaBaja" type="radio" class="with-gap" id="altas" value="1" >
                                                <label for="altas">Para cotizantes dados de alta</label>
                                            </div>
                                            <div class="col-md-2"><input type="hidden" disabled></div>
                                            <div class="col-md-3">
                                                <input name="altaBaja" type="radio" class="with-gap" id="bajas" value="0" checked>
                                                <label for="bajas">Para cotizantes dados de baja</label>
                                            </div>
                                            <div class="col-md-2"><input type="hidden" disabled></div>
                                        @endif
                                        </div>
                                    </div> --}}
                                    <button type="button" class="btn btn-success btn-block waves-effect"
                                    data-toggle="modal" data-target="#smallModal"><i class="material-icons">done</i>&nbsp;AÑADIR</button><br>

                                    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" style="display: none; border-radius: 0.5em;" >
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header" style="background-color: #F44336; color:whitesmoke; text-align:center;">
                                                    <h3 class="modal-title" id="smallModalLabel" >¡¡ATENCION!!</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>¿Esta seguro de modificar los datos?</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success waves-effect" style="border-radius: 0.5em;"><i class="material-icons">done</i>&nbsp;SI</button>
                                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" style="border-radius: 0.5em;"><i class="material-icons">clear</i>&nbsp;NO</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <a href="{{ route('planilla') }}">
                                    <button type="cancel" class="btn btn-block btn-danger m-t-15 waves-effect"><i class="material-icons">clear</i>&nbsp;CANCELAR</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
