<?php

include("database.php");

$error = '';
$comment_name = '';
$comment_content = '';

$product_id = $_POST["product_id"];

if(empty($_POST["comment_name"]))
{
 $error .= '<p class="text-danger">Name is required</p>';
}
else
{
 $comment_name = $_POST["comment_name"];
}

if(empty($_POST["comment_content"]))
{
 $error .= '<p class="text-danger">Comment is required</p>';
}
else
{
 $comment_content = $_POST["comment_content"];
}

if($error == '')
{
 $query = "
	insert into product_comment (product_id, comment, comment_sender_name) values ('$product_id','$comment_content','$comment_name')
 ";
 if(mysqli_query($connect,$query))
 {
	$error = '<label class="text-success">Comment Added</label>';
 }
}

$data = array(
 'error'  => $error
);

echo json_encode($data);

?>
