@extends('layout.app')

@section('title')
    Clientes - Talents
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('breadcrumb_title')
            <h3>Clientes</h3>
        @endslot
        <li class="breadcrumb-item active">Clientes</li>
        @slot('breadcrumb_options')
            <div class="float-end p-0">
                {{--    <a class="btn btn-primary-light" type="button" href="{{ route('clients.create') }}">
                    Nuevo Cliente
                </a> --}}
                {{-- <a class="btn btn-primary-light" type="button" href="#">
                    Importar Clientes
                </a>
                <a class="btn btn-primary-light" type="button" href="#">
                    Exportar Clientes
                </a>
                <a class="btn btn-primary-light" type="button" href="#">
                    Descargar Modelo
                </a> --}}
                <form action="{{ route('file-import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="custom-file-input" id="customFile"><br><br>
                    <button class="btn btn-primary">Import data</button>
                    <a class="btn btn-success" href="{{ route('file-export') }}">Export data</a>
                </form>

            </div>
        @endslot
    @endcomponent
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 xl-100 box-col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="user-status table-responsive text-center">
                            <table class="table table-bordernone">
                                <thead>
                                    <tr>
                                        <th scope="col">User Id</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col">Depositado</th>
                                        <th scope="col">Credito</th>
                                        <th scope="col">Estatus</th>
                                        <th scope="col">Pago</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{ $client->user_id }}</td>
                                            <td>{{ $client->nombre }}</td>
                                            <td>{{ $client->fecha }}</td>
                                            <td>{{ $client->monto }}</td>
                                            <td>{{ $client->depositado }}</td>
                                            <td>{{ $client->credito }}</td>
                                            <td>{{ $client->estatus }}</td>
                                            <td>{{ $client->pago }}</td>
                                            {{--    <td>
                                            <a href="{{ route('clients.edit', $client->id) }}" class="text-decoration-none">
                                                <i data-feather="edit" class="text-info"></i>
                                            </a>
                                        </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        {!! $clients->links() !!}
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('resources/js/app/dashboard.js') }}"></script>
@endsection
