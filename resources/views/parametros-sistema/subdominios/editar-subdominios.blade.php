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
                                <h3 class="modal-title">EDITAR SUBDOMINIO</h3>
                            </div>
                            <div class="body">
                            <form method="POST" action="{{ route('subdominios.update', Crypt::encrypt($subEdit->subID)) }}">
                                    {{ csrf_field() }}
                                    @method('patch')
                                    <label for="anadir-nombre-dom">NOMBRE DEL SUBDOMINIO</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="anadir-nombre-sdom" name="anadir-nombre-sdom"
                                            class="form-control" placeholder="Añade el nombre del subdominio"
                                            onKeyPress="if(this.value.length==100) return false;"
                                            onkeyup="javascript:this.value=this.value.toUpperCase();" minlength="8"
                                            value="{{ $subEdit->subNom }}" required>
                                        </div>
                                    </div>

                                    <label for="anadir-descripcion-dom">DESCRIPCION DEL SUBDOMINIO</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="textarea" id="anadir-descripcion-sdom" name="anadir-descripcion-sdom" class="form-control"
                                            onKeyPress="if(this.value.length==100) return false;"
                                            placeholder="Descripcion del subdominio"
                                            onkeyup="javascript:this.value=this.value.toUpperCase();" minlength="8"
                                            value="{{ $subEdit->subDes }}" required>
                                        </div>
                                    </div>

                                    <div class="row cleafix">
                                        <div class="col-sm-6">
                                            <label for="anadir-dominio-sdom">LISTA DE DOMINIOS</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select name="anadir-dominio-sdom" id="anadir-dominio-sdom"">
                                                    <option value="{{ $subEdit ->domID_fk }}">{{ $subEdit->domNom." (SELECCIONADO)" }}</option>
                                                    <option value=""></option>
                                                        @foreach($dominios as $dominio)
                                                        <option value="{{ $dominio->domID }}">{{ $dominio->domNom }}</option>
                                                        @endforeach
                                                    </select>&nbsp;&nbsp;
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <label for="anadir-codanterior-sdom">CODIGO ANTERIOR DE SUBDOMINIO</label>
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" id="anadir-codanterior-sdom" name="anadir-codanterior-sdom"
                                                    class="form-control" placeholder="Solo si hubiese tenido uno active el switch"
                                                    onKeyPress="if(this.value.length==100) return false;"
                                                    onkeyup="javascript:this.value=this.value.toUpperCase();" minlength="8" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="switch">
                                                <label>HABILITAR
                                                    <input type="checkbox" id="habilitar" name="habilitar" class="filled-in" value="1"
                                                    onclick="habilitar()"  ><span class="lever"></span></label>
                                            </div>
                                        </div>
                                    </div>

                                    @if(trim($subEdit->subEst) == "1")
                                        <div class="form-group">
                                            <div class="form-group">
                                                <div class="switch">
                                                    <label>ACTIVO
                                                    <input type="checkbox" id="anadir-estado-dom" name="anadir-estado-dom" class="filled-in"
                                                    value="{{ $subEdit->subEst }}"
                                                    onclick="calcular()" checked><span class="lever"></span></label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(trim($subEdit->subEst) == "0")
                                        <div class="form-group">
                                            <div class="form-group">
                                                <div class="switch">
                                                    <label>ACTIVO
                                                        <input type="checkbox" id="anadir-estado-dom" name="anadir-estado-dom" class="filled-in"
                                                        value="{{ $subEdit->subEst }}"
                                                        onclick="calcular()"><span class="lever"></span></label>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <button type="button" class="btn btn-success btn-block waves-effect"
                                    data-toggle="modal" data-target="#smallModal"><i class="material-icons">done</i>&nbsp;MODIFICAR</button><br>

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
                                <a href="{{ route('subdominios') }}"><button type="cancel" class="btn btn-block btn-danger m-t-15 waves-effect"><i class="material-icons">clear</i>&nbsp;CANCELAR</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function calcular(){
                if (document.getElementById('anadir-estado-sdom').checked==true){
                    document.getElementById('anadir-estado-sdom').value="1";
                }else{
                    document.getElementById('anadir-estado-sdom').value="0";
                }
            }
            function habilitar(){
                if (document.getElementById('habilitar').checked == true){
                    document.getElementById('anadir-codanterior-sdom').disabled=false;
                }else{
                    document.getElementById('anadir-codanterior-sdom').disabled=true;
                }
            }
        </script>
    </section>
@endsection
