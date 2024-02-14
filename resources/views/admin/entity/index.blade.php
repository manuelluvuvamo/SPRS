@extends('layouts.merge.painel')
@section('titulo', 'Lista de Entidades')
@section('conteudo')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Entidades</h1>
        <p class="mb-4"></p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Entidades</h6>
                <div class="d-flex flex-wrap align-items-start justify-content-md-end mt-2 mt-md-0 gap-2 mb-3">
                  @if (Auth::user()->level == "Administrador" || Auth::user()->level == "Entidade")
                  <a class="btn btn-primary" href="{{ route('admin.entity.create') }}">
                    <strong class="text-light text-white">Cadastrar</strong>
                </a>
                  @endif
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOME</th>
                                <th>NOME CURTO</th>
                                <th>EMAIL</th>
                                <th>NIF</th>
                                <th>TELEFONE</th>
                                @if (Auth::user()->level == "Administrador" || Auth::user()->level == "Entidade")
                                <th>API TOKEN</th>
                                @endif
                                @if (Auth::user()->level == "Administrador")
                                <th>Utilizador</th>
                                @endif
                                <th>CÓDIGO DE ENTIDADE</th>
                                <th>FOTO</th>
                                @if (Auth::user()->level == "Administrador" || Auth::user()->level == "Entidade")
                                <th>ACÇÕES</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody>
                            @if (isset($entities))
                                @foreach ($entities as $entity)
                                    <tr>
                                        <td>{{ $entity->id }}</td>
                                        <td>{{ $entity->name }}</td>
                                        <td>{{ $entity->short_name }}</td>
                                        <td>{{ $entity->email }}</td>
                                        <td>{{ $entity->nif }}</td>
                                        <td>{{ $entity->phone_number }}</td>
                                        @if (Auth::user()->level == "Administrador" || (Auth::user()->level == "Entidade" && Auth::user()->id == $entity->id_user))
                                        <td>{{ $entity->api_token }}</td>
                                        @endif
                                        @if (Auth::user()->level == "Administrador")
                                        <td>{{ $entity->first_name." ".$entity->middle_name." ".$entity->last_name }}</td>
                                        @endif
                                        <td>{{$entity->code}}</td>
                                        <td>
                                            <a class="fresco" href="{{ asset($entity->image) }}"
                                                data-fresco-group="projects"> <img src="{{ asset($entity->image) }}"
                                                    class="img-fluid " width="50" alt=""> </a>

                                        </td>
                                        @csrf
                                        @method('delete')
                                       
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-dark btn-sm dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fa fa-clone fa-sm" aria-hidden="true"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.entity.edit', $entity->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i>
                                                        Editar</a>
                                                    <a class="dropdown-item destroy"
                                                        href="{{ route('admin.entity.destroy', $entity->id) }}"><i
                                                            class="fa fa-trash" aria-hidden="true"></i>
                                                        Eliminar</a>

                                                        @if (Auth::user()->level == "Administrador")
                                                        <a class="dropdown-item purge"
                                                            href="{{ route('admin.entity.purge', $entity->id) }}"><i
                                                                class="fa fa-trash" aria-hidden="true"></i>
                                                            Purgar</a>
                                                        @endif
                                                </div>
                                            </div>
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

    {{-- Entidade --}}
    @if (session('entity.destroy.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Entidade Eliminada Com Sucesso!',
                text: '',
                timer: 4e3,
                timerProgressBar: !0,
                didOpen: function() {
                    Swal.showLoading(), t = setInterval(function() {
                        var t, e = Swal.getHtmlContainer();
                        !e || (t = e.querySelector("b")) && (t.textContent = Swal.getTimerLeft())
                    }, 100)
                },
                onClose: function() {
                    clearInterval(t)
                }
            }).then(function(t) {
                t.dismiss === Swal.DismissReason.timer && console.log("I was closed by the timer")
            })

            /* .then((result) => {
                if (result.value) {
                            location.href = "";
                }
            }) */
        </script>
    @endif

    @if (session('entity.destroy.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao Eliminar Entidade!',
                text: '',
                timer: 4e3,
                timerProgressBar: !0,
                didOpen: function() {
                    Swal.showLoading(), t = setInterval(function() {
                        var t, e = Swal.getHtmlContainer();
                        !e || (t = e.querySelector("b")) && (t.textContent = Swal.getTimerLeft())
                    }, 100)
                },
                onClose: function() {
                    clearInterval(t)
                }
            }).then(function(t) {
                t.dismiss === Swal.DismissReason.timer && console.log("I was closed by the timer")
            })
        </script>
    @endif


    @if (session('entity.purge.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Entidade Purgada Com Sucesso!',
                text: '',
                timer: 4e3,
                timerProgressBar: !0,
                didOpen: function() {
                    Swal.showLoading(), t = setInterval(function() {
                        var t, e = Swal.getHtmlContainer();
                        !e || (t = e.querySelector("b")) && (t.textContent = Swal.getTimerLeft())
                    }, 100)
                },
                onClose: function() {
                    clearInterval(t)
                }
            }).then(function(t) {
                t.dismiss === Swal.DismissReason.timer && console.log("I was closed by the timer")
            })

            /* .then((result) => {
                if (result.value) {
                            location.href = "";
                }
            }) */
        </script>
    @endif

    @if (session('entity.purge.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao Purgar Entidade!',
                text: '',
                timer: 4e3,
                timerProgressBar: !0,
                didOpen: function() {
                    Swal.showLoading(), t = setInterval(function() {
                        var t, e = Swal.getHtmlContainer();
                        !e || (t = e.querySelector("b")) && (t.textContent = Swal.getTimerLeft())
                    }, 100)
                },
                onClose: function() {
                    clearInterval(t)
                }
            }).then(function(t) {
                t.dismiss === Swal.DismissReason.timer && console.log("I was closed by the timer")
            })
        </script>
    @endif

@endsection
