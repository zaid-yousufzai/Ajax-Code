<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td {
            border: 1px solid black;
        }
        table {
            border: 1px solid black;
        }
        .model{
            border: 1px solid black;
            padding: 10px;
            
            width: 400px;
            display: none;
            
        }
    </style>
</head>
<body>
    <table>
        <thead>

        <form >
            <input type="text" id="name" name="name" >
            <input type="submit" value="Save" id="btn">
        </form>
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Update</td>
                <td>Delete</td>
            </tr>
        </thead>
        <tbody id="table-data"> <!-- Corrected the ID attribute -->
        </tbody>
    </table>

    <div class="model">
        <form id="model-form">
           
        
    
    

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            function loadTable() {
                $.ajax({
                    url: "data.php",
                    type: "POST",
                    success: function(data) {
                        $("#table-data").html(data);
                    }
                });
            }

            loadTable();

            $("#btn").click(function(e)
            {
                e.preventDefault();
                 let fname=$("#name").val();
                $.ajax({
                    url:"insert.php",
                    type:"POST",
                     data:{name:fname},
                    success:function(data)
                    {
                        loadTable();
                    }
                })
            })

            $(document).on("click", ".delete-btn", function() {
    let userId = $(this).data("id");
    let element=this;
    $.ajax({
        url:"delete.php",
        type:"POST",
        data:{id:userId},
        success:function(data)
        {

            if(data==1)
            {
                $(element).closest("tr").fadeOut();
            }

        }
    })
});

$("#hidemodel").click(function()
{
    $(".model").fadeOut();
})

$(document).on("click", ".edit-btn", function() {
            $(".model").fadeIn();

            let userId = $(this).data("id");

            $.ajax({
                url: "update.php",
                type: "POST",
                data: { id: userId },
                success: function(data) {
                    $("#model-form").html(data);
                }
            });
        });
    


        $(document).on("click","#savemodel",function()
        {
            let namemodel=$("#namemodel").val();
            let  idmodel=$("#idmodel").val();

            $.ajax({
                url:"update-data.php",
                type:"POST",
                data:{id:idmodel, name:namemodel},
                success:function(data)
                {
                    if(data==1)
                    {
                        $(".model").fadeOut();
                    }
                }
            })
        })

        });
    </script>
</body>
</html>
