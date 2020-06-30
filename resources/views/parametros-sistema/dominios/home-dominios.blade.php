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
                                <strong>REGISTRO DE DOMINIOS DEL SISTEMA</strong>
                            </h1>
                            <h4><small>Hay&nbsp;{{ $cantidad->count()+1 }}&nbsp;dominios registrados</small></h4>
                        </div>

                        <div class="body">
                            <div class="container">
                                <div class="row clearfix">
                                    <div class="form-line">
                                        <div class="col-md-4">
                                            <form action="{{ route('dominios') }}" method="GET">
                                                <select name="filtroEstado" id="filtroEstado">
                                                    <option value="">-- Seleccione un filtro --</option>
                                                    <option value="">Ningun Filtro</option>
                                                    <option value="activo" >Dominios activos</option>
                                                    <option value="noactivo">Dominios no activos</option>
                                                </select>&nbsp;&nbsp;
                                                <button class="btn btn-warning waves-effect" type="submit" style="border-radius: 0.5em;">
                                                    <i class="material-icons">search</i>&nbsp;Buscar</button>
                                            </form>
                                        </div>
                                        <div class="col-md-6"><input type="hidden"></div>
                                        <div class="col-md-2">
                                            <a href="{{ route('dominios.anadir') }}"><button class="btn btn-primary waves-effect" type="button" style="border-radius: 0.5em;">
                                            <i class="material-icons">add</i>&nbsp;Añadir registro</button></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="center-block table-responsive col-md-12">
                                    <table class="table table-bordered table-striped table-hover" id="tablaDatos">
                                        <thead style="background-color: #900c3e; color: whitesmoke;">
                                            <tr height="80" vertical-align="super">
                                                <th>ID</th>
                                                <th>NOMBRE DE DOMINIO</th>
                                                <th>DESCRIPCION DEL DOMINIO</th>
                                                <th>ESTADO</th>
                                                <th colspan="2" >MAS OPCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($dominios as $dominio)
                                                <tr>
                                                    <td>{{ $dominio->domID }}</td>
                                                    <td>{{ $dominio->domNom }}</td>
                                                    <td>{{ $dominio->domDes }}</td>
                                                    @if($dominio->domEst == 1 )
                                                        <td>
                                                            <p class="font-bold col-teal">ACTIVO</p>
                                                        </td>
                                                    @endif
                                                    @if($dominio->domEst == 0 )
                                                        <td>
                                                            <p class="font-bold col-pink">NO ACTIVO</p>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ route('dominios.edit', Crypt::encrypt($dominio)) }}"><button type="button" class="btn btn-success waves-effect">
                                                            <i class="material-icons">edit</i>&nbsp;Editar</button>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <form method="POST" action="{{ route('dominios.destroy', Crypt::encrypt($dominio)) }}">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger waves-effect">
                                                                <i class="material-icons">delete</i>&nbsp;Borrar
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $dominios->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
