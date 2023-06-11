@extends('layouts.merge.painel')
@section('titulo', 'Lista de Referências')
@section('conteudo')


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Referências</h1>
        <p class="mb-4"></p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lista de Referências</h6>
                <div class="d-flex flex-wrap align-items-start justify-content-md-end mt-2 mt-md-0 gap-2 mb-3">
                    <a class="btn btn-primary" href="{{ route('admin.reference.create') }}">
                        <strong class="text-light text-white">Cadastrar</strong>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ENTIDADE</th>
                                <th>CÓDIGO DE ENTIDADE</th>
                                <th>REFERÊNCIA</th>
                                <th>VALOR</th>
                                <th>EXPIRAÇÃO</th>
                                <th>ESTADO</th>
                                <th>ACÇÕES</th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (isset($references))
                                @foreach ($references as $reference)
                                    <tr>
                                        <td>{{ $reference->id }}</td>
                                        <td>{{ $reference->name }}</td>
                                        <td>{{ $reference->code }}</td>
                                        <td>{{ $reference->reference_id }}</td>
                                        <td>{{ number_format($reference->amount, 2, ',', '.') }}Kz(s)</td>

                                        <td>{{ date('d-m-Y H:i', strtotime($reference->end_datetime)) }}</td>
                                        <td>
                                            @if ($reference->status == 'pending')
                                                <span class="text-warning">Pendente</span>
                                            @elseif($reference->status == 'paid')
                                            <span class="text-success">Pago</span>
                                            @endif
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
                                                    @if ($reference->status == 'pending')
                                                    <a class="dropdown-item"
                                                    href="{{ route('admin.reference.pay', $reference->id) }}"><i
                                                        class="fas fa-money-bill" aria-hidden="true"></i>
                                                    Pagar</a>
                                                @endif

                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.reference.edit', $reference->id) }}"><i
                                                            class="fa fa-pencil" aria-hidden="true"></i>
                                                        Editar</a>
                                                    <a class="dropdown-item destroy"
                                                        href="{{ route('admin.reference.destroy', $reference->id) }}"><i
                                                            class="fa fa-trash" aria-hidden="true"></i>
                                                        Eliminar</a>


                                                    <a class="dropdown-item purge"
                                                        href="{{ route('admin.reference.purge', $reference->id) }}"><i
                                                            class="fa fa-trash" aria-hidden="true"></i>
                                                        Purgar</a>


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

    {{-- Referência --}}
    @if (session('reference.destroy.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Referência Eliminada Com Sucesso!',
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

    @if (session('reference.destroy.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao Eliminar Referência!',
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


    @if (session('reference.purge.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Referência Purgada Com Sucesso!',
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

    @if (session('reference.purge.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao Purgar Referência!',
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


    @if (session('reference.pay.success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Referência Paga Com Sucesso!',
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

    @if (session('reference.pay.error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao Pagar Referência!',
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
