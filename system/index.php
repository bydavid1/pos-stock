<?php
  ob_start();
  require_once('includes/load.php');
  if($session->isUserLoggedIn(true)) { redirect('dashboard.php', false);}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sistema de Gestión de Inventario</title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Language" content="es"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- Custom Theme Style -->
	<link href="../build/css/custom.min.css" rel="stylesheet">

</head>
<body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
      <div class="animate form login_form">
          <section class="login_content">
				<div class="messages">
					<?php echo display_msg($msg); ?>
		        </div>
			<form class="form-horizontal" action="auth.php" method="post" id="loginForm">
			<h1 >Iniciar Sesion</h1>
				<div>
				<input type="text" class="form-control" placeholder="Usuario" id="username" name="username" placeholder="Nombre de usuario" autocomplete="off" required />
            </div>
            <div>
            	<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" autocomplete="off" required />
            </div>
            <div>
            	<button type="submit" class="btn btn-success"> <i class="glyphicon glyphicon-log-in"></i> Ingresar</button>
            	<a class="reset_pass" href="#" >Olvidaste tu contraseña??</a>
            </div>
							<div class="clearfix"></div>

            <div class="separator">
            <p class="change_link" >¿No tienes cuenta?
            	<a href="#" class="to_register" > Crea una aqui! </a>
            </p>

            <div class="clearfix"></div>
            <br />

            <div>
            	<h4 ><i class="fa fa-comments"></i> byronjimenez9911@gmail.com</h4>
            	<p >©2019 All Rights Reserved. El Salvador</p>
            </div>
            </div>
						</form>
          </section>
        </div>
    </div>
</div>

	<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
</body>
</html>




