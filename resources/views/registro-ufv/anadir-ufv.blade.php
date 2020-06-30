@extends('layouts.main')
@section('content')

    <section class="content">
        <div class="container-fluid">
            @if($errors->any())
            <div class="block-header">
                @foreach($errors->all() as $e)
                    <h2>{{ $e }}</h2>
                @endforeach
            </div>
            @endif
            <div class="content">
                <div class="row clearfix col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h3 class="modal-title">AÑADIR REGISTRO DE UFV</h3>
                            </div>
                            <div class="body">
                                <form method="POST" action="{{ route('ufv.store') }}">
                                    {{ csrf_field() }}

                                    <label for="anadir-descripcion">Descripcion</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" id="anadir-descripcion" name="anadir-descripcion" class="form-control"
                                            placeholder="Añade una Descripcion"  value="UFV ({{ now()->format('M') }})">
                                        </div>
                                    </div>
                                    <label for="anadir-valor">Valor de UFV</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="number" step="0.0001" id="anadir-valor" name="anadir-valor" class="form-control" onKeyPress="if(this.value.length==6) return false;"  placeholder="Introduce el valor de UFV EJ:X,XXXX">
                                        </div>
                                    </div>
                                    <label for="anadir-fecha">Fecha de UFV</label>
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="date" id="anadir-fecha" name="anadir-fecha" class="form-control" placeholder="Fecha de valor de UFV"  value="{{ now()->format('d/m/Y') }}">
                                        </div>
                                    </div>

                                        <div class="form-group">
                                        <input type="hidden" id="anadir-estado" name="anadir-estado" class="filled-in"
                                                value="1" >
                                        </div>
                                        <button class="btn btn-block btn-success m-t-15 waves-effect"><i class="material-icons">done</i>&nbsp;AÑADIR</button><br>

                                    </form>
                                    <a href="{{ route('ufv') }}"><button type="cancel" class="btn btn-block btn-danger m-t-15 waves-effect"><i class="material-icons">clear</i>&nbsp;CANCELAR</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function calcular(){
                if (document.getElementById('anadir-estado').checked==true){
                    document.getElementById('anadir-estado').value="1";
                    document.getElementById('nombre').value=document.getElementById('anadir-estado').value;
                }else{
                    document.getElementById('anadir-estado').value="0";
                    document.getElementById('nombre').value=document.getElementById('anadir-estado').value;
                }
            }
        </script>
    </section>
@endsection
