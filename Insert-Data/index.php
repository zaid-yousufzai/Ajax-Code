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
                <td>Delete</td>
            </tr>
        </thead>
        <tbody id="table-data"> <!-- Corrected the ID attribute -->
        </tbody>
    </table>

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

        });
    </script>
</body>
</html>
