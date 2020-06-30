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
                                <h3 class="modal-title">EDITAR REGISTRO DE INCAPACIDAD TEMPORAL</h3>
                            </div>
                            <div class="body">
                                <form method="post" action="{{ route('incTemporal.update', $incEdit->incID) }}">
                                    {{ csrf_field() }}
                                    @method('patch')

                                    <label for="anadir-codigo-inc">Codigo de Incapacidad Temporal</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="anadir-codigo-inc" name="anadir-codigo-inc"
                                            class="form-control" placeholder="Añade el codigo de la incapacidad" required value="{{ $incEdit->incID }}">
                                        </div>
                                    </div>

                                    <label for="anadir-nombre-inc">Nombre de Incapacidad Temporal</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="anadir-nombre-inc" name="anadir-nombre-inc"
                                            class="form-control" placeholder="Añade el nombre de la incapacidad" required value="{{ $incEdit->incDes }}">
                                        </div>
                                    </div>

                                    <label for="anadir-dia-inc">Desde que dia tendra validez esta incapacidad</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="anadir-dia-inc" name="anadir-dia-inc" class="form-control"
                                            onKeyPress="if(this.value.length==2) return false;"  placeholder="Desde que dia tendra validez esta incapacidad"
                                            value="{{ $incEdit->incDiaVal }}" required>
                                        </div>
                                    </div>

                                    <label for="anadir-porcentaje-inc">Porcentaje de subsidio</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" id="anadir-porcentaje-inc" name="anadir-porcentaje-inc" min="0" max="100" class="form-control"
                                            onKeyPress="if(this.value.length==3) return false;"  placeholder="Añada solo el numero de porcentaje de subsidio"
                                            value="{{ $incEdit->incPor }}"required>
                                        </div>
                                    </div>
                                    @if(trim($incEdit->incEst) == "1")
                                        <div class="form-group">
                                            <div class="switch">
                                                <label>ACTIVO <input type="checkbox" id="anadir-estado-inc" name="anadir-estado-inc" class="filled-in"
                                                                value="{{ trim($incEdit->incEst) }}"
                                                                onclick="calcular()" checked ><span class="lever"></span></label>
                                            </div>
                                        </div>
                                    @endif
                                    @if(trim($incEdit->incEst) == "0")
                                        <div class="form-group">
                                            <div class="switch">
                                                <label>ACTIVO <input type="checkbox" id="anadir-estado-inc" name="anadir-estado-inc" class="filled-in"
                                                                value="{{ trim($incEdit->incEst) }}"
                                                                onclick="calcular()" ><span class="lever"></span></label>
                                            </div>
                                        </div>
                                    @endif

                                    <button class="btn btn-block btn-success m-t-15 waves-effect"><i class="material-icons">done</i>&nbsp;AÑADIR</button><br>

                                </form>
                                <a href="{{ route('incTemporal') }}"><button type="cancel" class="btn btn-block btn-danger m-t-15 waves-effect"><i class="material-icons">clear</i>&nbsp;CANCELAR</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function calcular(){
                if (document.getElementById('anadir-estado-inc').checked==true){
                    document.getElementById('anadir-estado-inc').value="1";
                    document.getElementById('nombre').value=document.getElementById('anadir-estado-inc').value;
                }else{
                    document.getElementById('anadir-estado-inc').value="0";
                    document.getElementById('nombre').value=document.getElementById('anadir-estado-inc').value;
                }
            }
        </script>
    </section>
@endsection
