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
                            <h1 >
                                <strong>REGISTRO DE INCAPACIDADES TEMPORALES</strong><br>
                                <small>Lista de incapacidades temporales dentro del ente gestor</small>
                            </h1>
                        </div>
                        <div class="body">
                            <div class="container center-block table-responsive ">
                                <div class="row clearfix">
                                    <div class="form-line">
                                        <div class="col-md-4"><input type="hidden" disabled></div>
                                        <div class="col-md-5"><input type="hidden" disabled></div>
                                        <div class="col-md-3">
                                            <a href="{{ route('incTemporal.anadir') }}">
                                            <button type="button" class="btn btn-info waves-effect m-r-20 float-right"><i class="material-icons">add</i>
                                                <span>Añadir Incapacidad Temporal</span>
                                            </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered table-striped table-hover" id="tablaDatos" >
                                    <thead style="background-color: #900c3e; color: whitesmoke;">
                                        <tr height="80" vertical-align="super">
                                            <th>ID</th>
                                            <th>DESCRIPCION</th>
                                            <th>DIAS DE VALIDEZ</th>
                                            <th>PORCENTAJE DE SUBSIDIO (%)</th>
                                            <th>ESTADO</th><th colspan="2">MAS OPCIONES</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($incTemp as $inc)
                                            <tr>
                                                <td>{{ $inc->incID }}</td>
                                                <td>{{ $inc->incDes }}</td>
                                                <td>{{ $inc->incDiaVal }}</td>
                                                <td>{{ $inc->incPor }}</td>
                                                @if($inc->incEst == 1 )
                                                    <td>
                                                        <p class="font-bold col-teal">ACTIVO</p>
                                                    </td>
                                                @endif
                                                @if($inc->incEst == 0 )
                                                    <td>
                                                        <p class="font-bold col-pink">NO ACTIVO</p>
                                                    </td>
                                                @endif
                                                <td style="text-align:center;">
                                                    <a href="{{ route('incTemporal.edit', $inc ) }}">
                                                        <button type="button" class="btn btn-success waves-effect">
                                                            <i class="material-icons">edit</i>&nbsp;Editar
                                                        </button>
                                                    </a>
                                                </td>
                                                <td style="text-align:center;">
                                                    <form method="POST" action="{{ route('incTemporal.destroy', $inc) }}">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
