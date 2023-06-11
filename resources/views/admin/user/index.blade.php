@extends('layouts.merge.painel')
@section('titulo', 'Lista de Utilizadores')
@section('conteudo')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Utilizadores</h1>
        <p class="mb-4"></p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                @if (Auth::user()->level == "Administrador")
                <h6 class="m-0 font-weight-bold text-primary">Lista de Utilizadores</h6>
                @else
                <h6 class="m-0 font-weight-bold text-primary">Perfil</h6>
                @endif
                <div class="d-flex flex-wrap align-items-start justify-content-md-end mt-2 mt-md-0 gap-2 mb-3">
                    @if (Auth::user()->level == "Administrador")
                    <a class="btn btn-primary" href="{{ route('admin.user.create') }}">
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
                                @if (Auth::user()->level == "Administrador")
                                <th>ID</th>
                                @endif
                                <th>NOME DE USUÁRIO</th>
                                <th>NOME COMPLETO</th>
                                <th>EMAIL</th>
                                <th>GÊNERO</th>
                                <th>TELEFONE</th>
                                <th>EMPRESA</th>
                                <th>FOTO</th>
                                <th>ACÇÕES</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (isset($users))
                                @foreach ($users as $user)
                                    <tr>
                                        @if (Auth::user()->level == "Administrador")
                                        <td>{{ $user->id }}</td>
                                        @endif
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->first_name." ".$user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->genero }}</td>
                                        <td>{{ $user->phone_number }}</td>
                                        <td>{{ $user->vc_empresa }}</td>
                                       
                                        <td>
                                            <a class="fresco" href="{{ asset($user->profile_photo_path) }}"
                                                data-fresco-group="projects"> <img src="{{ asset($user->profile_photo_path) }}"
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
                                                        href="{{ route('admin.user.edit', $user->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i>
                                                        Editar</a>

                                                        @if (Auth::user()->level == "Administrador")
                                                    <a class="dropdown-item destroy"
                                                        href="{{ route('admin.user.destroy', $user->id) }}"><i
                                                            class="fa fa-trash" aria-hidden="true"></i>
                                                        Eliminar</a>

                                                   
                                                        <a class="dropdown-item purge"
                                                            href="{{ route('admin.user.purge', $user->id) }}"><i
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

    {{-- user --}}
    @if (session('user.destroy.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Utilizador Eliminado Com Sucesso!',
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

    @if (session('user.destroy.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao Eliminar Utilizador!',
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


    @if (session('user.purge.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Utilizador Purgado Com Sucesso!',
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

    @if (session('user.purge.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao Purgar Utilizador!',
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
