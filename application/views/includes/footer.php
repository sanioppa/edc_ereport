

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>E-Report</b> Kegiatan Humas EDC | Version 1.0
        </div>
        <strong>Copyright &copy; 2019-2020 <a href="http://www.klinikmataedc.com" target="_blank">Klinik Mata EDC Group</a>.</strong> All rights reserved.
    </footer>

    <script src="<?php echo base_url(); ?>assets/dist/ajax/jquery.min.js"></script>

    <!-- RAPHAEL -->
     <script src="<?php echo base_url(); ?>assets/plugins/raphael/raphael-min.js"></script>
    <!-- MORRIS -->
    <script src="<?php echo base_url(); ?>assets/plugins/morris/morris.min.js"></script>
    
    <!-- jQuery UI 1.11.2 -->
    <!-- <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    
    <script src="<?php echo base_url(); ?>assets/dist/js/app.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/validation.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/jQueryUI/jquery-ui-1.10.3.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>assets/lte/dist/js/demo.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>assets/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/angular/angular.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.js"></script>
    <script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        })
    })
    </script>

    <script type="text/javascript">
        var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        var x= $('a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');
    </script>
  </body>
</html>