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
                                <h3 class="modal-title">AÑADIR REGISTRO DE INCAPACIDAD TEMPORAL A COTIZANTE</h3>
                                <a href="javascript: history.go(-1)"><button type="button" class="btn btn-danger m-t-15 waves-effect"><i class="material-icons">fast_rewind</i>&nbsp;ATRAS</button></a>
                            </div>
                            <div class="body">
                                <form method="POST" action="{{ route('incapacidadCotizante.store') }}">
                                    {{ csrf_field() }}
                                    <label for=""><h4>DATOS DEL COTIZANTE</h4></label><hr>
                                    <label for="nro-pla">NRO. DE PLANILLA</label>
                                    <div class="row clearfix">
                                        <div class="form-line">
                                            <div class="col-sm-1">
                                                <div class="form-group">
                                                    <input type="number" id="nro-pla" name="nro-pla"
                                                            class="form-control" placeholder="Numero de planilla"
                                                            onKeyPress="if(this.value.length==3) return false;"
                                                            value="{{ $datosPlanilla[0]->plaNro }}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="form-line">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label for="nombre-cot">NOMBRE COMPLETO DEL COTIZANTE</label>
                                                <input type="hidden" name="codigo" value="{{ $cotizante->cotID }}">
                                                    <input type="text" id="nombre-cot" name="nombre-cot"
                                                    class="form-control" placeholder="Nombre del cotizante"
                                                    onKeyPress="if(this.value.length==50) return false;"
                                                    onkeyup="javascript:this.value=this.value.toUpperCase();"
                                                    value = "{{ $cotizante->cotApePat." ".$cotizante->cotApeMat." ".$cotizante->cotNom }}" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="nombre-cot">NUMERO DE MATRICULA</label>
                                                    <input type="text" id="nombre-cot" name="nombre-cot"
                                                    class="form-control" placeholder="Nombre del cotizante"
                                                    onKeyPress="if(this.value.length==50) return false;"
                                                    onkeyup="javascript:this.value=this.value.toUpperCase();"
                                                    value = "{{ $cotizante->pacMat}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="form-line">
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label for="nombre-cot">EMPRESA</label>
                                                    <input type="text" id="nombre-cot" name="nombre-cot"
                                                    class="form-control" placeholder="Nombre del cotizante"
                                                    onKeyPress="if(this.value.length==50) return false;"
                                                    onkeyup="javascript:this.value=this.value.toUpperCase();"
                                                    value = "{{ $empresa->empNom }}" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="nombre-cot">NUMERO HISTORIA CLINICA</label>
                                                    <input type="text" id="nombre-cot" name="nombre-cot"
                                                    class="form-control" placeholder="Nombre del cotizante"
                                                    onKeyPress="if(this.value.length==50) return false;"
                                                    onkeyup="javascript:this.value=this.value.toUpperCase();"
                                                    value = "{{ $cotizante->numHisCli}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <label for=""><h4>INFORMACION GENERAL</h4></label><hr>
                                    <div class="row clearfix">
                                        <label for="" style="padding-left: 10px;">MES Y AÑO DE INCAPACIDAD</label>
                                        <div class="form-line">
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="año">Año</label>
                                                    <input type="number" id="año" name="año"
                                                    class="form-control" placeholder="Año actual"
                                                    onKeyPress="if(this.value.length==4) return false;"
                                                    value = "{{ date('Y') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="mes">Mes</label>
                                                    <input type="text" id="mes" name="mes"
                                                    class="form-control" placeholder="Mes actual"
                                                    onKeyPress="if(this.value.length==4) return false;"
                                                    value = "{{ strtoupper(date('F')) }}" required>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="incapacidad">TIPO DE INCAPACIDAD</label>
                                                    <select class="form-control" id="incapacidad" name="incapacidad">

                                                        @foreach($incapacidades as $inc)
                                                            <option value="{{ $inc->incID }}">{{ $inc->incDes }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input class="form-control" type="hidden" value="a" disabled id="x">
                                                </div>
                                            </div>
                                            @if ($inc->incDes == "MATERNIDAD")
                                                <div class="col-sm-5" id="section" style="padding-top: 20px;">
                                                    <div class="form-group">
                                                        <div class="col-md-3">
                                                            <input name="matpn" type="radio" class="with-gap" id="pre" value="1" checked>
                                                            <label for="pre">Pre - natal</label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input name="matpn" type="radio" class="with-gap" id="post" value="0">
                                                            <label for="post">Post - natal</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="form-line">
                                            <div class="col-sm-5">
                                                <label for="">RANGO DE FECHAS DE BAJA</label>
                                                <div class="input-daterange input-group" id="bs_datepicker_range_container">
                                                    <div class="form-line">
                                                        <label for="finicio">Inicio</label>
                                                        <input type="text" class="form-control" name="finicio" id="finicio"
                                                        value="{{ $fechaIni }}" autocomplete="off" placeholder="Fecha de inicio">
                                                    </div>
                                                    <span class="input-group-addon"></span>
                                                    <div class="form-line">
                                                        <label for="ffin">Fin</label>
                                                        <input type="text" class="form-control" name="ffin" id="ffin"
                                                        value="{{ $fechaFin }}" autocomplete="off" placeholder="Fecha de fin">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="factor">FACTOR DE CALCULO</label>
                                                <div class="form-group">
                                                    <label for=""></label>
                                                    <input type="number" class="form-control"
                                                    name="factor" id="factor" placeholder="Fecha de inicio"
                                                    value="30" style="color: darkred; font-weight: bold;" disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="noreconoce">DIAS QUE NO SE RECONOCE</label>
                                                <div class="form-group">
                                                    <label for=""></label>
                                                    <input type="number" class="form-control"
                                                    name="noreconoce" id="noreconoce" placeholder="Fecha de inicio"
                                                    value="{{ $incapacidades[0]->incDiaVal }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <label for="porcentaje">PORCENTAJE QUE SE RECONOCE</label>
                                                <div class="form-group">
                                                    <label for=""></label>
                                                    <input type="text" class="form-control"
                                                    name="porcentaje" id="porcentaje" placeholder="Fecha de inicio"
                                                    value="{{ $incapacidades[0]->incPor."%" }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="form-line">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="salario">SALARIO DE COTIZANTE</label>
                                                    <input type="text" class="form-control"
                                                    name="salario" id="salario" placeholder="Fecha de inicio"
                                                    value="{{ "Bs. ".$cotizante->cotTotGan }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="diasinc">DIAS DE INCAPACIDAD</label>
                                                    <input type="number" class="form-control"
                                                    name="diasinc" id="diasinc" placeholder="Fecha de inicio"
                                                    value="{{ $numeroDias }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="diasrec">DIAS RECONOCIDOS POR EL ENTE GESTOR</label>
                                                    <input type="number" class="form-control"
                                                    name="diasrec" id="diasrec" placeholder="Fecha de inicio"
                                                    value="{{ $numeroDiasReconocidos }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="montorec">MONTO RECONOCIDO</label>
                                                    <input type="number" class="form-control"
                                                    name="montorec" id="montorec" placeholder="Fecha de inicio"
                                                    value="{{ $montoReconocido }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-line">
                                        <div class="form-group">
                                            <button class="btn btn-block btn-success waves-effect pull-right"><i class="material-icons">save</i>&nbsp;GUARDAR</button><br>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
             $('.datepicker').datepicker({
                format: 'dd/mm/yyyy'
            });
        </script>
    </section>
@endsection
