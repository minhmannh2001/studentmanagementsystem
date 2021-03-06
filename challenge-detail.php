<?php
    $error = '';
    
    session_start();
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $position = $_SESSION['position'];

    include 'config.php';

    $_SESSION['add-item-success'] = "false";

    $mark_form_appear = "false";

    if (!isset($_SESSION['challengeid-from-challenge-detail'])) {
        $_SESSION['challengeid-from-challenge-detail'] = $_GET['challengeid'];
    }

    if ($position == 'Student') {
        header('Location: challenge-detail-for-students.php', true, 301);
    }

    try {
        $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
    } catch(PDOException $e) {
        // roll back the transaction if something failed
        $conn->rollback();
        echo "Error: " . $e->getMessage();
        header('Location: 500.html', true, 301);
    }
    
    if (isset($_GET['challengeid']) or isset($_SESSION['challengeid-from-challenge-detail'])) {
        $form_challenge_id = $_GET['challengeid'];
        if ($form_challenge_id != "") {
            $_SESSION['challengeid-from-challenge-detail'] = "";
        }
        if ($_SESSION['challengeid-from-challenge-detail'] == "") {
            $_SESSION['challengeid-from-challenge-detail'] = $_GET['challengeid'];
        }
        if ($form_challenge_id == "" and isset($_SESSION['challengeid-from-challenge-detail'])) {
            $form_challenge_id = $_SESSION['challengeid-from-challenge-detail'];
        }
        $stmt = $conn->prepare("SELECT * FROM Challenges WHERE challenge_id=:challenge_id;");
        $stmt->bindParam(':challenge_id', $form_challenge_id);
        $stmt->execute();
        $challenge = $stmt->fetch(PDO::FETCH_ASSOC);
        $show_challenge_id = $form_challenge_id;
        $show_challenge_title = $challenge['challenge_title'];
        $show_challenge_content = $challenge['challenge_content'];
        $show_challenge_creator_id = $challenge['challenge_creator_id'];
        $show_challenge_list_id = $challenge['challenge_participant_list_id'];

        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_id=:user_id;");
        $stmt->bindParam(':user_id', $show_challenge_creator_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $show_challenge_creator_name = $result['user_firstname'] . " " . $result['user_lastname'];

        $show_challenge_creator_username = $result['user_account'];
        $show_challenge_creation_date = $challenge['challenge_creation_date'];
        $show_challenge_creation_date = date_create($show_challenge_creation_date);
        $show_challenge_creation_date = date_format($show_challenge_creation_date, "H:i d/m/Y");
        $show_challenge_expiration_date = $challenge['challenge_expiration_date'];
        $show_challenge_expiration_date = date_create($show_challenge_expiration_date);
        $show_challenge_expiration_date = date_format($show_challenge_expiration_date, "H:i d/m/Y");
        $show_challenge_no_participants = $challenge['challenge_no_participants'];
        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_position='Student';");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $total_nb_of_students = count($result);
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
        <title>Challenge Detail - Student Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles2.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <?php include 'admin-panel-topbar.php' ?>
        <div id="layoutSidenav">
        <?php include 'admin-panel-sidebar.php' ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"><?php echo "$show_challenge_title"; ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <?php
                                if ($position == 'Teacher') {
                                    echo "
                                        <li class='breadcrumb-item'><a href='manage-challenges.php'>Manage Challenges</a></li>
                                    ";
                                } else {
                                    echo "
                                        <li class='breadcrumb-item'><a href='manage-challenges.php'>Challenge List</a></li>
                                    ";
                                }
                            ?>
                            
                            <li class="breadcrumb-item active">Challenge Detail</li>
                        </ol>
                        <hr>
                        <h3>Description</h3>
                        <div class="d-flex justify-content-between align-items-center" style="width: 50%;">
                            <div>
                                <div class="d-flex align-items-center">
                                    <p>Creator:&nbsp</p>
                                    <p><a href="user-profile.php?username=<?php echo "$show_challenge_creator_username"; ?>" style="text-decoration: none;"><?php echo "$show_challenge_creator_name"; ?></a></p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p>Total Participants:&nbsp</p>
                                    <p><?php echo "$show_challenge_no_participants/$total_nb_of_students students"; ?></p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p style="margin-bottom: 0;">Subject:&nbsp</p>
                                    <p style="margin-bottom: 0;">
                                        <p style="margin-bottom: 0;"><?php echo "$show_challenge_content"; ?></p>
                                        &nbsp(<a href="download.php?path=challenges/<?php echo "$show_challenge_content"; ?>">Download</a>)
                                    </p>
                                </div>
                            </div>
                            <div style="border-radius: 5px; background-color: #f2f2f2; padding: 20px;">
                                <div class="d-flex align-items-center;">
                                    <p>Creation Date:&nbsp&nbsp</p>
                                    <p><?php echo "$show_challenge_creation_date"; ?></p>
                                </div>
                                <div class="d-flex align-items-center" style="margin-bottom: -20px;">
                                    <p>Expiration Date:&nbsp&nbsp</p>
                                    <p><?php echo "$show_challenge_expiration_date"; ?></p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <?php
                            $stmt = $conn->prepare("SELECT * FROM ParticipantList WHERE list_id=:list_id AND challenge_submission IS NOT NULL ORDER BY participant_submit_date, participant_score;");
                            $stmt->bindParam(':list_id', $show_challenge_list_id);
                            $stmt->execute();
                            $results = $stmt->fetchAll();
                            $nb_submission = count($results);
                            echo "<h5>Total Submission: $nb_submission</h5>";
                        ?>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Submission List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple"  class="hover stripe row-border" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Class</th>
                                            <th>Submission State</th>
                                            <th>Answer</th>
                                            <th>Submission Date</th>
                                            <th>Answer State</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Class</th>
                                            <th>Submission State</th>
                                            <th>Answer</th>
                                            <th>Submission Date</th>
                                            <th>Answer State</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                            $count = 1;
                                            foreach ($results as $result) {
                                                $challenge_participant_id = $result['participant_id'];
                                                $stmt = $conn->prepare("SELECT * FROM Users WHERE user_id=:user_id;");
                                                $stmt->bindParam(':user_id', $challenge_participant_id);
                                                $stmt->execute();
                                                $student = $stmt->fetch(PDO::FETCH_ASSOC);
                                                $challenge_student_name = $student['user_firstname'] . " " . $student['user_lastname'];
                                                $challenge_student_class = $student['user_class'];
                                                
                                                    echo "
                                                        <tr>
                                                            <td>$count</td>
                                                            <td>$challenge_participant_id</td>
                                                            <td>$challenge_student_name</td>
                                                            <td>$challenge_student_class</td>
                                                    ";
                                                
                                                $stmt = $conn->prepare("SELECT * FROM Challenges WHERE challenge_participant_list_id=:challenge_participant_list_id;");
                                                $stmt->bindParam(':challenge_participant_list_id', $show_challenge_list_id);
                                                $stmt->execute();
                                                $challenge = $stmt->fetch(PDO::FETCH_ASSOC);
                                                if ($result['participant_submit_date'] < $challenge['challenge_expiration_date']) {
                                                    echo "<td style='color: #226f61;'>Submitted</td>";
                                                } else {
                                                    echo "
                                                        <td style='color: red;'>Late Submitted</td>
                                                    ";
                                                }
                                                
                                                $student_submit_file = $result['challenge_submission'];
                                                echo "
                                                    <td class='d-flex justify-content-between'>
                                                        <p style='margin-bottom: 0px;'>$student_submit_file</p>
                                                        <a href='download.php?path=submission/$student_submit_file'>Download</a>
                                                    </td>
                                                ";
                                                $show_challenge_submit_date = date_create($result['participant_submit_date']);
                                                $show_challenge_submit_date = date_format($show_challenge_submit_date, "H:i d/m/Y");
                                                if ($result['participant_submit_date'] < $challenge['challenge_expiration_date']) {
                                                    echo "
                                                        <td>$show_challenge_submit_date</td>
                                                    ";
                                                } else {
                                                    echo "
                                                        <td style='color: red;'>$show_challenge_submit_date</td>
                                                    ";
                                                }
                                                
                                                $student_score = $result['participant_score'];
                                                if ($student_score == 10) {
                                                    echo "<td>Correct</td>";
                                                } else if ($student_score == 0) {
                                                    echo "<td>Incorrect</td>";
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
                <div id="snackbar">Update successfully.</div>
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
                $add_item_success = $_SESSION['add-item-success'];
                if ($add_item_success == "true") {
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