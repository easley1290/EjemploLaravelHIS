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
                                <h3 class="modal-title">EDITAR DOMINIO</h3>
                            </div>
                            <div class="body">
                            <form method="POST" action="{{ route('dominios.update', Crypt::encrypt($domEdit->domID)) }}">
                                    {{ csrf_field() }}
                                    @method('patch')
                                    <label for="anadir-nombre-dom">Nombre del Dominio</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="anadir-nombre-dom" name="anadir-nombre-dom"
                                            class="form-control" placeholder="Añade el nombre del dominio"
                                            onKeyPress="if(this.value.length==100) return false;"
                                            onkeyup="javascript:this.value=this.value.toUpperCase();" minlength="8"
                                            value="{{ $domEdit->domNom}}" required>
                                        </div>
                                    </div>

                                    <label for="anadir-descripcion-dom">Descripcion del dominio</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="anadir-descripcion-dom" name="anadir-descripcion-dom" class="form-control"
                                            onKeyPress="if(this.value.length==100) return false;"
                                            placeholder="Descripcion del dominio"
                                            onkeyup="javascript:this.value=this.value.toUpperCase();" minlength="8"
                                            value="{{ $domEdit->domDes}}" required>
                                        </div>
                                    </div>

                                    @if(trim($domEdit->domEst) == "1")
                                        <div class="form-group">
                                            <div class="form-group">
                                                <div class="switch">
                                                    <label>ACTIVO
                                                    <input type="checkbox" id="anadir-estado-dom" name="anadir-estado-dom" class="filled-in"
                                                    value="{{ $domEdit->domEst }}"
                                                    onclick="calcular()" checked><span class="lever"></span></label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(trim($domEdit->domEst) == "0")
                                        <div class="form-group">
                                            <div class="form-group">
                                                <div class="switch">
                                                    <label>ACTIVO
                                                        <input type="checkbox" id="anadir-estado-dom" name="anadir-estado-dom" class="filled-in"
                                                        value="{{ $domEdit->domEst }}"
                                                        onclick="calcular()"><span class="lever"></span></label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <button type="button" class="btn btn-success btn-block waves-effect"
                                    data-toggle="modal" data-target="#defaultModal"><i class="material-icons">done</i>&nbsp;MODIFICAR</button><br>

                                    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" style="display: none;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="defaultModalLabel" >¡¡ATENCION!!</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>¿Esta seguro de editar los datos?</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success waves-effect" style="border-radius: 0.5em;"><i class="material-icons">done</i>&nbsp;SI</button>
                                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" style="border-radius: 0.5em;"><i class="material-icons">clear</i>&nbsp;NO</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" style="display: none; border-radius: 0.5em;" >
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="defaultModalLabel" >¡¡ATENCION!!</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <h4>¿Esta seguro de editar los datos?</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success waves-effect" style="border-radius: 0.5em;"><i class="material-icons">done</i>&nbsp;SI</button>
                                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" style="border-radius: 0.5em;"><i class="material-icons">clear</i>&nbsp;NO</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <a href="{{ route('dominios') }}"><button type="cancel" class="btn btn-block btn-danger m-t-15 waves-effect"><i class="material-icons">clear</i>&nbsp;CANCELAR</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function calcular(){
                if (document.getElementById('anadir-estado-dom').checked==true){
                    document.getElementById('anadir-estado-dom').value="1";
                }else{
                    document.getElementById('anadir-estado-dom').value="0";
                }
            }
        </script>
    </section>
@endsection
