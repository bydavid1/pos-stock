    </div>
    <!-- /page content -->
    </div>
    </div>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
    <!-- DateJS -->
    <script src="../vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- file input -->
    <script src="../vendors/fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>
    <script src="../vendors/fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
    <script src="../vendors/fileinput/js/fileinput.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript">
    if ($('#mybarChart').length ){

    	var ctx = document.getElementById("mybarChart");
    	var mybarChart = new Chart(ctx, {
    	type: 'bar',
    	//Data
    	data: {
    		labels: [<?php
    		include "../system/includes/load.php";

                $startDay = 1;

    						for($i=6;$i>=1;$i--){

    						$year = date("y");
    						$date = date("m")-$i;
    						?>
    			'<?php
    		 if ($date == -5) {
    			 $year = $year - 1;
    			 $date = 7;
    			 echo "Julio";
    			 $endDay = 31;
    		 }elseif ($date == -4) {
    				$year = $year - 1;
    				$date = 8;
    			 echo "Agosto";
    			 $endDay = 31;
    		 }elseif ($date == -3) {
    				$year = $year - 1;
    				$date = 9;
    			 echo "Septiembre";
    			 $endDay = 30;
    		 }elseif ($date == -2) {
    				$year = $year - 1;
    				$date = 10;
    			 echo "Octubre";
    			 $endDay = 31;
    		 }elseif ($date == -1) {
    				$year = $year - 1;
    				$date = 11;
    			 echo "Noviembre";
    			 $endDay = 30;
    		 }elseif ($date == 0) {
    				$year = $year - 1;
    				$date = 12;
    			 echo "Diciembre";
    			 $endDay = 31;
    		 }elseif ($date == 1) {
    			 echo "Enero";
    			 $endDay = 31;
    		 }elseif ($date == 2) {
    			 echo "Febrero";
    			 $endDay = 28;
    		 }elseif ($date == 3) {
    			 echo "Marzo";
    			 $endDay = 31;
    		 }elseif ($date == 4) {
    			 echo "Abril";
    			 $endDay = 30;
    		 }elseif ($date == 5) {
    			 echo "Mayo";
    			 $endDay = 31;
    		 }elseif ($date == 6) {
    			 echo "Junio";
    			 $endDay = 30;
    		 }elseif ($date == 7) {
    			 echo "Julio";
    			 $endDay = 31;
    		 }elseif ($date == 8) {
    			 echo "Agosto";
    			 $endDay = 31;
    		 }elseif ($date == 9) {
    			 echo "Septiembre";
    			 $endDay = 30;
    		 }elseif ($date == 10) {
    			 echo "Octubre";
    			 $endDay = 31;
    		 }elseif ($date == 11) {
    			 echo "Noviembre";
    			 $endDay = 30;
    		 }elseif ($date == 12) {
    			 echo "Diciembre";
    			 $endDay = 31;
    		 }?>',<?php }?>],
    		datasets: [{
    		label: 'Entradas $',
    		backgroundColor: "#26B99A",
    		data: [<?php
                for($i=6;$i>=1;$i--){

                $date = date("m")-$i;
                $year = date("y");
                ?>
        <?php
         if ($date == -5) {
           $year = $year - 1;
           $date = 7;
           $endDay = 31;
         }elseif ($date == -4) {
            $year = $year - 1;
            $date = 8;
           $endDay = 31;
         }elseif ($date == -3) {
            $year = $year - 1;
            $date = 9;
           $endDay = 30;
         }elseif ($date == -2) {
            $year = $year - 1;
            $date = 10;
           $endDay = 31;
         }elseif ($date == -1) {
            $year = $year - 1;
            $date = 11;
           $endDay = 30;
         }elseif ($date == 0) {
            $year = $year - 1;
            $date = 12;
           $endDay = 31;
         }elseif ($date == 1) {
           $endDay = 31;
         }elseif ($date == 2) {
           $endDay = 28;
         }elseif ($date == 3) {
           $endDay = 31;
         }elseif ($date == 4) {
           $endDay = 30;
         }elseif ($date == 5) {
           $endDay = 31;
         }elseif ($date == 6) {
           $endDay = 30;
         }elseif ($date == 7) {
           $endDay = 31;
         }elseif ($date == 8) {
           $endDay = 31;
         }elseif ($date == 9) {
           $endDay = 30;
         }elseif ($date == 10) {
           $endDay = 31;
         }elseif ($date == 11) {
           $endDay = 30;
         }elseif ($date == 12) {
           $endDay = 31;
         }
          $sql = "SELECT sale_total FROM sales WHERE sale_date BETWEEN '$year/$date/$startDay' AND '$year/$date/$endDay' ";
          $result = $db->query($sql);
          $totalResult = 0;
          while ($data = $result->fetch_assoc()) {
         	    $totalResult += $data['sale_total'];
          }
        ?>
        '<?php echo $totalResult; ?>',<?php }?>
      ]
    		}, {
    		label: 'Salidas $',
    		backgroundColor: "#03586A",
    		data: [<?php
                for($i=6;$i>=1;$i--){

                $date = date("m")-$i;
                $year = date("y");
                ?>
        <?php
         if ($date == -5) {
           $year = $year - 1;
           $date = 7;
           $endDay = 31;
         }elseif ($date == -4) {
            $year = $year - 1;
            $date = 8;
           $endDay = 31;
         }elseif ($date == -3) {
            $year = $year - 1;
            $date = 9;
           $endDay = 30;
         }elseif ($date == -2) {
            $year = $year - 1;
            $date = 10;
           $endDay = 31;
         }elseif ($date == -1) {
            $year = $year - 1;
            $date = 11;
           $endDay = 30;
         }elseif ($date == 0) {
            $year = $year - 1;
            $date = 12;
           $endDay = 31;
         }elseif ($date == 1) {
           $endDay = 31;
         }elseif ($date == 2) {
           $endDay = 28;
         }elseif ($date == 3) {
           $endDay = 31;
         }elseif ($date == 4) {
           $endDay = 30;
         }elseif ($date == 5) {
           $endDay = 31;
         }elseif ($date == 6) {
           $endDay = 30;
         }elseif ($date == 7) {
           $endDay = 31;
         }elseif ($date == 8) {
           $endDay = 31;
         }elseif ($date == 9) {
           $endDay = 30;
         }elseif ($date == 10) {
           $endDay = 31;
         }elseif ($date == 11) {
           $endDay = 30;
         }elseif ($date == 12) {
           $endDay = 31;
         }
         $sql = "SELECT total FROM purchases WHERE purchase_date BETWEEN '$year/$date/$startDay' AND '$year/$date/$endDay' ";
         $total = 0;
         $res = $db->query($sql);
         while ($datos = $res->fetch_assoc()) {
         $total += $datos['total'];
       }
     ?>
     '<?php echo $total; ?>',<?php }?>
       ]
    	}],

     //Options
    	options: {
    		scales: {
    		yAxes: [{
    			ticks: {
    			beginAtZero: true
    			}
    		}]
    		}
    	}
    	//End options

    	}

    	//End Data
    });
    }
    </script>


</body>
</html>
