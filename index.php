<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border: 1px solid black;
        }

        td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Name</td>
            </tr>
        </thead>
        <tbody id="table-data">
            
           
        </tbody>
    </table>

    <button id="load-button">Load Data</button>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#load-button').click( function () {
                $.ajax({
                    url: "data.php",
                    type: "POST",
                    success: function (data) {
                        $('#table-data').html(data);
                    }
                });
            });
        });
    </script>
</body>
</html>