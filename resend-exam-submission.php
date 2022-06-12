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
    
    if (isset($_SESSION['examid-from-exam-detail'])) {
        $form_exam_id = $_SESSION['examid-from-exam-detail'];
        $stmt = $conn->prepare("SELECT * FROM Exams WHERE exam_id=:exam_id;");
        $stmt->bindParam(':exam_id', $form_exam_id);
        $stmt->execute();
        $exam = $stmt->fetch(PDO::FETCH_ASSOC);
        $show_exam_id = $form_exam_id;
        $show_exam_title = $exam['exam_title'];
        $show_exam_class = $exam['exam_class'];
        $show_exam_subject = $exam['exam_subject'];
        $show_exam_creator_id = $exam['exam_creator_id'];

        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_id=:user_id;");
        $stmt->bindParam(':user_id', $show_exam_creator_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $show_exam_creator_name = $result['user_firstname'] . " " . $result['user_lastname'];

        $show_exam_creator_username = $result['user_account'];
        $show_exam_creation_date = $exam['exam_creation_date'];
        $show_exam_creation_date = date_create($show_exam_creation_date);
        $show_exam_creation_date = date_format($show_exam_creation_date, "H:i d/m/Y");
        $show_exam_expiration_date = $exam['exam_expiration_date'];
        $show_exam_expiration_date = date_create($show_exam_expiration_date);
        $show_exam_expiration_date = date_format($show_exam_expiration_date, "H:i d/m/Y");

        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_class=:user_class AND user_position='Student';");
        $stmt->bindParam(':user_class', $show_exam_class);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $total_nb_of_students = count($result);

    }
                
    if (isset($_POST['submit'])) {

        // exam submit file
        $form_exam_subject_name = $_FILES["examsubmitfile"]["name"];
        $form_exam_subject_size = $_FILES["examsubmitfile"]["size"];
        $form_exam_subject_tmpname = $_FILES["examsubmitfile"]["tmp_name"];
        // Validate exam submit file
        $valid_exam_subject_extension = ["docx", "pdf"];
        $form_exam_subject_extension = explode('.', $form_exam_subject_name);
        $form_exam_subject_extension = strtolower(end($form_exam_subject_extension));

        if (!in_array($form_exam_subject_extension, $valid_exam_subject_extension)) {
            echo "
                <script> alert('Invalid file extension.') </script>
            ";
        } else if ($form_exam_subject_size > 100000) {
            echo "
                <script> alert('File size is too large.') </script>
            ";
        } else {
            $exam_object_unique = uniqid();
            $form_exam_subject_name = $exam_object_unique . '-' . $form_exam_subject_name;
            move_uploaded_file($form_exam_subject_tmpname, 'submission/' . $form_exam_subject_name);
        }
        // End of validation

        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_account=:user_account;");
        $stmt->bindParam(':user_account', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $exam_participant_id = $result['user_id'];

        $stmt = $conn->prepare("SELECT * FROM Exams WHERE exam_id=:exam_id;");
        $stmt->bindParam(':exam_id', $form_exam_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $exam_list_id = $result['exam_participant_list_id'];

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $current_timestamp = date('Y-m-d H:i:s');
        $stmt = $conn->prepare("UPDATE ParticipantList SET exam_submission=:exam_submission, participant_submit_date=:participant_submit_date WHERE list_id=:list_id AND participant_id=:participant_id;");
        $stmt->bindParam(':exam_submission', $form_exam_subject_name);
        $stmt->bindParam(':participant_submit_date', $current_timestamp);
        $stmt->bindParam(':list_id', $exam_list_id);
        $stmt->bindParam(':participant_id', $exam_participant_id);
        $stmt->execute();

        $_SESSION['add-item-success'] = "true";

        header('Location: exam-detail-for-students.php', true, 301);
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
        <title>Exam Detail - Student Management System</title>
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
                        <h1 class="mt-4"><?php echo "$show_exam_title"; ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="manage-exams.php">Manage Exams</a></li>
                            <li class="breadcrumb-item active">Exam Detail</li>
                        </ol>
                        <hr>
                        <h3>Description</h3>
                        <div class="d-flex justify-content-between align-items-center" style="width: 50%;">
                            <div>
                                <div class="d-flex align-items-center">
                                    <p>Creator:&nbsp</p>
                                    <p><a href="user-profile.php?username=<?php echo "$show_exam_creator_username"; ?>" style="text-decoration: none;"><?php echo "$show_exam_creator_name"; ?></a></p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p>Class:&nbsp</p>
                                    <p><?php echo "$show_exam_class"; ?></p>
                                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                    <p>Total Students:&nbsp</p>
                                    <p><?php echo "$total_nb_of_students"; ?></p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p style="margin-bottom: 0;">Subject:&nbsp</p>
                                    <p style="margin-bottom: 0;">
                                        <p style="margin-bottom: 0;"><?php echo "$show_exam_subject"; ?></p>
                                        &nbsp(<a href="download.php?path=exams/<?php echo "$show_exam_subject"; ?>">Download</a>)
                                    </p>
                                </div>
                            </div>
                            <div style="border-radius: 5px; background-color: #f2f2f2; padding: 20px;">
                                <div class="d-flex align-items-center;">
                                    <p>Creation Date:&nbsp&nbsp</p>
                                    <p><?php echo "$show_exam_creation_date"; ?></p>
                                </div>
                                <div class="d-flex align-items-center" style="margin-bottom: -20px;">
                                    <p>Expiration Date:&nbsp&nbsp</p>
                                    <p><?php echo "$show_exam_expiration_date"; ?></p>
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
                                    
                                        $tmp = $_SERVER['PHP_SELF'];
                                        echo "
                                            <form action='$tmp' method='POST'  enctype='multipart/form-data'>
                                                <label for='examsubmitfile'>Your Work</label>
                                                <input required='true' type='file' id='examsubmitfile'  accept='.docx, .pdf'  name='examsubmitfile' style='width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;'>

                                                <input type='submit' name='submit' value='Submit' style='background-color: #0d6efd; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;'>
                                            </form>
                                        ";
                                    
                                ?>
                            </div>
                        </div>
                    </div>
                </main>
                <?php
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $current_timestamp = date('Y-m-d H:i:s');
                    if ($current_timestamp < $exam['exam_expiration_date']) {
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
