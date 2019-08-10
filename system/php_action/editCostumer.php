<?php
	require_once 'core.php';
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        }else if (empty($_POST['mod_nombre'])) {
           $errors[] = "Nombre vacío";
        }  else if ($_POST['mod_estado']==""){
			$errors[] = "Selecciona el estado del cliente";
		}  else if (
			!empty($_POST['mod_id']) &&
			!empty($_POST['mod_nombre']) &&
			$_POST['mod_estado']!="" 
		){

		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($connect,(strip_tags($_POST["mod_nombre"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($connect,(strip_tags($_POST["mod_telefono"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($connect,(strip_tags($_POST["mod_email"],ENT_QUOTES)));
		$direccion=mysqli_real_escape_string($connect,(strip_tags($_POST["mod_direccion"],ENT_QUOTES)));
		$estado=intval($_POST['mod_estado']);
		
		$id_cliente=intval($_POST['mod_id']);
		$sql="UPDATE clientes SET nombre_cliente='".$nombre."', telefono_cliente='".$telefono."', email_cliente='".$email."', direccion_cliente='".$direccion."', status_cliente='".$estado."' WHERE id_cliente='".$id_cliente."'";
		$query_update = mysqli_query($connect,$sql);
			if ($query_update){
				$messages[] = "Cliente ha sido actualizado satisfactoriamente.";
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