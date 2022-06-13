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

    // if ($position == "Student") {
    //     header('Location: 401.html', true, 301);
    // }

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
        <<?php
            if ($position == "Teacher") {
                echo "<title>Manage Challenges - Student Management System</title>";
            } else {
                echo "<title>Challenge List - Student Management System</title>";
            }
        ?>
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
                <h1>Delete Challenge</h1>
                <p>Are you sure you want to delete this challenge?</p>
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
                        <?php
                            if ($position == 'Teacher') {
                                echo "
                                    <h1 class='mt-4'>Manage Challenges</h1>
                                    <ol class='breadcrumb mb-4'>
                                        <li class='breadcrumb-item'><a href='admin-panel.php'>Dashboard</a></li>
                                        <li class='breadcrumb-item active'>Manage Challenges</li>
                                    </ol>
                                ";
                            } else {
                                echo "
                                    <h1 class='mt-4'>Challenge List</h1>
                                    <ol class='breadcrumb mb-4'>
                                        <li class='breadcrumb-item'><a href='admin-panel.php'>Dashboard</a></li>
                                        <li class='breadcrumb-item active'>Challenge List</li>
                                    </ol>
                                ";
                            }
                        ?>
                        <hr style="border-top: 1px solid #222222;">
                            <div class="d-flex align-items-center">
                                <p><b>Rule:&nbsp&nbsp</b></p>
                                <p>Teacher creates a challenge. Upload 1 file txt which has the content of poem, story, etc. By Providing some suggestions about challenges, students nead to guess the name of that poem, story</p>
                            </div>
                            <p>If true, the content will be shown.</p>
                        <hr style="border-top: 1px solid #222222;">
                        <?php
                            if ($position == 'Teacher') {
                                echo "
                                <a href='add-challenges.php' style='background-color: #0d6efd; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none;'>Add new</a>                   
                                ";
                            }
                        ?>
                        <?php
                            $stmt = $conn->prepare("SELECT * FROM Challenges;");
                            $stmt->execute();
                            $challenges = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            $nb_challenges = count($challenges);
                            echo "<h5 style='margin-top: 20px;'>Total Challenges: $nb_challenges</h5>";
                        ?>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Challenges List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple"  class="hover stripe row-border" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <?php
                                                if ($position == "Teacher") {
                                                    echo "<th>Content</th>";
                                                }
                                            ?>
                                            <th>Creator</th>
                                            <th>Number Of Participants</th>
                                            <th>Creation Date</th>
                                            <th>Expiration Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <?php
                                                if ($position == "Teacher") {
                                                    echo "<th>Content</th>";
                                                }
                                            ?>
                                            <th>Creator</th>
                                            <th>Number Of Participants</th>
                                            <th>Creation Date</th>
                                            <th>Expiration Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                            $count = 1;
                                            foreach ($challenges as $challenge) {
                                                $table_challenge_id = $challenge['challenge_id'];
                                                $table_challenge_title = $challenge['challenge_title'];
                                                $table_challenge_content = $challenge['challenge_content'];
                                                $table_challenge_creator_id = $challenge['challenge_creator_id'];
                                                $stmt = $conn->prepare("SELECT * FROM Users WHERE user_id=:user_id;");
                                                $stmt->bindParam(':user_id', $table_challenge_creator_id);
                                                $stmt->execute();
                                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                                $table_challenge_creator_name = $result['user_firstname'] . " " . $result['user_lastname'];
                                                $table_challenge_no_participants = $challenge['challenge_no_participants'];
                                                $table_challenge_creation_date = $challenge['challenge_creation_date'];
                                                $table_challenge_creation_date = date_create($table_challenge_creation_date);
                                                $table_challenge_creation_date = date_format($table_challenge_creation_date, "H:i d/m/Y");
                                                $table_challenge_expiration_date = $challenge['challenge_expiration_date'];
                                                $table_challenge_expiration_date = date_create($table_challenge_expiration_date);
                                                $table_challenge_expiration_date = date_format($table_challenge_expiration_date, "H:i d/m/Y");
                                                
                                                if ($position == 'Teacher') {
                                                    echo "
                                                    <tr>
                                                        <td>$count</td>
                                                        <td>$table_challenge_title</td>
                                                        <td class='d-flex justify-content-between'>
                                                            <p style='margin-bottom: 0px;'>$table_challenge_content</p>
                                                            <a href='download.php?path=challenges/$table_challenge_content'>Download</a>
                                                        </td>
                                                        <td>$table_challenge_creator_name</td>
                                                        <td>$table_challenge_no_participants</td>
                                                        <td>$table_challenge_creation_date</td>
                                                        <td>$table_challenge_expiration_date</td>
                                        
                                                        <td class='d-flex'>
                                                            <form action='challenge-detail.php' method='GET'>
                                                                <input type='hidden' value='$table_challenge_id' name='challengeid'>
                                                                <button class='link-button' type='submit'>More</button>
                                                            </form>
                                                            &nbsp
                                                            |
                                                            &nbsp
                                                            <form action='delete-object.php' id='delete-form$count' onsubmit='event.preventDefault(); modal_confirm_appear($count);' method='POST'>
                                                                <input type='hidden' value='$table_challenge_id' name='challengeid'>
                                                                <input type='hidden' value='challenge' name='deleteobject'>
                                                                <button class='link-button' type='submit'>Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>";
                                                } else {
                                                    echo "
                                                    <tr>
                                                        <td>$count</td>
                                                        <td>$table_challenge_title</td>
                                                        <td>$table_challenge_creator_name</td>
                                                        <td>$table_challenge_no_participants</td>
                                                        <td>$table_challenge_creation_date</td>
                                                        <td>$table_challenge_expiration_date</td>
                                        
                                                        <td class='d-flex'>
                                                            <form action='challenge-detail.php' method='GET'>
                                                                <input type='hidden' value='$table_challenge_id' name='challengeid'>
                                                                <button class='link-button' type='submit'>More</button>
                                                            </form>
                                                            &nbsp
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
