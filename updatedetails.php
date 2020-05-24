<?php

include("database.php");

$query1 = "";

foreach($_SESSION["shopping_cart"] as $keys => $values)
{
    $query1 .= "
        update product_details set product_quantity = product_quantity - ".$values["product_quantity"]." where product_id = ".$values["product_id"].";
    ";
}

mysqli_multi_query($connect,$query1);

$query2 = "select * from product_details";
$result2 = mysqli_query($connect,$query2);

while($row = mysqli_fetch_array($result2))
{
    if($row["product_quantity"] <= 0)
    {
        $query3 .= "
            update product_details set product_status = 0 where product_id = ".$row["product_id"].";
        ";
    }
}

mysqli_multi_query($connect,$query3);

?>