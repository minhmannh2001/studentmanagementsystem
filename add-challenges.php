<?php
    $error = '';
    
    session_start();
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $position = $_SESSION['position'];

    $_SESSION['add-item-success'] = "false";

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

    if (isset($_POST['add'])) {
        $form_challenge_title = $_POST['challengetitle'];
        $form_challenge_description = $_POST['challengedescription'];
        $form_challenge_expiration_date = $_POST['challengeexpirationdate'];

        $stmt_all_students = $conn->prepare("SELECT * FROM Users WHERE user_position = 'Student';");
        $stmt_all_students->execute();
        $students = $stmt_all_students->fetchAll(PDO::FETCH_ASSOC);

        try {         
            $stmt = $conn->prepare("SELECT * FROM Challenges WHERE challenge_title=:challenge_title;");
            $stmt->bindParam(':challenge_title', $form_challenge_title);
            $stmt->execute();
            $result = $stmt->fetchAll();

            if (count($result) > 0) {
                $error = "Duplicate challenge: $form_challenge_title has been created.";
            }

            if ($error == "") {

                // exam subject
                $form_challenge_content_name = $_FILES["challengecontent"]["name"];
                $form_challenge_content_size = $_FILES["challengecontent"]["size"];
                $form_challenge_content_tmpname = $_FILES["challengecontent"]["tmp_name"];
                // Validate exam content
                $valid_challenge_content_extension = ["docx", "pdf"];
                $form_challenge_content_extension = explode('.', $form_challenge_content_name);
                $form_challenge_content_extension = strtolower(end($form_challenge_content_extension));

                if (!in_array($form_challenge_content_extension, $valid_challenge_content_extension)) {
                    echo "
                        <script> alert('Invalid file extension.') </script>
                    ";
                } else if ($form_exam_subject_size > 100000) {
                    echo "
                        <script> alert('File size is too large.') </script>
                    ";
                } else {
                    $challenge_object_unique = uniqid();
                    $form_challenge_content_name = $challenge_object_unique . '-' . $form_challenge_content_name;
                    move_uploaded_file($form_challenge_content_tmpname, 'challenges/' . $form_challenge_content_name);
                }
                // End of validation

                $stmt = $conn->prepare("SELECT * FROM ParticipantList ORDER BY list_id DESC;");
                $stmt->execute();
                $results = $stmt->fetchAll();

                if (count($results) == 0) {
                    $new_list_id = 0;
                } else {
                    foreach ($results as $result) {
                        $new_list_id = $result['list_id'] + 1;
                        break;
                    }
                }

                $stmt_add_user = $conn->prepare("SELECT * FROM Users WHERE user_position = 'Student';");
                $stmt_add_user->execute();
                $students = $stmt_add_user->fetchAll(PDO::FETCH_ASSOC);

                foreach ($students as $student) {
                    $student_id = $student['user_id'];
                    $stmt_insert_user_to_participant_list = $conn->prepare("INSERT INTO ParticipantList (list_id, participant_id)
                    VALUES (:list_id, :participant_id);");
                    $stmt_insert_user_to_participant_list->bindParam(':list_id', $new_list_id);
                    $stmt_insert_user_to_participant_list->bindParam(':participant_id', $student_id);
                    $stmt_insert_user_to_participant_list->execute();
                }

                $stmt = $conn->prepare("SELECT * FROM Users WHERE user_account = :user_account;");
                $stmt->bindParam(':user_account', $username);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $form_challenge_creator_id = $result['user_id'];

                $stmt = $conn->prepare("INSERT INTO Challenges (challenge_title, challenge_description, challenge_content, challenge_creator_id, challenge_expiration_date, challenge_no_participants, challenge_participant_list_id)
                VALUES (:challenge_title, :challenge_description, :challenge_content, :challenge_creator_id, :challenge_expiration_date, :challenge_no_participants, :challenge_participant_list_id);");
                $stmt->bindParam(':challenge_title', $form_challenge_title);
                $stmt->bindParam(':challenge_description', $form_challenge_description);
                $stmt->bindParam(':challenge_content', $form_challenge_content_name);
                $stmt->bindParam(':challenge_creator_id', $form_challenge_creator_id);
                $stmt->bindParam(':challenge_expiration_date', $form_challenge_expiration_date);
                $default_no_participants = 0;
                $stmt->bindParam(':challenge_no_participants', $default_no_participants);
                $stmt->bindParam(':challenge_participant_list_id', $new_list_id);
                $stmt->execute();

                $_SESSION['add-item-success'] = "true";
            }
        }
        catch(PDOException $e) {
            // roll back the transaction if something failed
            $conn->rollback();
            echo "Error: " . $e->getMessage();
            header('Location: 500.html', true, 301);
        }
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
        <title>Add Challenges  - Student Management System</title>
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
                        <h1 class="mt-4">Add Challenges</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Challenges</li>
                        </ol>
                        <?php
                            if ($error != "") {
                                echo "
                                    <p style='color: red;'>$error</p>
                                ";
                            }
                        ?>
                        <div class="row">
                            <div class="col-md-12 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
                                                <label for="challengetitle">Title</label>
                                                <input  value="<?php if ($form_challenge_title != "" and $_SESSION['add-item-success'] == "false") { echo "$form_challenge_title"; } ?>" required="true" type="text" id="challengetitle" name="challengetitle" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="challengedescription">Description</label>
                                                <textarea value="<?php if ($form_challenge_description != "" and $_SESSION['add-item-success'] == "false") { echo "$form_challenge_description"; } ?>" required="true" placeholder="Write something..." id="challengedescription" name="challengedescription" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;"></textarea>                                     

                                                <label for="challengecontent">Content</label>
                                                <input required="true" type="file" id="challengecontent" accept=".docx, .pdf" name="challengecontent" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="challengeexpirationdate">Expiration Date</label>
                                                <input value="<?php if ($form_challenge_expiration_date != "" and $_SESSION['add-item-success'] == "false") { echo "$form_challenge_expiration_date"; } ?>" type="date" id="challengeexpirationdate" name="challengeexpirationdate" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <input type="submit" value="Add" name="add" style="background-color: #0d6efd; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </main>
                <div id="snackbar">Add new challenge successfully.</div>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Student Management System 2022</div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
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
