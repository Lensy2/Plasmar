<footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 0.1
        </div>
        <strong>Copyright &copy; 2016 <a target="blank" href="http://www.inovait.co/">Inovait</a></strong> All rights reserved.
      </footer>

      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $enlace;?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo $enlace;?>/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo $enlace;?>/bootstrap/js/bootstrap.min.js"></script>
     <!-- Select2 -->
    <script src="<?php echo $enlace;?>/plugins/select2/select2.full.min.js"></script>
    <!-- Morris.js charts 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo $enlace;?>/plugins/morris/morris.min.js"></script>-->
    <!-- Sparkline -->
    <script src="<?php echo $enlace;?>/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="<?php echo $enlace;?>/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo $enlace;?>/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo $enlace;?>/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="<?php echo $enlace;?>/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo $enlace;?>/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo $enlace;?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="<?php echo $enlace;?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo $enlace;?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $enlace;?>/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo $enlace;?>/plugins/fastclick/fastclick.min.js"></script>
    <script src="<?php echo $enlace;?>/plugins/iCheck/icheck.min.js"></script>
     <!--- FileInput - Subir Imagenes--> 
    <script src="<?php echo $enlace;?>/plugins/fileInput/js/fileinput.min.js" type="text/javascript"></script>
    <!-- Chart.js --> 
    <script src="<?php echo $enlace;?>/plugins/chartjs/Chart.js" type="text/javascript"></script>

    <!-- AdminLTE App -->
    <script src="<?php echo $enlace;?>/dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!--<script src="<?php echo $enlace;?>/dist/js/pages/dashboard.js"></script>-->
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo $enlace;?>/dist/js/demo.js"></script>
    <script src="<?php echo $enlace;?>/dist/js/informes/main_informes.js"></script>
<?php if ($archivo == 'cliente') {
?>
<script type="text/javascript">


    var ctx = document.getElementById("myChart2");
                var myChart = new Chart(ctx, {

                    type: 'bar',
                    data: {
                        labels: <?php echo $jsonNombres ?>,
                        datasets: [{
                            label: '# Inconformidades x Cliente',
                            fill: true,
                            lineTension: 0.1,
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: <?php echo $jsonDatos ?>
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
</script>
<?php }else{ ?>


<script type="text/javascript">
                var ctxy = document.getElementById("myChart3");
                var myChart2 = new Chart(ctxy, {
                    type: 'bar',
                    data: {
                        labels: <?php echo $jsonNombres ?>,
                        datasets: [{
                            label: '# Inconformidades x Operario',
                            fill: true,
                            lineTension: 0.1,
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: <?php echo $jsonDatos ?>
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });

</script>

<?php }?>





    <!-- plugins camara -->
    
  </body>
</html>