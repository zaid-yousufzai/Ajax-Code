<?php

$userId=$_POST['id'];
$conn=new mysqli("localhost","root","","ajax-db");

$sql="DELETE FROM `ajax-user` WHERE id={$userId}";

if(mysqli_query($conn,$sql))
{
    echo 1;
}

?>