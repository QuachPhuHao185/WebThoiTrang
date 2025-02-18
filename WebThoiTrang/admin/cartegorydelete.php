<?php
include "class/cartegory_class.php";
$cartegory = new cartegory;
$cartegory_id = $_GET['cartegory_id'];
$delete_cartegory = $cartegory -> delete_cartegory($cartegory_id);
?>
