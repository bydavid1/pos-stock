<?php 	

require_once '../includes/load.php';

$productId = $_GET['i'];

$sql = "SELECT product_image FROM product WHERE product_id = {$productId}";
$data = $db->query($sql);
$result = $data->fetch_row();

$db = null;

echo $result[0];
