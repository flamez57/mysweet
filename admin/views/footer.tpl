        </div>
        <!-- ./wrapper -->

        <!-- jQuery 3 -->
        <?=\hl\HLView::componentsJs('jquery/dist/jquery.min.js');?>
        <!-- jQuery UI 1.11.4 -->
        <?=\hl\HLView::componentsJs('jquery-ui/jquery-ui.min.js');?>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
        $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.7 -->
        <?=\hl\HLView::componentsJs('bootstrap/dist/js/bootstrap.min.js');?>
        <!-- Morris.js charts -->
        <?=\hl\HLView::componentsJs('raphael/raphael.min.js');?>
        <?=\hl\HLView::componentsJs('morris.js/morris.min.js');?>
        <!-- Sparkline -->
        <?=\hl\HLView::componentsJs('jquery-sparkline/dist/jquery.sparkline.min.js');?>
        <!-- jvectormap -->
        <?=\hl\HLView::pluginsJs('jvectormap/jquery-jvectormap-1.2.2.min.js');?>
        <?=\hl\HLView::pluginsJs('jvectormap/jquery-jvectormap-world-mill-en.js');?>
        <!-- jQuery Knob Chart -->
        <?=\hl\HLView::componentsJs('jquery-knob/dist/jquery.knob.min.js');?>
        <!-- daterangepicker -->
        <?=\hl\HLView::componentsJs('moment/min/moment.min.js');?>
        <?=\hl\HLView::componentsJs('bootstrap-daterangepicker/daterangepicker.js');?>
        <!-- datepicker -->
        <?=\hl\HLView::componentsJs('bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js');?>
        <!-- Bootstrap WYSIHTML5 -->
        <?=\hl\HLView::pluginsJs('bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');?>
        <!-- Slimscroll -->
        <?=\hl\HLView::componentsJs('jquery-slimscroll/jquery.slimscroll.min.js');?>
        <!-- FastClick -->
        <?=\hl\HLView::componentsJs('fastclick/lib/fastclick.js');?>
        <!-- AdminLTE App -->
        <?=\hl\HLView::js('adminlte.min.js');?>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <?=\hl\HLView::js('pages/dashboard.js');?>
        <!-- AdminLTE for demo purposes -->
        <?=\hl\HLView::js('demo.js');?>
    </body>
</html>
