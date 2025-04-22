<?php
if(isset($_POST['submit']))
{ ?>
<?php
include("db.php");
$n=$dbLink->real_escape_string($_POST["product"]);
$e=$_POST["price"];
$desc=$dbLink->real_escape_string($_POST["desc"]);
$buf=$_FILES['img']['tmp_name'];
$fn=time().$_FILES['img']['name'];
move_uploaded_file($buf,"upload/".$fn);

$ins="INSERT INTO product SET pname='$n',price='$e',pdescription='$desc',productImg='$fn' ";
$dbLink->query($ins);
?>
<h1>Your Product name is <?php echo $n ?></h1>
<h1>Product Price is <?php echo $e ?></h1>
<h1>Description is <?php echo $desc ?></h1>
<?php
header("location:list-products.php")
?>
<?php }
else {
    echo "Access Denied :)";
}
?>