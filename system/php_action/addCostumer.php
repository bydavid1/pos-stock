<?php
	require_once 'core.php';
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['nombre'])) {
           $errors[] = "Nombre vacío";
        } else if (!empty($_POST['nombre'])){
		// escaping, additionally removing everything that could be (html/javascript-) code
		$code=mysqli_real_escape_string($connect,(strip_tags($_POST["code"],ENT_QUOTES)));
		$nit=mysqli_real_escape_string($connect,(strip_tags($_POST["nit"],ENT_QUOTES)));
		$nombre=mysqli_real_escape_string($connect,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($connect,(strip_tags($_POST["telefono"],ENT_QUOTES)));
		$contact=mysqli_real_escape_string($connect,(strip_tags($_POST["contact"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($connect,(strip_tags($_POST["email"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($connect,(strip_tags($_POST["direccion"],ENT_QUOTES)));
		$ciudad=mysqli_real_escape_string($connect,(strip_tags($_POST["ciudad"],ENT_QUOTES)));
		$departament=mysqli_real_escape_string($connect,(strip_tags($_POST["departament"],ENT_QUOTES)));
		$credito=mysqli_real_escape_string($connect,(strip_tags($_POST["credito"],ENT_QUOTES)));
		$date_added=date("Y-m-d H:i:s");
		$sql="INSERT INTO clientes (code, nit, nombre_cliente, telefono_cliente, contact, email_cliente, direccion_cliente, city, departament, credit, available, date_added) VALUES ('$code', '$nit','$nombre','$telefono','$contact','$email','$direccion','$ciudad', '$departament', '$credito', 1,'$date_added')";
		$query_new_insert = mysqli_query($connect,$sql);
			if ($query_new_insert){
				$messages[] = "Cliente ha sido ingresado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($connect);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>