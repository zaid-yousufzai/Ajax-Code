<?php

$userId=$_POST['id'];

$conn=new mysqli("localhost","root","","ajax-db");

$sql="SELECT * FROM `ajax-user` WHERE id={$userId}";
$result=mysqli_query($conn,$sql);
$output='';
if(mysqli_num_rows($result)>0)
{
    
        while ($row = mysqli_fetch_assoc($result)) {
            $output = ' <input type="text" id="idmodel" name="namemodel" hidden value="' . $row["id"] . '">  
            <input type="text" id="namemodel" name="namemodel" value="' . $row["name"] . '">  
            <button id="savemodel">Save</button>
            <button id="hidemodel">Hide</button> ';
        }
        
    

    echo $output;
   
}




?>