<?php

	session_start();
	include("database.php");

	$product_id = $_SESSION["product_id"];

	$query = " 
		SELECT * FROM product_comment WHERE product_id = '$product_id' order by comment_id desc
	";

	$result = mysqli_query($connect,$query);

	$output = '';
	while($row = mysqli_fetch_array($result))
	{
		 $output .= '
		 <div class="panel panel-default">
		  <div class="panel-heading">By <b>'.$row["comment_sender_name"].'</b> on <i>'.$row["date"].'</i></div>
		  <div class="panel-body">'.$row["comment"].'</div>
		 </div>
		 ';
	}

	echo $output;

?>
