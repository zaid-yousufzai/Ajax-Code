
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
        <td><button class='edit-btn' data-id='{$row["id"]}'>Edit</button></td>
        <td><button class='delete-btn' data-id='{$row["id"]}'>Delete</button></td>

    </tr>";
    }

    echo $output;
}


?>