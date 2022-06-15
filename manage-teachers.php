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

    include 'config.php';

    if ($position == "Student") {
        header('Location: 401.html', true, 301);
    }
    
    if ($username == "") {
        header('Location: 404.html', true, 301);
    }
    
    try {
        $conn = new PDO("mysql:host=$db_servername;port=$db_port;dbname=$db_name", $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
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
        <title>Manage Teachers - Student Management System</title>
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
                <h1>Delete User</h1>
                <p>Are you sure you want to delete this user?</p>
                <!-- <input type='hidden' value='<?php $delete_username ?>' name='username'> -->
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
                        <h1 class="mt-4">Manage Teachers</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Teachers</li>
                        </ol>
                        <a href="add-teachers.php" style="background-color: #0d6efd; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none;">Add new</a>
                        <?php
                            $stmt = $conn->prepare("SELECT * FROM Users WHERE user_position = 'Teacher';");
                            $stmt->execute();
                            $teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $nb_teachers = count($teachers);
                            echo "<h5 style='margin-top: 20px;'>Total Teachers: $nb_teachers</h5>";
                        ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Teacher List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple"  class="hover stripe row-border" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Teacher ID</th>
                                            <th>Teacher Name</th>
                                            <th>Teacher Account</th>
                                            <th>Teacher Class</th>
                                            <th>Teacher Email</th>
                                            <th>Start date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Teacher ID</th>
                                            <th>Teacher Name</th>
                                            <th>Teacher Account</th>
                                            <th>Teacher Class</th>
                                            <th>Teacher Email</th>
                                            <th>Start date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $count = 1;
                                            $stmt = $conn->prepare("SELECT * FROM Users WHERE user_position = 'Teacher';");
                                            $stmt->execute();
                                            $teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($teachers as $teacher) {
                                                $teacher_id = $teacher['user_id'];
                                                $teacher_name = $teacher['user_firstname'] . ' ' . $teacher['user_lastname'];
                                                $teacher_username = $teacher['user_account'];
                                                $teacher_class = $teacher['user_class'];
                                                $teacher_email = $teacher['user_email'];
                                                if ($teacher['user_class'] == "") {
                                                    $teacher_class = 'Not Set';
                                                }
                                                $teacher_start_date = $teacher['user_start_date'];
                                                $teacher_start_date = date_create($teacher_start_date);
                                                $teacher_start_date = date_format($teacher_start_date, "d/m/Y");
                                                echo "
                                                <tr>
                                                    <td>$count</td>
                                                    <td>$teacher_id</td>
                                                    <td>$teacher_name</td>
                                                    <td>$teacher_username</td>
                                                    <td>$teacher_class</td>
                                                    <td>$teacher_email</td>
                                                    <td>$teacher_start_date</td>
                                                ";
                                                if ($teacher_username == $username) {
                                                    echo "
                                                        <td class='d-flex'>
                                                            <a href='user-profile.php'>More</a>
                                                            &nbsp
                                                            |
                                                            &nbsp
                                                            <a disabled>Delete</a>
                                                        </td>
                                                    </tr>
                                                    ";
                                                } else {
                                                    echo "  
                                                            <td class='d-flex'>
                                                            <form action='user-profile.php' method='GET'>
                                                                <input type='hidden' value='$teacher_username' name='username'>
                                                                <button class='link-button' type='submit'>More</button>
                                                            </form>
                                                            &nbsp
                                                            |
                                                            &nbsp
                                                            <form action='delete-object.php' id='delete-form$count' onsubmit='event.preventDefault(); modal_confirm_appear($count);' method='POST'>
                                                                <input type='hidden' value='$teacher_username' name='username'>
                                                                <button class='link-button' type='submit'>Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>";

                                                }
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
