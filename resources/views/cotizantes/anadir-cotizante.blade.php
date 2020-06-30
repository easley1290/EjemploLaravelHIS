@extends('layouts.main')
@section('content')

    <section class="content">
        <div class="container-fluid">
            @if($errors->any())
            <div class="block-header">
                @foreach($errors->all() as $error)
                    <h2>{{ error }}</h2>
                @endforeach
            </div>
            @endif
            <div class="content">
                <div class="row clearfix col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h3 class="modal-title">AÑADIR COTIZANTE DE MANERA MANUAL</h3>
                            </div>
                            <div class="body">
                                <form method="POST" action="{{ route('cotizante.store') }}">
                                    {{ csrf_field() }}

                                    <label for="anadir-codigo-cot">CARNET DE IDENTIDAD DEL COTIZANTE</label>
                                    <div class="row clearfix">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="number" id="anadir-ci-cot" name="anadir-ci-cot"
                                                    class="form-control" onKeyPress="if(this.value.length==10) return false;" placeholder="Carnet del cotizante " required>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <select class="form-control" id="anadir-ciext-cot" name="anadir-ciext-cot">
                                                <option value="">-- SELECCIONE EXTENSION DE CARNET --</option>
                                                @foreach($sub as $su)
                                                    <option value="{{ $su->subNom }}">{{ $su->subDes }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <label for="anadir-nombre-inc">NOMBRE COMPLETO DEL COTIZANTE</label>
                                    <div class="row clearfix">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="anadir-nombre-cot" name="anadir-nombre-cot"
                                                    class="form-control" placeholder="Nombre(s) del cotizante"
                                                    onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="anadir-paterno-cot" name="anadir-paterno-cot"
                                                    class="form-control" placeholder="Apellido Paterno del cotizante"
                                                    onkeyup="javascript:this.value=this.value.toUpperCase();"required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="anadir-materno-cot" name="anadir-materno-cot"
                                                    class="form-control" placeholder="Apellido materno del cotizante"
                                                    onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <label for="anadir-dia-inc">SUELDO DEL COTIZANTE</label><br>
                                    <div class="row clearfix">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="anadir-haber-cot">Haber Basico</label>
                                                    <input type="number" id="anadir-haber-cot" name="anadir-haber-cot" onchange="calcular()"
                                                    class="form-control" step="0.01" placeholder="Haber basico del cotizante" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="anadir-antiguedad-cot">Bono de Antiguedad</label>
                                                    <input type="number" id="anadir-antiguedad-cot" name="anadir-antiguedad-cot" onchange="calcular()"
                                                    class="form-control" step="0.01" placeholder="Bonos de antiguedad del cotizante" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="anadir-otros-cot">Suma de otros bonos</label>
                                                    <input type="number" id="anadir-otros-cot" name="anadir-otros-cot" onchange="calcular()"
                                                    class="form-control" step="0.01" placeholder="Otro tipo de bonos del cotizante" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="anadir-totalganado-cot">Total ganado</label>
                                                    <input type="number" id="anadir-totalganado-cot" name="anadir-totalganado-cot"
                                                    class="form-control" step="0.01" placeholder="Total ganado del cotizante" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <label for="anadir-transferencia-cot">DOCUMENTO DE TRANSFERENCIA (SI, CORRESPONDE)</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="file" id="anadir-transferencia-cot" name="anadir-transferencia-cot" class="form-control"
                                             placeholder="Documento de transferencia">
                                        </div>
                                    </div>

                                    <label for="anadir-cargo-cot">CARGO QUE OCUPA EL COTIZANTE</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="anadir-cargo-cot" name="anadir-cargo-cot"
                                            class="form-control" placeholder="Cargo del Cotizante"
                                            onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                        </div>
                                    </div>

                                    <div class="row clearfix">{
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="anadir-codigo-cot">EMPRESA DEL COTIZANTE</label>
                                                    <select class="form-control" id="anadir-empresa-cot" name="anadir-empresa-cot">
                                                        <option value="">-- SELECCIONE LA EMPRESA DEL COTIZANTE --</option>
                                                        @foreach($emp as $em)
                                                            <option value="{{ $em->empID }}">{{ $em->empNom }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <label for="anadir-codigo-cot">ESTADO DE COTIZANTE</label>
                                                    <input type="text" id="anadir-codigo-cot" name="anadir-codigo-cot"
                                                    class="form-control" placeholder="Cargo del Cotizante" value="ALTA COTIZANTE PENDIENTE" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-block btn-success m-t-15 waves-effect"><i class="material-icons">done</i>&nbsp;AÑADIR</button><br>
                                </form>
                                <a href="{{ route('cotizante') }}"><button type="cancel" class="btn btn-block btn-danger m-t-15 waves-effect"><i class="material-icons">clear</i>&nbsp;CANCELAR</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function calcular(){
                dato1 = parseFloat(document.getElementById('anadir-haber-cot').value, 10);
                dato2 = parseFloat(document.getElementById('anadir-antiguedad-cot').value, 10);
                dato3 = parseFloat(document.getElementById('anadir-otros-cot').value, 10);
                document.getElementById('anadir-totalganado-cot').value = dato1 + dato2 + dato3;

            }
        </script>
    </section>
@endsection
