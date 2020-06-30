@extends('layouts.main')
@section('content')
    <section class="content">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status')}}
            </div>
        @endif
        <div class="container-fluid">
            <div class="block-header">
                <h1>REGISTRO DE EMPRESAS</h1><br>
            </div>
            <div class="content">
                <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="col-md-10">
                                <h2 style="margin-bottom:1rem;">
                                    EMPRESAS
                                </h2>
                            </div>
                        </div>
                        <div class="body">
                            <div class="container center-block table-responsive ">
                                <div class="">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tablaDatos" >
                                        <thead>
                                            <tr>
                                                <th>NUMERO PATRONAL</th>
                                                <th>NOMBRE DE EMPRESA</th>
                                                <th>MATRICULA DE INSCRIPCION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($emp as $em)
                                                <tr>
                                                    <td>{{ $em->numPat }}</td>
                                                    <td>{{ $em->empNom }}</td>
                                                    <td>{{ $em->empMatIns }}</td>
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
        </div>
    </section>
@endsection
