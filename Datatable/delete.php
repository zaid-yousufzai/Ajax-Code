<?php

if(isset($_POST['id']))
{
    $userId=$_POST['id'];
    $conn=new mysqli("localhost","root","","dataTable-db");
    $sql="DELETE FROM `dataTable` WHERE id=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("i",$userId);
    $result=$stmt->execute();

    if($result)
    {
        echo 1;
    }

}




?>