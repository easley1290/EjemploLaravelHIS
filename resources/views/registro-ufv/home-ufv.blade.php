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
                            <h1>
                                <strong>REGISTRO DE UFV's</strong><br>
                                <small>Lista de valores de UFV's de cada fecha proveidas por el BCB</small><br>
                                <small>Para validar nuestros registros puede visitar el siguiente link:</small><br>
                                <small><a href="http://t.ly/pHQt" target="_blank">Ver UFV's en BCB</a></small>
                            </h1>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="form-line">
                                    <div class="col-md-2"><input type="hidden"></div>
                                    <div class="col-md-4">
                                        {{-- <div class="form-line">
                                        <form action="{{ route('ufv') }}" method="GET">
                                            <div class="col-md-6">
                                                <div class="input-group date" id="bs_datepicker_component_container">
                                                    <input type="date" class="form-control" name="filtroFechas" id="filtroFechas" placeholder="Buscar ufv por fechas">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn btn-secondary waves-effect" type="submit" style="border-radius: 0.5em;">
                                                    <i class="material-icons">search</i>&nbsp;Buscar</button>
                                            </div>
                                        </form>
                                        </div> --}}
                                    </div>
                                    <div class="col-md-1"><input type="hidden"></div>
                                    <div class="col-md-2">
                                        <a href="{{ route('ufv.anadir-ufv') }}">
                                        <button type="button" class="btn btn-info waves-effect m-r-20 float-right"><i class="material-icons">add</i>
                                            <span>Añadir registro</span>
                                        </button>
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ route('ufv.vista-importar') }}">
                                        <button type="button" class="btn btn-warning waves-effect m-r-20 float-right"><i class="material-icons">add</i>
                                            <span>Añadir registro por archivo</span>
                                        </button>
                                        </a>
                                    </div><br>
                                </div>
                            </div>
                            <div class="container center-block table-responsive">
                                <table class="table table-bordered table-striped table-hover" style="text-align:center;">
                                        <thead style="background-color: #900c3e; color: whitesmoke;">
                                            <tr height="80" vertical-align="super">
                                                <th>VALOR DE UFV</th>
                                                <th>FECHA DE VALOR DE UFV</th>
                                                <th>ESTADO DE VALOR</th>
                                                <th colspan="6">MAS OPCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody class="BusquedaRapida">
                                            @foreach($valores as $dat)
                                                <tr>
                                                    <td>{{ round(($dat->valValor1)*100000)/100000 }}</td>
                                                    <td>{{ $dat->valValor2 }}</td>
                                                    @if($dat->valEst == 1 )
                                                        <td>
                                                            <p class="font-bold col-teal">ACTIVO</p>
                                                        </td>
                                                    @endif
                                                    @if($dat->valEst == 0 )
                                                        <td>
                                                            <p class="font-bold col-pink">NO ACTIVO</p>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ route('ufv.edit', $dat->valID) }}">
                                                            <button type="button" class="btn btn-success waves-effect">
                                                                <i class="material-icons">edit</i>&nbsp;Editar
                                                            </button>
                                                        </a>
                                                    </td>
                                                    {{-- <td style="text-align:center;">
                                                        <form method="POST" action="{{ route('ufv.destroy', $dat) }}">
                                                            @csrf @method('DELETE')
                                                            <button type="submit" class="btn btn-danger waves-effect">
                                                                <i class="material-icons">delete</i>&nbsp;Borrar
                                                            </button>
                                                        </form>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $valores->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
