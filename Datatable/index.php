<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="model-form">
                        
                       
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <table id="myTable" class="display table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>City</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <button id="load-button">Load Data</button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            // DataTable initialization
            var dataTable = $('#myTable').DataTable({
                columns: [
                    { data: 'Id' },
                    { data: 'Name' },
                    { data: 'Email' },
                    { data: 'City' },
                    {
                        // "Options" column
                        data: null,
                        render: function (data, type, row) {
                            // Render "Edit" and "Delete" buttons
                            return '<button class="edit-btn btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="' + row.Id + '">Edit</button> ' +
                                '<button class="delete-btn btn btn-danger" data-id="' + row.Id + '">Delete</button>';
                        }
                    }
                ]
            });

            $("#load-button").click(function() {
                $.ajax({
                    url: "data.php",
                    dataType: "json", // Expecting JSON response
                    success: function(data) {
                        // Clear existing data
                        dataTable.clear();

                        // Add new data
                        dataTable.rows.add(data).draw();
                    }
                });
            });

            // Edit button click event
            $(document).on("click", ".edit-btn", function() {
                $(".modal").modal('show');
                let userId = $(this).data("id");

                // Fetch user data for editing
                $.ajax({
                    url: "update.php",
                    type: "POST",
                    data: { id: userId },
                    success: function(data) {
                        $("#model-form").html(data);
                    }
                });
            });

            // Save changes button click event
            $(document).on("click", "#savemodel", function() {
                let idmodel = $("#idmodel").val();
                let namemodel = $("#namemodel").val();
                let emailmodel = $("#emailmodel").val();
                let citymodel = $("#citymodel").val();

                $.ajax({
                    url: "update-data.php",
                    type: "POST",
                    data: { id: idmodel, name: namemodel, email: emailmodel, city: citymodel },
                    success: function(data) {
                        if (data == 1) {
                            $(".modal").modal('hide');
                            $("#load-button").trigger('click'); // Reload data
                        }
                    }
                })
            });

            $(document).on('click','.delete-btn',function()
            {

                alert("Are you sure ?");
                let userId=$(this).data('id');

                $.ajax({
                    url:"delete.php",
                    type:"POST",
                    data:{id:userId},
                    success:function(data)
                    {
                        if(data==1)
                        $("#load-button").trigger('click'); // Reload data
                    }
                })
            });
        });
    </script>
</body>
</html>
