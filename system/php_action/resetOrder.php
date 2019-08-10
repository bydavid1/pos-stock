<?php

require_once 'core.php'; //Conexion y verificacion de sesion

$session_id= session_id();

$deleteProducts = mysqli_query($connect, "DELETE  FROM tmp WHERE session_id = '$session_id'");


?>