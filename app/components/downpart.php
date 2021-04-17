</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-light border-top">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Sistema de Nivelación 2021</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" data-backdrop="static" id="logoutModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Preparado para partir?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión
                actual.
            </div>
            <div class="modal-footer">
                <button class="btn btn-light font-weight-bold" type="button" data-dismiss="modal">Cancelar</button>
                <form action="app/controllers/login/makeLogout.php?">
                    <button class="btn btn-danger font-weight-bold" type="submit">Cerrar sesión</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Custom scripts for all pages-->
<script src="<?php echo $rtax;//esta variable se hereda desde dependencies.php ?>public/js/sb-admin-2.min.js"></script>


</body>

</html>