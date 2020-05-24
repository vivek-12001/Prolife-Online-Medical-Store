<?php

include("database.php");

if(isset($_POST["page_id"]))
{
	$query = "select * from category where category_id = '".$_POST["page_id"]."'";
	$result = mysqli_query($connect,$query);
	$output = '';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
		<h1>'.$row["category_name"].'</h1>
		';
	}
	echo $output;
}

?>