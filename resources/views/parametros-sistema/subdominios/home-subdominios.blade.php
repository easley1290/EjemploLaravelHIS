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
                    <div class="card" style="margin-left: 1%;">
                        <div class="header">
                            <h1 >
                                <strong>REGISTRO DE SUBDOMINIOS DEL SISTEMA</strong>
                            </h1>
                            <h4><small>Hay&nbsp;{{ $cantidad->count()+1 }}&nbsp;subdominios registrados</small></h4>
                        </div>

                        <div class="body">
                            <div class="container">
                                <div class="row clearfix">
                                    <div class="form-line">
                                        <div class="col-md-4">
                                            <form action="{{ route('subdominios') }}" method="GET">
                                                <select name="filtroEstado" id="filtroEstado">
                                                    <option value="">-- Seleccione un filtro --</option>
                                                    <option value="">TODOS LOS ESTADOS</option>
                                                    <option value="activo" >DOMINIO ACTIVO</option>
                                                    <option value="noactivo">DOMINIO NO ACTIVO</option>
                                                </select>&nbsp;&nbsp;
                                                <button class="btn btn-warning waves-effect" type="submit" style="border-radius: 0.5em;">
                                                    <i class="material-icons">search</i>&nbsp;Buscar</button>
                                            </form>
                                        </div>
                                        <div class="col-md-6">
                                            <form action="{{ route('subdominios') }}" method="GET">
                                                <select name="filtroDominio" id="filtroDominio">
                                                    <option value="">-- Seleccione un dominio --</option>
                                                    <option value="">TODOS LOS DOMINIOS</option>
                                                    @foreach($dominios as $dominio)
                                                    <option value="{{ Crypt::encrypt($dominio->domID) }}">{{ $dominio->domNom }}</option>
                                                    @endforeach
                                                </select>&nbsp;&nbsp;
                                                <button class="btn btn-warning waves-effect" type="submit" style="border-radius: 0.5em;">
                                                    <i class="material-icons">search</i>&nbsp;Buscar</button>
                                            </form>
                                        </div>

                                        <div class="col-md-2">
                                            <a href="{{ route('subdominios.anadir') }}"><button class="btn btn-primary waves-effect" type="button" style="border-radius: 0.5em;">
                                            <i class="material-icons">add</i>&nbsp;Añadir registro</button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="center-block table-responsive col-md-12">
                                    <table class="table table-bordered table-striped table-hover" id="tablaDatos">
                                        <thead style="background-color: #900c3e; color: whitesmoke;">
                                            <tr height="80" vertical-align="super">
                                                <th>ID</th>
                                                <th>PERTENECE AL DOMINIO:</th>
                                                <th>NOMBRE DE SUBDOMINIO</th>
                                                <th>DESCRIPCION DEL SUBDOMINIO</th>
                                                <th>ESTADO</th>
                                                <th colspan="2" >MAS OPCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sdominios as $sdominio)
                                                <tr>

                                                    <td>{{ $sdominio->subID }}</td>
                                                    <td>{{ $sdominio->domNom }}</td>
                                                    <td>{{ $sdominio->subNom }}</td>
                                                    <td>{{ $sdominio->subDes }}</td>
                                                    @if($sdominio->subEst == 1 )
                                                        <td>
                                                            <p class="font-bold col-teal">ACTIVO</p>
                                                        </td>
                                                    @endif
                                                    @if($sdominio->subEst == 0 )
                                                        <td>
                                                            <p class="font-bold col-pink">NO ACTIVO</p>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ route('subdominios.edit', Crypt::encrypt($sdominio->subID)) }}"><button type="button" class="btn btn-success waves-effect">
                                                            <i class="material-icons">edit</i>&nbsp;Editar</button>
                                                        </a>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $sdominios->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
