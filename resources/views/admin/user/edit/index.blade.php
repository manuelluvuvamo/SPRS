@extends('layouts.merge.painel')
@section('titulo', 'Edição de Utilizadores')
@section('conteudo')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Utilizadores</h1>
        <p class="mb-4"></p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Editar Utilizador</h6>
                <div class="d-flex flex-wrap align-items-start justify-content-md-end mt-2 mt-md-0 gap-2 mb-3">
                    <button class="btn btn-primary" onclick="window.history.go(-1)">
                        <strong class="text-light text-white">Voltar</strong>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <form action="{{ route('admin.user.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('forms._formUser.index')
                        <button type="submit" class="btn btn-primary">Salvar</button>

                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->








    {{-- Utilizador --}}
    @if (session('user.update.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Utilizador Editado Com Sucesso!',
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
                t.dismiss === Swal.DismissReason.timer && console.log("I was closed by the timer");
                window.history.go(-2);


            })
        </script>
    @endif

    @if (session('user.update.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao Editar Utilizador!',
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


    @if (Auth::user()->level == 'Administrador')
        <script>
            function updatePassword() {
                var checkbox = document.getElementById('gen-info-change-password').checked

                if (checkbox == true) {

                    /* document.getElementById('currentPassword').setAttribute('required', 'required') */
                    document.getElementById('password').setAttribute('required', 'required')
                    document.getElementById('password_confirmation').setAttribute('required', 'required')

                   
                    document.getElementById('password').removeAttribute('disabled')
                    document.getElementById('password_confirmation').removeAttribute('disabled')

                } else {
                    document.getElementById('currentPassword').setAttribute('disabled', 'disabled')
                    document.getElementById('password').setAttribute('disabled', 'disabled')
                    document.getElementById('password_confirmation').setAttribute('disabled', 'disabled')

                  
                    document.getElementById('password').removeAttribute('required')
                    document.getElementById('password_confirmation').removeAttribute('required')
                }
            }
        </script>
    @else
        <script>
            function updatePassword() {
                var checkbox = document.getElementById('gen-info-change-password').checked

                if (checkbox == true) {

                    /* document.getElementById('currentPassword').setAttribute('required', 'required') */
                    document.getElementById('password').setAttribute('required', 'required')
                    document.getElementById('password_confirmation').setAttribute('required', 'required')

                    document.getElementById('currentPassword').removeAttribute('disabled')
                    document.getElementById('password').removeAttribute('disabled')
                    document.getElementById('password_confirmation').removeAttribute('disabled')

                } else {
                    document.getElementById('currentPassword').setAttribute('disabled', 'disabled')
                    document.getElementById('password').setAttribute('disabled', 'disabled')
                    document.getElementById('password_confirmation').setAttribute('disabled', 'disabled')

                    document.getElementById('currentPassword').removeAttribute('required')
                    document.getElementById('password').removeAttribute('required')
                    document.getElementById('password_confirmation').removeAttribute('required')
                }
            }
        </script>
    @endif
@endsection
