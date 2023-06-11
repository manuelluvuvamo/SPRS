    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pronto para Sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecione "Sair" abaixo se estiver pronto para encerrar sua sessão atual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sair</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('startbootstrap/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('startbootstrap/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('startbootstrap/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('startbootstrap/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('startbootstrap/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('startbootstrap/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('startbootstrap/js/demo/chart-pie-demo.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('startbootstrap/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('startbootstrap/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('startbootstrap/js/demo/datatables-demo.js') }}"></script>

     <!-- Sweet Alerts js -->
     <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>

      <!-- Select2 js -->
     <script src="{{asset('startbootstrap/js/select2.min.js')}}"></script>

     <script>
        $(document).ready(function() {
    
            //start delete
            $('a.destroy').click(function(ev) {
                var href = $(this).attr('href');
                if (!$('#confirm-delete').length) {
                    $('body').append(
                        '<div  class="modal fade" id="confirm-delete" style="backgroud-color:white!important;" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content bg-light"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Eliminar os dados</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body">Tem certeza que pretende elimnar?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button> <a class="btn btn-info" id="dataConfirmOk">Eliminar<a></div></div></div></div>'
                    );
                }
                $('#dataConfirmOk').attr('href', href);
                $('#confirm-delete').modal('show');
                /* $('#confirm-delete').modal({
                    shown: true
                }); */
                return false;
    
            });
            //end delete
    
    
            //start purge
            $('a.purge').click(function(ev) {
                var href = $(this).attr('href');
                if (!$('#confirm-purge').length) {
                    $('body').append(
                        '<div  class="modal fade" id="confirm-purge" style="backgroud-color:white!important;" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog-centered" role="document"><div class="modal-content bg-light"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Purgar os dados</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body">Tem certeza que pretende  permanentemente(purgar)?</div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button> <a class="btn btn-info" id="dataConfirmOk2">Purgar<a></div></div></div></div>'
                    );
                }
                $('#dataConfirmOk2').attr('href', href);
                /* $('#confirm-purge').modal({
                    shown: true
                }); */
                $('#confirm-purge').modal('show');
                return false;
    
            });
            //end purge
        });
    </script>
    </html>
