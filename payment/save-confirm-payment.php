<?php
@include("../configdb.php");
$name = $_POST['name'];
$lname = $_POST['lname'];
$tel = $_POST['tel'];
$date = $_POST['date'];
$order_id = $_POST['order_id'];

$conn = mysql_connect( "$host", "$user", "$pass");
mysql_select_db("t-shirt");

    //*** Read file BINARY ***'
    $fp = fopen($_FILES["files"]["tmp_name"],"r");
    $ReadBinary = fread($fp,filesize($_FILES["files"]["tmp_name"]));
    fclose($fp);
    $FileData = addslashes($ReadBinary);

    $strSQL = "INSERT INTO confirm_order (confirm_name,confirm_lname,confirm_tel,confirm_date,order_id,confirm_pic) values ('".$name."','".$lname."','".$tel."','".$date."','".$order_id."','".$FileData."')";
    mysql_query("SET NAMES UTF8");
    $objParse = mysql_query($strSQL, $conn);

    $strSQL2 = "UPDATE orders SET status='transferred' WHERE order_id='".$order_id."'";
    mysql_query("SET NAMES UTF8");
    $objParse2 = mysql_query($strSQL2, $conn);


?>
<script>
  window.location="confirm-payment.php?success=yes";
</script>
