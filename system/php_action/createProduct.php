<?php

require_once '../includes/load.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {

	$productName = remove_junk($db->escape($_POST['productName']));
	$codProduct = remove_junk($db->escape($_POST['codProduct']));
    $quantity = remove_junk($db->escape($_POST['quantity']));
    $provName = remove_junk($db->escape($_POST['provName']));
    $categoryName = remove_junk($db->escape($_POST['categoryName']));
    $productStatus = remove_junk($db->escape($_POST['productStatus']));
    $typeProd = remove_junk($db->escape($_POST['type']));
	$purchase_price = remove_junk($db->escape($_POST['purchase_price']));
	$price1 = remove_junk($db->escape($_POST['price1']));
	$price2 = remove_junk($db->escape($_POST['price2']));
	$price3 = remove_junk($db->escape($_POST['price3']));
	$price4 = remove_junk($db->escape($_POST['price4']));
	$utility1 = remove_junk($db->escape($_POST['utility1']));
	$utility2 = remove_junk($db->escape($_POST['utility2']));
	$utility3 = remove_junk($db->escape($_POST['utility3']));
	$utility4 = remove_junk($db->escape($_POST['utility4']));
    $date  = make_date();

	if ($price1 == '') {
		$price1 = 0.00;
		$utility1 = 0.00;
	}
	if ($price2 == '') {
		$price2 = 0.00;
		$utility2 = 0.00;
	}
	if ($price3 == '') {
		$price3 = 0.00;
		$utility3 = 0.00;
	}
	if ($price4 == '') {
		$price4 = 0.00;
		$utility4 = 0.00;
	}

 $imageValidate =  $_FILES["productImage"];

    if ($_FILES['productImage']['name'] != null) {

			$type = explode('.', $_FILES['productImage']['name']);
			$type = $type[count($type)-1];

        	$url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;

					if(in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG'))) {
						if(is_uploaded_file($_FILES['productImage']['tmp_name'])) {
							if (move_uploaded_file($_FILES['productImage']['tmp_name'], $url)) {
								  $sql = "INSERT INTO product (product_cod, product_type, product_name, product_image, provider_id, categories_id, quantity, purchase_price, price1, price2, price3, price4, utility1, utility2, utility3, utility4, product_status, product_active)
								  VALUES ('$codProduct', '$typeProd', '$productName', '$url', '$provName', '$categoryName', '$quantity', $purchase_price, $price1, $price2, $price3, $price4, $utility1, $utility2, $utility3, $utility4,'$productStatus', 1)";
												$res = $db->query($sql);
							}else {
								$valid['success'] = false;
								$valid['messages'] = "Ocurrio un error al mover la imagen";

							}
					 }else {
						   $valid['success'] = false;
						   $valid['messages'] = "Ocurrio un error al procesar la imagen";
					 }
				 }else {
					 $valid['success'] = false;
					 $valid['messages'] = "Tipo de imagen no admitido";
				 }
     }else{
         	$defaultImg = '../assests/images/photo_default.png';
					$sql = "INSERT INTO product (product_cod, product_type, product_name, product_image, provider_id, categories_id, quantity, purchase_price, price1, price2, price3, price4, utility1, utility2, utility3, utility4, product_active, product_status)
					VALUES ('$codProduct', '$typeProd', '$productName', '$defaultImg', '$provName', '$categoryName', '$quantity', $purchase_price, $price1, $price2, $price3, $price4, $utility1, $utility2, $utility3, $utility4,'$productStatus', 1)";
									$res = $db->query($sql);
       }

					$product_id = $db->insert_id();

	if($res > 0) {
		$kardex = "INSERT INTO kardex (kardex_concept, kardex_date, quantity, balance, product_id) VALUES ('Inicio en inventario', '$date', $quantity, '0', $product_id)";
		$fact = $db->query($kardex);
		if ($fact > 0) {
			$valid['success'] = TRUE;
			$valid['messages'] = "Creado exitosamente";
		}else {
			$valid['success'] = false;
			$valid['messages'] = "Ocurrio un error al ingresar el producto al kardex, (error: ".$db->error.")";
			if ($_FILES['productImage']['name'] != null) {
			unlink($url);
		  }
		}

	} else {
		 $valid['success'] = false;
		 $valid['messages'] = 'Ocurrio un error al crear el producto, (error: ' .$db->error. ')';
		 if ($_FILES['productImage']['name'] != null) {
		 unlink($url);
	 }
	}



    $db = null;
	echo json_encode($valid);

} // /if $_POST
