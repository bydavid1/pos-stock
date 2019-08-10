<?php

require_once '../includes/load.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$productId = remove_junk($db->escape($_POST['id']));
	$productCode = remove_junk($db->escape($_POST['editProductCode']));	 
	$productName = remove_junk($db->escape($_POST['editProductName']));
    $quantity =	remove_junk($db->escape($_POST['editQuantity']));
    $purchasePrice 	= remove_junk($db->escape($_POST['editPurchasePrice']));
	$type 	= remove_junk($db->escape($_POST['editType']));
    $provId = remove_junk($db->escape($_POST['editprovName']));
    $categoryName = remove_junk($db->escape($_POST['editCategoryName']));
    $productStatus = remove_junk($db->escape($_POST['editProductStatus']));
    $price1 = remove_junk($db->escape($_POST['editPrice1']));
	$price2 = remove_junk($db->escape($_POST['editPrice2']));
	$price3 = remove_junk($db->escape($_POST['editPrice3']));
	$price4 = remove_junk($db->escape($_POST['editPrice4']));
	$utility1 =	remove_junk($db->escape($_POST['editUtility1']));
	$utility2 =	remove_junk($db->escape($_POST['editUtility2']));
	$utility3 =	remove_junk($db->escape($_POST['editUtility3']));
	$utility4 =	remove_junk($db->escape($_POST['editUtility4']));



	$sql = "UPDATE product SET product_cod = '$productCode', product_name = '$productName', provider_id = '$provId', product_type = '$type', categories_id = '$categoryName', quantity = '$quantity', purchase_price = $purchasePrice, price1 = $price1, price2 = $price2, price3 = $price3, price4 = $price4, utility1 = $utility1, utility2  = $utility2, utility3 = $utility3, utility4 = $utility4, product_status = '$productStatus', product_active = 1 WHERE product_id = $productId ";
	if($db->query($sql) == TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Actualizado exitosamente";
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido actualizar";
	}

} 

$db = null;

echo json_encode($valid);
