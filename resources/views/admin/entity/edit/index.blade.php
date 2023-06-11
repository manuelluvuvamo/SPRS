@extends('layouts.merge.painel')
@section('titulo', 'Edição de Entidades')
@section('conteudo')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Entidades</h1>
        <p class="mb-4"></p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Editar Entidade</h6>
                <div class="d-flex flex-wrap align-items-start justify-content-md-end mt-2 mt-md-0 gap-2 mb-3">
                    <button class="btn btn-primary" onclick="window.history.go(-1)">
                        <strong class="text-light text-white">Voltar</strong>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="">
                    <form action="{{ route('admin.entity.update', $entity->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @include('forms._formEntity.index')
                        <button type="submit" class="btn btn-primary">Salvar</button>

                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->








    {{-- entidade --}}
    @if (session('entity.update.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Entidade Editada Com Sucesso!',
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

    @if (session('entity.update.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao Editar Entidade!',
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
