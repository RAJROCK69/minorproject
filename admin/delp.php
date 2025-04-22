<?php
include("db.php");
$did= $_GET['did'];
$sel="SELECT * FROM product WHERE productid='$did'";
$rs=$dbLink->query($sel);
$row=$rs->fetch_assoc();
unlink("product_img/".$row['product_image']);
$d="DELETE FROM product WHERE productid='$did'";
$dbLink->query($d);

header("location:list-products.php");

?>