<?php require_once 'layouts/header.php';


$orderSql = "SELECT sale_total FROM sales WHERE sale_active = 1";
$orderQuery = $db->query($orderSql);

$totalRevenue = 0;
while ($saleResult = $orderQuery->fetch_assoc()) {
	$totalRevenue += $saleResult['sale_total'];
}

$orderSql = "SELECT total FROM purchases WHERE purchase_active = 1";
$orderQuery = $db->query($orderSql);
$totalPurchase = 0;
while ($data = $orderQuery->fetch_assoc()) {
	$totalPurchase += $data['total'];
}
 ?>

<div class="row">

	<!-- top tiles -->
	<div class="row tile_count">
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
			<span class="count_top"><i class="fa fa-group"></i> Clientes totales</span>
			<div class="count">	<?php
				$sql = "SELECT COUNT(*) cost_id FROM costumers";
				$result = $db->query($sql);
				$fila = $result->fetch_assoc();
				echo $fila['cost_id'];
				 ?></div>
			<span class="count_bottom"><i class="green"><i class="fa fa-check"></i></i> Actualizado</span>
		</div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
			<span class="count_top"><i class="fa fa-cube"></i> Productos totales</span>
			<div class="count"><?php
			$sql = "SELECT quantity FROM product ";
			$result = $db->query($sql);
			$totalproduct = 0;
			while ($data = $result->fetch_assoc()) {
				$totalproduct += $data['quantity'];
			}
				echo $totalproduct;
				 ?></div>
			<span class="count_bottom"><i class="green"><i class="fa fa-check"></i></i> Actualizado</span>
		</div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
			<span class="count_top"><i class="fa fa-cube"></i> Productos comprados</span>
			<div class="count red"><?php
			$sql = "SELECT quantity FROM purchases ";
			$result = $db->query($sql);
			$totalOutlay = 0;
			while ($data = $result->fetch_assoc()) {
				$totalOutlay += $data['quantity'];
			}
				echo $totalOutlay;
				 ?></div>
			<span class="count_bottom"> Desde la ultima semana</span>
		</div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
			<span class="count_top"><i class="fa fa-cube"></i> Productos vendidos</span>
			<div class="count green"><?php
			$sql = "SELECT quantity FROM sale_item ";
			$result = $db->query($sql);
			$totalOrder = 0;
			while ($data = $result->fetch_assoc()) {
				$totalOrder += $data['quantity'];
			}
				echo $totalOrder;
				 ?></div>
			<span class="count_bottom">Desde la ultima semana</span>
		</div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
			<span class="count_top"><i class="fa fa-truck"></i> Proveedores totales</span>
			<div class="count"><?php
			$sql = "SELECT COUNT(*) total FROM providers";
			$result = $db->query($sql);
			$fila = $result->fetch_assoc();
			echo $fila['total'];
				 ?></div>
			<span class="count_bottom"><i class="green"><i class="fa fa-check"></i></i> Actualizado</span>
		</div>
		<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
			<span class="count_top"><i class="fa fa-usd"></i> Equilibrio monetario</span>
			<?php
   if ($totalRevenue && $totalPurchase) {
   	  if ($totalRevenue > $totalPurchase) {
   	  $result =	$totalRevenue - $totalPurchase;
			echo "<div class='count green'> +$". $result ."</div>
	    <span class='count_bottom'><i class='green'><i class='fa fa-sort-asc'></i></i>  Desde la ultima semana</span>" ;
		}else {
			$result =	$totalPurchase - $totalRevenue;
			echo "<div class='count red'> -$". $result. "</div>
	    <span class='count_bottom'><i class='red'><i class='fa fa-sort-desc'></i></i>  Desde la ultima semana</span>" ;
		}
   }
				 ?>
		</div>
	</div>
	<!-- /top tiles -->


	<div class="row">
		<div class="col-md-5 col-sm-6 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Compras y ventas <small>Totales</small></h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
						<li><a class="close-link"><i class="fa fa-close"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="dashboard-widget-content">

						<div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
						 <div class="tile-stats" style="background: #28a745">
							<div class="icon" style="color: white"><i class="fa fa-shopping-cart"></i>
							</div>
							<div class="count" style="color: white">
								<?php
							if($totalRevenue) {
								echo "$".number_format($totalRevenue,2);
								} else {
									echo '0';
									} ?></div>

							<h3 style="color: white">Ventas totales</h3>
						 </div>
					 </div>


						<div class="animated flipInY col-lg-12 col-md-12 col-sm-12 col-xs-12">
						 <div class="tile-stats" style="background:#dc3545">
							<div class="icon" style="color: white"><i class="fa fa-truck"></i>
							</div>
							<div class="count" style="color: white">
							<?php
							 if($totalPurchase) {
								echo "$".number_format($totalPurchase,2);
								} else {
									echo '0';
									} ?></div>

							<h3 style="color: white">Compras totales</h3>
						 </div>
					 </div>

					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Entradas y salidas <small>Ultimos 6 meses</small></h2>
					<ul class="nav navbar-right panel_toolbox">
						<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
						</li>
						<li><a class="close-link"><i class="fa fa-close"></i></a>
						</li>
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<canvas id="mybarChart"></canvas>
				</div>
			</div>
		</div>

	</div>


</div> <!--/row-->


<?php include 'layouts/footer.php'; ?>
