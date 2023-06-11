@extends('layouts.merge.painel')
@section('titulo', 'Lista de Registros de Actividades')
@section('conteudo')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Anos</h1>
        <p class="mb-4"></p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Registros de Actividades</h6>
                <div class="d-flex flex-wrap align-items-start justify-content-md-end mt-2 mt-md-0 gap-2 mb-3">
                    {{--  <a class="btn btn-primary" href="{{ route('admin.ano.create') }}">
                        <strong class="text-light text-white">Cadastrar</strong>
                    </a> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>DATA</th>
                                <th>ENDEREÇO</th>
                                <th>UTILIZADOR</th>
                                <th>ACTIVIDADE</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (isset($logs))
                                @foreach ($logs as $log)
                                    <tr class="text-center">
                                        <td> <strong>{{ $log->id }}</strong>
                                        <td>{{ date('d-m-Y H:i:s', strtotime($log->created_at)) }}</td>
                                        <td>{{ $log->address }}</td>
                                        <td>{{ $log->name }}</td>
                                        <td>

                                            @if (Str::length($log->desc) > 25)
                                                {{ Str::limit($log->desc, 20) }} <a href="#" class=""
                                                    data-bs-toggle="modal" data-bs-target="#dispo{{ $log->id }}">ver
                                                    mais</a>
                                            @else
                                                {{ $log->desc }}
                                            @endif

                                        </td>



                                    </tr>
                                @endforeach

                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    @foreach ($logs as $log)
        {{-- START Dispo MODAL --}}
     

        <div class="modal fade" id="dispo{{ $log->id }}" style="backgroud-color:white!important;" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{ $log->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content bg-light">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel{{ $log->id }}">  {{ $log->name }}</h5><button type="button"
                            class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body table-responsive">
                        <section class="gallery-section container p-md-0 my-5">
                            <strong>Dispositivo: </strong>
                            <p>{{ $log->device }}</p>
                            <hr>
                            <strong>Endereço: </strong>
                            <p>{{ $log->address }}</p>
                            <hr>
                            <strong>Actividade: </strong>
                            <p>{{ $log->desc }}</p>
                        </section>

                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Fechar</button> 
                    </div>
                </div>
            </div>
        </div>
        {{-- END Dispo MODAL --}}
        <!-- Modal -->
    @endforeach

@endsection
