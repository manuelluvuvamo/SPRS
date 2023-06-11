@extends('layouts.merge.painel')
@section('titulo', 'Pesquisa de Registros para Impressão')
@section('conteudo')
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h5 class="card-title">Pesquisar Registros <span
                                                class="text-muted fw-normal ms-2"></span></h5>
                                    </div>
                                </div><!-- end col -->


                            </div><!-- end row -->

                            {{-- form --}}
                            <form action="{{ route('admin.log.print') }}" class="row" method="POST" target="_blank">
                                @csrf

                                <div class="form-group col-md-4">
                                    <label for="name" class="form-label">Utilizador</label>
                                    <select name="name" id="name" class="form-control js-example-basic-single">
                                        <option value=null>Todos</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="form-group col-md-4">
                                    <label for="filter" class="form-label">Filtro</label>
                                    <select name="filter" id="filter" onchange="mudar()" class="form-control">
                                        <option value="All">Todos</option>
                                        <option value="day">Hoje</option>
                                        <option value="date">Data específica</option>
                                        <option value="month">Mês</option>
                                        <option value="year">Ano</option>
                                        <option value="intervalo">Intervalo</option>

                                    </select>

                                </div>

                                <div class="form-group col-md-4">
                                    <label for="periodo" class="form-label">Periodo</label>
                                    <input type="date" class="form-control" name="date" id="date"hidden>
                                    <input type="month" class="form-control" name="month" id="month"hidden>
                                    <input type="number" class="form-control" name="year" id="year"hidden>
                                    <input type="date" class="form-control" name="intervalo1" id="intervalo1"hidden>
                                    <input type="date" class="form-control" name="intervalo2" id="intervalo2"hidden>

                                </div>

                                <div class="form-group col-md-3">
                                    <label for="" class="form-label text-white">.</label>
                                    <button class="form-control btn btn-primary">Pesquisar</button>
                                </div>

                            </form>





                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

<script>
    function mudar(){
        var estado = $('#filter').val();
        if (estado =="date" ) {
            document.getElementById("date").removeAttribute('hidden');
            document.getElementById("date").setAttribute('required','required');
            document.getElementById("month").setAttribute('hidden','hidden');
            document.getElementById("year").setAttribute('hidden','hidden');
            document.getElementById("month").removeAttribute('required');
            document.getElementById("year").removeAttribute('required');

            document.getElementById("intervalo1").setAttribute('hidden','hidden');
            document.getElementById("intervalo2").setAttribute('hidden','hidden');

            document.getElementById("intervalo1").removeAttribute('required');
            document.getElementById("intervalo2").removeAttribute('required');
        }else if (estado =="month" ) {
            document.getElementById("month").removeAttribute('hidden');
            document.getElementById("month").setAttribute('required','required');
            document.getElementById("date").setAttribute('hidden','hidden');
            document.getElementById("year").setAttribute('hidden','hidden');
            document.getElementById("date").removeAttribute('required');
            document.getElementById("year").removeAttribute('required');

            document.getElementById("intervalo1").setAttribute('hidden','hidden');
            document.getElementById("intervalo2").setAttribute('hidden','hidden');

            document.getElementById("intervalo1").removeAttribute('required');
            document.getElementById("intervalo2").removeAttribute('required');
        }else if (estado =="year" ) {
            document.getElementById("year").removeAttribute('hidden');
            document.getElementById("year").setAttribute('required','required');
            document.getElementById("date").setAttribute('hidden','hidden');
            document.getElementById("month").setAttribute('hidden','hidden');
            document.getElementById("date").removeAttribute('required');
            document.getElementById("month").removeAttribute('required');

            document.getElementById("intervalo1").setAttribute('hidden','hidden');
            document.getElementById("intervalo2").setAttribute('hidden','hidden');

            document.getElementById("intervalo1").removeAttribute('required');
            document.getElementById("intervalo2").removeAttribute('required');
        }
         else if (estado =="intervalo" ) {
            document.getElementById("intervalo1").removeAttribute('hidden');
            document.getElementById("intervalo1").setAttribute('required','required');
            document.getElementById("intervalo2").removeAttribute('hidden');
            document.getElementById("intervalo2").setAttribute('required','required');

            document.getElementById("date").setAttribute('hidden','hidden');
            document.getElementById("month").setAttribute('hidden','hidden');
            document.getElementById("year").setAttribute('hidden','hidden');
       


            document.getElementById("date").removeAttribute('required');
            document.getElementById("month").removeAttribute('required');
            document.getElementById("year").removeAttribute('required');

           
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            placeholder: "Seleccione o utilizador",
          
            
        });

   
    
    });
</script>

@if (session("logs.search.print.false"))
    <script>
         Swal.fire(
         'Registros não encontrados!',
         '',
         'error'
     )
    </script>
@endif

@if (session("logs.search.print2.false"))
    <script>
         Swal.fire(
         'Muitos Dados para Serem Impressos!',
         '',
         'error'
     )
    </script>
@endif

@if (session("logs.search.print3.false"))
    <script>
         Swal.fire(
         'Houve algum erro, tente novamente em breve!',
         '',
         'error'
     )
    </script>
@endif
@endsection
