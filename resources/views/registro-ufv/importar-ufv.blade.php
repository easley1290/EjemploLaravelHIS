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
                                <div class="col-md-8">
                                    <h2 style="margin-bottom:1rem;">
                                        IMPORTAR ARCHIVO DE UFV
                                    </h2>
                                </div>
                            </div>

                            <div class="body">
                                <div class="container">
                                    <form method="POST" action="{{ route('ufv.importar-archivo') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group">
                                            <h2>Recuerde!</h2><br>
                                            <h3>El texto debe estar en formato .csv
                                                <br><br>Excel debe reconocer el signo punto como indicador de decimal,
                                                <br>caso contrario la importacion de datos no se efectuara correctamente</h3><br>
                                            <h3>Si existe una fecha duplicada a añadir, no se realizara una importacion de archivos</h3><br><br><br>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label" style="font-size: 20px;">Nuevo Archivo</label><br>
                                            <div class="col-md-7">
                                                <input type="file" class="form-control" name="file" required>
                                            </div>
                                        </div><br>

                                        <button class="btn btn-block btn-success m-t-15 waves-effect">
                                            <i class="material-icons">add</i>&nbsp;IMPORTAR
                                        </button><br>
                                    </form>
                                    <a href="{{ route('ufv') }}"><button type="cancel" class="btn btn-block btn-danger m-t-15 waves-effect"><i class="material-icons">clear</i>&nbsp;CANCELAR</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
