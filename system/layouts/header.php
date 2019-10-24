<?php require_once 'includes/load.php'; 
if (!$session->isUserLoggedIn(true)) { redirect('index.php', false);}?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

	<title>Sistema de Gestión de Inventario</title>
	<!-- jQuery -->
	<script src="../vendors/jquery/jquery.min.js"></script>
	<script src="../vendors/jquery-ui/jquery-ui.min.js"></script>
	<!-- Bootstrap -->
	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
	<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<!-- file input -->
	<link rel="stylesheet" href="../vendors/fileinput/css/fileinput.min.css">
	<!-- bootstrap-progressbar -->
	<link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
	<!-- bootstrap-daterangepicker -->
	<link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	<!-- jQuery custom content scroller -->
	<link href="../vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet" />
	<!-- Custom Theme Style -->
	<link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-sm">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col menu_fixed">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="dashboard.php" class="site_title"><i class="fa fa-cube"></i>
							<span>Administrador</span></a>
					</div>

					<div class="clearfix"></div>

					<br />

					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<h3>General</h3>
							<ul class="nav side-menu">
								<li><a><i class="fa fa-list"></i> Inventario <span
											class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="product.php">Productos</a></li>
										<li><a href="categories.php">Categorias</a></li>
										<li><a href="providers.php">Proveedores</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-shopping-cart"></i> Ventas <span
											class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="addSale.php">Agregar Factura</a></li>
										<li><a href="sales.php">Gestionar Facturas</a></li>
										<li><a href="addCredit.php">Agregar credito fiscal</a></li>
										<li><a href="credit.php">Gestionar credito fiscal</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-usd"></i> Compras <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="addPurchase.php">Agregar compras</a></li>
										<li><a href="purchases.php">Gestionar compras</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-retweet"></i> Devoluciones <span
											class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="addReturn.php">Agregar devolucion</a></li>
										<li><a href="returns.php">Gestionar devoluciones</a></li>
									</ul>
								</li>
								<li><a><i class="fa fa-file"></i> Cotizaciones <span
											class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="addQuotation.php">Crear Cotizacion</a></li>
										<li><a href="quotations.php">Gestionar cotizaciones</a></li>
									</ul>
								</li>
								<li><a href="costumers.php"><i class="fa fa-user"></i>Clientes</a></li>
							</ul>
						</div>
						<div class="menu_section">
							<h3>Contabilidad</h3>
							<ul class="nav side-menu">
								<li><a><i class="fa fa-arrow-up"></i> Cuentas por cobrar</a></li>

								<li><a><i class="fa fa-arrow-down"></i> Cuentas por pagar</a></li>

								<li><a href="kardex.php"><i class="fa fa-book"></i> Kardex</a></li>

								<li><a><i class="fa fa-area-chart"></i> Reportes</a></li>

							</ul>
						</div>

					</div>
					<!-- /sidebar menu -->

					<!-- /menu footer buttons -->
					<div class="sidebar-footer hidden-small">
						<a data-toggle="tooltip" data-placement="top" title="Settings">
							<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="FullScreen">
							<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Lock">
							<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
						</a>
						<a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
							<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
						</a>
					</div>
					<!-- /menu footer buttons -->
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<nav>
						<div class="nav toggle">
							<a id="menu_toggle"><i class="fa fa-bars"></i></a>
						</div>

						<ul class="nav navbar-nav navbar-right">
							<li class="">
								<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
									aria-expanded="false">
									<img src="../system/assests/images/user.png" alt="">Byron
									<span class=" fa fa-angle-down"></span>
								</a>
								<ul class="dropdown-menu dropdown-usermenu pull-right">
									<li><a href="javascript:;"> Perfil</a></li>
									<li>
										<a href="javascript:;">
											<span>Ajustes</span>
										</a>
									</li>
									<li><a href="javascript:;">Ayuda</a></li>
									<li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Cerrar sesion</a>
									</li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<!-- /top navigation -->

			<div class="right_col" role="main">