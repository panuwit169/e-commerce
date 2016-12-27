<?php
session_start();
@include("../configdb.php");
mysql_connect("$host","$user","$pass");
mysql_select_db("t-shirt");

  $Total = 0;
  $SumTotal = 0;
  mysql_query("SET NAMES UTF8");
  $strSQL = "
	INSERT INTO orders (order_date,name,lname,address,tel,status)
	VALUES
	('".date("Y-m-d")."','".$_POST["name"]."','".$_POST["lname"]."' ,'".$_POST["address"]."','".$_POST["tel"]."','wait')";
  mysql_query($strSQL) or die(mysql_error());

  $strOrderID = mysql_insert_id();

  for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
  {
	  if($_SESSION["strProductID"][$i] != "")
	  {
			  $strSQL = "
				INSERT INTO orders_detail (order_id,stock_id,qty)
				VALUES
				('".$strOrderID."','".$_SESSION["strProductID"][$i]."','".$_SESSION["strQty"][$i]."')
			  ";

			  mysql_query($strSQL) or die(mysql_error());

      	$_SESSION["strProductID"][$i] = "";
      	$_SESSION["strQty"][$i] = "";
      	$_SESSION["count"]=0;
	  }
  }

mysql_close();

//session_destroy();

header("location:finish_order.php?OrderID=".$strOrderID);
?>
