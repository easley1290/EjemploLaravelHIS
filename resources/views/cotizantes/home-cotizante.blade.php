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
                                <strong>REGISTRO DE COTIZANTES (ALTA)</strong><br>
                                <small>Lista de cotizantes en estado de alta dentro del ente gestor</small>
                            </h1>
                        </div>
                        <div class="body">
                            <div class="container">
                                <div class="row clearfix">
                                    <div class="form-line">
                                        <div class="col-md-8">
                                            <form action="{{ route('cotizante') }}" method="GET">
                                                <div class="col-sm-6">
                                                    <input type="text" id="buscarApellido" name="buscarApellido"
                                                    class="form-control" onKeyPress="if(this.value.length==10) return false;"
                                                    placeholder="Buscar por apellido paterno de cotizante"
                                                    onkeyup="javascript:this.value=this.value.toUpperCase();"
                                                    value="">&nbsp;&nbsp;
                                                </div>
                                                <div class="col-sm-6">
                                                    <button class="btn btn-warning waves-effect" type="submit" style="border-radius: 0.5em;">
                                                    <i class="material-icons">search</i>&nbsp;Buscar</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-4"><input type="hidden"></div>
                                    </div>
                                </div>
                                <div class="center-block table-responsive col-md-12">
                                    <table class="table table-bordered table-striped table-hover" >
                                        <thead style="background-color:darkmagenta; color:whitesmoke;">
                                            <tr>
                                                <th>C.I.</th>
                                                <th>NOMBRE(s)</th>
                                                <th>APELLIDO PATERNO</th>
                                                <th>APELLIDO MATERNO</th>
                                                <th>EMPRESA</th>
                                                <th>SUELDO TOTAL DEL COTIZANTE</th>
                                                <th>CARGO</th>
                                                <th>ESTADO DE COTIZANTE</th>
                                                <th>MAS OPCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cot as $co)
                                                <tr>
                                                    <td>{{ $co->cotCi }}</td>
                                                    <td>{{ $co->cotNom}}</td>
                                                    <td>{{ $co->cotApePat }}</td>
                                                    <td>{{ $co->cotApeMat }}</td>
                                                    <td>{{ $co->empNom }}</td>
                                                    <td>{{ round((float)$co->cotTotGan, 2) }}</td>
                                                    <td>{{ $co->cotCargo }}</td>
                                                    <td>{{ $co->altTip  }}</td>

                                                    <td style="text-align:center;">
                                                        <a href="{{ route('cotizante.edit', Crypt::encrypt($co->cotID) ) }}">
                                                            <button type="button" class="btn btn-success waves-effect">
                                                                <i class="material-icons">edit</i>&nbsp;Editar
                                                            </button>
                                                        </a>
                                                    </td>
                                                    {{-- <td style="text-align:center;">
                                                        <form method="POST" action="{{ route('incTemporal.destroy', $co) }}">
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
                                    {{ $cot->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
