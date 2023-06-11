@extends('layouts.merge.painel')
@section('titulo', 'Cadastro de Utilizadores')
@section('conteudo')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Utilizadores</h1>
        <p class="mb-4"></p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Cadastrar Utilizador</h6>
                <div class="d-flex flex-wrap align-items-start justify-content-md-end mt-2 mt-md-0 gap-2 mb-3">
                    <button class="btn btn-primary" onclick="window.history.go(-1)">
                        <strong class="text-light text-white">Voltar</strong>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('forms._formUser.index')
                        <button type="submit" class="btn btn-primary">Salvar</button>

                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->


    @if (session('user.create.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Utilizador Cadastrado Com Sucesso!',
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

    @if (session('user.create.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao Cadastrar Utilizador!',
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
