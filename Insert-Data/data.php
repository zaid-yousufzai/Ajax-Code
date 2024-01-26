
<?php


$conn=new mysqli("localhost","root","","ajax-db");
$sql="SELECT * FROM `ajax-user`";
$result=mysqli_query($conn,$sql);
$output='';
if(mysqli_num_rows($result)>0)
{
    while($row=mysqli_fetch_assoc($result))
    {
        $output .= " <tr>
        <td>{$row['id']}</td>
        <td>{$row['name']}</td>
    </tr>";
    }

    echo $output;
}


?>