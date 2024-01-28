<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <div class="modal update-modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel"
        aria-hidden="true">
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

    <div class="modal add-modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-form">
                        <div class="mb-3">
                            <label for="nameadd">Name</label>
                            <input type="text" class="form-control" id="nameadd">
                        </div>
                        <div class="mb-3">
                            <label for="emailadd">Email</label>
                            <input type="email" class="form-control" id="emailadd">
                        </div>
                        <div class="mb-3">
                            <label for="cityadd">City</label>
                            <input type="text" class="form-control" id="cityadd">
                        </div>
                        <button type="button" id="adduser" class="btn btn-primary">Add User</button>
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

    <button id="add-button" class="btn btn-success">Add Data</button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            var dataTable = $('#myTable').DataTable({
                columns: [
                    { data: 'Id' },
                    { data: 'Name' },
                    { data: 'Email' },
                    { data: 'City' },
                    {
                        data: null,
                        render: function (data, type, row) {
                            return '<button class="edit-btn btn btn-primary" type="button" data-bs-toggle="modal" ' +
                                'data-bs-target="#exampleModal" data-id="' + row.Id + '">Edit</button> ' +
                                '<button class="delete-btn btn btn-danger" data-id="' + row.Id + '">Delete</button>';
                        }
                    }
                ]
            });

            function loadTable() {
                $.ajax({
                    url: "data.php",
                    dataType: "json",
                    success: function (data) {
                        dataTable.clear();
                        dataTable.rows.add(data).draw();
                    }
                });
            }
            loadTable();

            $(document).on("click", ".edit-btn", function () {
                $(".update-modal").modal('show');
                let userId = $(this).data("id");

                $.ajax({
                    url: "update.php",
                    type: "POST",
                    data: { id: userId },
                    success: function (data) {
                        $("#model-form").html(data);
                    }
                });
            });

            $(document).on("click", "#savemodel", function () {
                let idmodel = $("#idmodel").val();
                let namemodel = $("#namemodel").val();
                let emailmodel = $("#emailmodel").val();
                let citymodel = $("#citymodel").val();

                $.ajax({
                    url: "update-data.php",
                    type: "POST",
                    data: { id: idmodel, name: namemodel, email: emailmodel, city: citymodel },
                    success: function (data) {
                        if (data == 1) {
                            $(".update-modal").modal('hide');
                            loadTable();
                        }
                    }
                });
            });

            $(document).on('click', '.delete-btn', function () {
                if (confirm("Are you sure?")) {
                    let userId = $(this).data('id');

                    $.ajax({
                        url: "delete.php",
                        type: "POST",
                        data: { id: userId },
                        success: function (data) {
                            if (data == 1) {
                                loadTable();
                            }
                        }
                    });
                }
            });

            $(document).on("click", "#add-button", function () {
                $("#addModal").modal('show');

                $("#adduser").click(function () {
                    $.ajax({
                        url: "insert.php",
                        type: "POST",
                        data: {
                            nameadd: $("#nameadd").val(),
                            emailadd: $("#emailadd").val(),
                            cityadd: $("#cityadd").val()
                        },
                        success: function (data) {
                            if (data == 1) {
                                $(".add-modal").modal('hide');
                                loadTable();
                            }
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>
