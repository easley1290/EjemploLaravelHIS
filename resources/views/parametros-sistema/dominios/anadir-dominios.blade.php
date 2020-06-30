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
                                <h3 class="modal-title">AÑADIR DOMINIO</h3>
                            </div>
                            <div class="body">
                            <form method="POST" action="{{ route('dominios.store') }}">
                                    {{ csrf_field() }}

                                    <label for="anadir-nombre-dom">Nombre del Dominio</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="anadir-nombre-dom" name="anadir-nombre-dom"
                                            class="form-control" placeholder="Añade el nombre del dominio"
                                            onKeyPress="if(this.value.length==100) return false;"
                                            onkeyup="javascript:this.value=this.value.toUpperCase();" minlength="8" required>
                                        </div>
                                    </div>

                                    <label for="anadir-descripcion-dom">Descripcion del dominio</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="anadir-descripcion-dom" name="anadir-descripcion-dom" class="form-control"
                                            onKeyPress="if(this.value.length==100) return false;"
                                            placeholder="Descripcion del dominio"
                                            onkeyup="javascript:this.value=this.value.toUpperCase();" minlength="8" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="switch">
                                            <label>ACTIVO
                                                <input type="checkbox" id="anadir-estado-dom" name="anadir-estado-dom" class="filled-in" value="1"
                                                onclick="calcular()" checked><span class="lever"></span></label>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-success btn-block waves-effect"
                                    data-toggle="modal" data-target="#smallModal"><i class="material-icons">done</i>&nbsp;AÑADIR</button><br>

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
