<?php
    $warning = '';
    
    session_start();
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $position = $_SESSION['position'];
    
    // username of deleted user
    $delete_username = '';

    $just_delete = $_SESSION['just-delete'];
    $_SESSION['just-delete'] = 'false';

    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "test";

    if ($position == "Student") {
        header('Location: 401.html', true, 301);
    }

    try {
        $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        header('Location: 500.html', true, 301);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Manage Classes - Student Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles2.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            .link-button {
                background: none!important;
                border: none;
                padding: 0!important;
                color: #1774fd;
                text-decoration: underline;
                cursor: pointer;
            }
        
            /* Set a style for all buttons */
            .btn-modal {
                background-color: #04AA6D;
                color: white;
                padding: 14px 20px;
                margin: 8px 0;
                border: none;
                cursor: pointer;
                width: 100%;
                opacity: 0.9;
            }

            .btn-modal:hover {
                opacity:1;  
            }

            /* Float cancel and delete buttons and add an equal width */
            .cancelbtn, .deletebtn {
                float: left;
                width: 50%;
            }

            /* Add a color to the cancel button */
            .cancelbtn {
                background-color: #ccc;
                color: black;
            }

            /* Add a color to the delete button */
            .deletebtn {
                background-color: #f44336;
            }

            /* Add padding and center-align text to the container */
            .container-modal {
                padding: 16px;
                text-align: center;
            }

            /* The Modal (background) */
            .modal-confirm {
                display: none; /* Hidden by default */
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                left: 0;
                top: 0;
                width: 100%; 
                height: 100%; /* Full height */
                overflow: auto; /* Enable scroll if needed */
                background-color: #343a40;
                padding-top: 50px;
            }

            /* Modal Content/Box */
            .modal-content {
                background-color: #fefefe;
                margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
                border: 1px solid #888;
                width: 50%; /* Could be more or less, depending on screen size */
            }

            /* Style the horizontal ruler */
            hr {
                border: 1px solid #f1f1f1;
                margin-bottom: 25px;
            }

            /* The Modal Close Button (x) */
            .close {
                position: absolute;
                right: 35px;
                top: 15px;
                font-size: 40px;
                font-weight: bold;
                color: #f1f1f1;
            }

            .close:hover,
            .close:focus {
                color: #f44336;
                cursor: pointer;
            }

            .clearfix::after {
                content: "";
                clear: both;
                display: table;
            }

            /* Change styles for cancel button and delete button on extra small screens */
            @media screen and (max-width: 300px) {
                .cancelbtn, .deletebtn {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <div id="id01" class="modal-confirm">
            <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
            <form class="modal-content" action="delete-object.php" method="POST">
                <div class="container-modal">
                <h1>Delete Class</h1>
                <p>Are you sure you want to delete this class?</p>
                <div class="clearfix">
                    <button type="button" onclick="modal_cancel_btn()" class="cancelbtn btn-modal">Cancel</button>
                    <button type="button" onclick="modal_delete_btn()" class="deletebtn btn-modal">Delete</button>
                </div>
                </div>
            </form>
        </div>
        <?php include 'admin-panel-topbar.php' ?>
        <div id="layoutSidenav">
        <?php include 'admin-panel-sidebar.php' ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Manage Classes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Classes</li>
                        </ol>
                        <a href="add-classes.php" style="background-color: #0d6efd; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none;">Add new</a>
                        <?php
                            $stmt = $conn->prepare("SELECT * FROM Classes;");
                            $stmt->execute();
                            $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $nb_classes = count($classes);
                            echo "<h5 style='margin-top: 20px;'>Total Classes: $nb_classes</h5>";
                        ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Class List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple"  class="hover stripe row-border" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Class Name</th>
                                            <th>Homeroom Teacher</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Class Name</th>
                                            <th>Homeroom Teacher</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            // echo "$username";
                                            $count = 1;
                                            $stmt = $conn->prepare("SELECT * FROM Classes;");
                                            $stmt->execute();
                                            $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($classes as $class) {
                                                $class_id = $class['class_id'];
                                                $class_name = $class['class_name'];
                                                $class_homeroom_teacher_id = $class['class_homeroom_teacher_id'];
                                                if ($class_homeroom_teacher_id != "") {
                                                    try {
                                                        $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
                                                        $sql = "SELECT user_firstname, user_lastname FROM Users WHERE user_id=$class_homeroom_teacher_id";
                                                        $result = $conn->query($sql);
                                                        $row = $result->fetch_assoc();
                                                        $class_homeroom_teacher_firstname = $row['user_firstname'];
                                                        $class_homeroom_teacher_lastname = $row['user_lastname'];
                                                        $class_homeroom_teacher_name = $class_homeroom_teacher_firstname . " " . $class_homeroom_teacher_lastname;
                                                    } catch(PDOException $e) {
                                                        echo "Connection failed: " . $e->getMessage();
                                                        header('Location: 500.html', true, 301);
                                                    }
                                                } else {
                                                    $class_homeroom_teacher_name = "Not Set";
                                                }
                                                $class_creation_date = $class['class_creation_date'];
                                                $class_creation_date = date_create($class_creation_date);
                                                $class_creation_date = date_format($class_creation_date, "d/m/Y");
                                                echo "
                                                <tr>
                                                    <td>$class_id</td>
                                                    <td>$class_name</td>
                                                    <td>$class_homeroom_teacher_name</td>
                                                    <td>$class_creation_date</td>
                                                ";
                                                
                                                echo "  
                                                    <td class='d-flex'>
                                                        <form action='class-detail.php' method='POST'>
                                                            <input type='hidden' value='$class_name' name='classname'>
                                                            <button class='link-button' type='submit'>Update</button>
                                                        </form>
                                                        &nbsp
                                                        |
                                                        &nbsp
                                                        <form action='delete-object.php' id='delete-form$count' onsubmit='event.preventDefault(); modal_confirm_appear($count);' method='POST'>
                                                            <input type='hidden' value='$class_name' name='classname'>
                                                            <input type='hidden' value='class' name='deleteobject'>
                                                            <button class='link-button' type='submit'>Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>";
                                                
                                                $count += 1;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <div id="snackbar">Delete successfully.</div>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Student Management Student 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts2.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script>
            let isConfirmed = false;
            let form_number = 0;

            function modal_delete_btn() {
                isConfirmed = true;
                document.querySelector('#delete-form' + form_number).submit();
            }

            function modal_confirm_appear(form_number_param) {
                form_number = form_number_param;
                document.getElementById('id01').style.display='block';
            }

            function modal_cancel_btn() {
                document.getElementById('id01').style.display='none';
            }

            // Get the modal
            var modal = document.getElementById('id01');

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

            function mySnackbar() {
                // Get the snackbar DIV
                var x = document.getElementById("snackbar");
                
                console.log(x);

                // Add the "show" class to DIV
                x.className = "show";

                // After 3 seconds, remove the show class from DIV
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            } 

            <?php
                if ($just_delete == 'true') {
                    echo "
                        window.onload = function() {
                            mySnackbar()
                        };
                    ";
                }
            ?>
            
        </script>
    </body>
</html>
