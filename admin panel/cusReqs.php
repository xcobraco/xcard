<?php
include '../inc/header.php';
include '../inc/connection.php';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Perform database query to retrieve all data
$sql = "SELECT * FROM contact";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles_tab.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../css/font-awesome-4.7.0/css/font-awesome.min.css">
    
    <title>Requests</title>
    <style>
        .action-column {
            white-space: nowrap;
        }
    </style>
    
    <!-- Include jQuery from a CDN -->
    
    <script>
        $(document).ready(function(){
            $('#table1').DataTable();
        });
    </script>
    <!-- Add jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <!-- Add DataTables CSS and JS files -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <!-- Optional: Add DataTables Buttons extension for exporting -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

</head>
<body>
    <div class="container">
        <h2 class="mb-4" id="topic1">Customer Requests</h2>
        <br></br>
        <div class="tb1">
            <table class="table table-striped" style="margin: auto; width: 100%;  overflow-x: auto;table-layout: fixed; opacity:0.9;" id="table1">
                <thead>
                    <tr>
                        <th>ReqID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Request</th>
                        <th>Current Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through the result set and display data
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['CID']}</td>";
                        echo "<td>{$row['Name']}</td>";
                        echo "<td>{$row['Email']}</td>";
                        echo "<td>{$row['Subject']}</td>";
                        echo "<td>{$row['Message']}</td>";
                        echo "<td>{$row['Review_Status']}</td>";

                        echo "<td class='action-column'>";
                        echo "<a class='btn btn-success me-2' onclick='changeStatus({$row['CID']})'>Mark as Done</a> <br><br>";
                        echo "<a class='btn btn-danger'  onclick='confirmDelete({$row['CID']})'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <script>
            // Add DataTables initialization
            $(document).ready(function() {
                $('#table1').DataTable({
                    // Optional: Add buttons for exporting
                    dom: 'Bfrtip',
                    buttons: [
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ],
                    // Optional: Enable sorting by default
                    "order": [[0, "asc"]]
                });
            });
            </script>
            <script>
                 function confirmDelete(Id) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'reqDelete.php?id=' + Id;
                        }
                    });
                }

                function changeStatus(Id) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Click yes if the process is done',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#355E3B',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'changeStatus.php?id=' + Id;
                        }
                    });
                }
            </script>
            <br><br>
        </div>
    </div>

    <footer class="bg-body-tertiary text-center" style="opacity: 0.75;">
        <div class="text-center p-3" style="background-color: rgba(255, 255, 255);">
            ©  All Rights Reserved.
            Designed by Xcobra
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

<?php
// Close connection
$conn->close();
?>
