<?php
function footerWeb($halaman = null){
    if ($halaman == "list") { 
?>
            <script src="../lib/jquery/jquery-3.7.1.min.js"></script>
            <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
            <script src="../lib/datatables/datatables.min.js"></script>

            <!-- Script Datatables start -->
            <script>

                $(document).ready(function() {
                $('#table').DataTable();
            });

            </script>
            <!-- Script Datatables end -->

        </body>
        </html>
<?php    
} else {
?>


        <script src="../lib/bootstrap/js/bootstrap.bundle.js"></script>
        </body>
        </html>

<?php }
}
?>
