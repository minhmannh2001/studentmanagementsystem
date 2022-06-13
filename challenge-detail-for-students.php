<?php
    $error = '';
    
    session_start();
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $position = $_SESSION['position'];

    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "test";

    $_SESSION['add-item-success'] = "false";

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
    
    if (isset($_SESSION['challengeid-from-challenge-detail'])) {
        $form_challenge_id = $_SESSION['challengeid-from-challenge-detail'];
        $stmt = $conn->prepare("SELECT * FROM Challenges WHERE challenge_id=:challenge_id;");
        $stmt->bindParam(':challenge_id', $form_challenge_id);
        $stmt->execute();
        $challenge = $stmt->fetch(PDO::FETCH_ASSOC);
        $show_challenge_id = $form_challenge_id;
        $show_challenge_title = $challenge['challenge_title'];
        $show_challenge_description = $challenge['challenge_description'];
        $show_challenge_creator_id = $challenge['challenge_creator_id'];
        $show_challenge_no_participants = $challenge['challenge_no_participants'];
        $show_challenge_content = $challenge['challenge_content'];
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

        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_position='Student';");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $total_nb_of_students = count($result);

    }
                
    if (isset($_POST['submit'])) {

        $form_challenge_answer = $_POST['challengeanswer'];
        $challenge_correct_answer = explode('-', $show_challenge_content);
        $challenge_correct_answer = strtolower(end($challenge_correct_answer));
        $challenge_correct_answer = explode('.', $challenge_correct_answer);
        $challenge_correct_answer = $challenge_correct_answer[0];

        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_account=:user_account;");
        $stmt->bindParam(':user_account', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $challenge_participant_id = $result['user_id'];

        if ($challenge_correct_answer == $form_challenge_answer) {
            $challenge_score = 10;
        } else {
            $challenge_score = 00;
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $current_timestamp = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("UPDATE ParticipantList SET challenge_submission=:challenge_submission, participant_submit_date=:participant_submit_date, participant_score=:participant_score WHERE list_id=:list_id AND participant_id=:participant_id;");
        $stmt->bindParam(':challenge_submission', $form_challenge_answer);
        $stmt->bindParam(':participant_submit_date', $current_timestamp);
        $stmt->bindParam(':participant_score', $challenge_score);
        $stmt->bindParam(':list_id', $show_challenge_list_id);
        $stmt->bindParam(':participant_id', $challenge_participant_id);
        $stmt->execute();

        $stmt = $conn->prepare("SELECT * FROM Challenges WHERE challenge_id=:challenge_id;");
        $stmt->bindParam(':challenge_id', $show_challenge_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $challenge_update_no_participants = $result['challenge_no_participants'];
        $challenge_update_no_participants = $challenge_update_no_participants + 1;
        $stmt = $conn->prepare("UPDATE Challenges SET challenge_no_participants=:challenge_no_participants WHERE challenge_id=:challenge_id;");
        $stmt->bindParam(':challenge_no_participants', $challenge_update_no_participants);
        $stmt->bindParam(':challenge_id', $show_challenge_id);
        $stmt->execute();

        $_SESSION['add-item-success'] = "true";
        
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
                            <li class="breadcrumb-item"><a href="manage-challenges.php">Challenge List</a></li>
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
                                <div class="d-flex align-items-start" style="width: 500px;">
                                    <p style="margin-bottom: 0;">Description:&nbsp</p>
                                    <p style="margin-bottom: 0;">
                                        <?php echo "$show_challenge_description"; ?>
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
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Submission Form
                            </div>
                            <div class="card-body">
                                <?php
                                    $stmt = $conn->prepare("SELECT * FROM Users WHERE user_account=:user_account;");
                                    $stmt->bindParam(':user_account', $username);
                                    $stmt->execute();
                                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                    $challenge_participant_id = $result['user_id'];
                                    
                                    $stmt = $conn->prepare("SELECT * FROM Challenges WHERE challenge_id=:challenge_id;");
                                    $stmt->bindParam(':challenge_id', $form_challenge_id);
                                    $stmt->execute();
                                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                    $challenge_list_id = $result['challenge_participant_list_id'];

                                    $stmt = $conn->prepare("SELECT * FROM ParticipantList WHERE list_id=:list_id AND participant_id=:participant_id AND challenge_submission IS NOT NULL;");
                                    $stmt->bindParam(':list_id', $challenge_list_id);
                                    $stmt->bindParam(':participant_id', $challenge_participant_id);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    if (count($result) == 0) {
                                        $tmp = $_SERVER['PHP_SELF'];
                                        echo "
                                            <form action='$tmp' method='POST'>
                                                <label for='challengeanswer'>Your Answer</label>
                                                <input required='true' id='challengeanswer'  accept='.docx, .pdf'  name='challengeanswer' style='width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;'>

                                                <input type='submit' name='submit' value='Submit' style='background-color: #0d6efd; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;'>
                                            </form>
                                        ";
                                    } else {
                                        $submission_file = $result[0]['challenge_submission'];
                                        echo "You have submitted. Your answer is $submission_file.";
                                        echo "<br>Or click <a href='resend-challenge-submission.php'>here</a> to answer again.";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </main>
                <?php
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $current_timestamp = date('Y-m-d H:i:s');
                    if ($current_timestamp < $challenge['challenge_expiration_date']) {
                        echo "<div id='snackbar'>Submit successfully.</div>";
                    } else {
                        echo "<div id='snackbar'>Submit Late.</div>";
                    }
                ?>
                <div id="snackbar">Submit successfully.</div>
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
