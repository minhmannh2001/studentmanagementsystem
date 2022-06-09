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
        $form_exam_title = $_POST['examtitle'];
        $form_exam_class = $_POST['examclass'];
        $form_exam_expiration_date = $_POST['examexpirationdate'];
        

        $stmt_add_user = $conn->prepare("SELECT * FROM Users WHERE user_class = :user_class AND user_position = 'Student';");
        $stmt_add_user->bindParam(':user_class', $form_exam_class);
        $stmt_add_user->execute();
        $students = $stmt_add_user->fetchAll(PDO::FETCH_ASSOC);

        if (count($students) == 0) {
            $error = "There is no students in class $form_exam_class";
        }

        try {         
            $stmt = $conn->prepare("SELECT * FROM Exams WHERE exam_title=:exam_title AND exam_class=:exam_class;");
            $stmt->bindParam(':exam_title', $form_exam_title);
            $stmt->bindParam(':exam_class', $form_exam_class);
            $stmt->execute();
            $result = $stmt->fetchAll();

            if (count($result) > 0) {
                $error = "Duplicate exam: $form_exam_title has been created for class $form_exam_class.";
            }

            if ($error == "") {

                // exam subject
                $form_exam_subject_name = $_FILES["examsubject"]["name"];
                $form_exam_subject_size = $_FILES["examsubject"]["size"];
                $form_exam_subject_tmpname = $_FILES["examsubject"]["tmp_name"];
                // Validate exam subject
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
                    move_uploaded_file($form_exam_subject_tmpname, 'exams/' . $form_exam_subject_name);
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

                $stmt_add_user = $conn->prepare("SELECT * FROM Users WHERE user_class = :user_class AND user_position = 'Student';");
                $stmt_add_user->bindParam(':user_class', $form_exam_class);
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
                $form_exam_creator_id = $result['user_id'];

                $stmt = $conn->prepare("INSERT INTO Exams (exam_title, exam_class, exam_subject, exam_creator_id, exam_expiration_date, exam_participant_list_id)
                VALUES (:exam_title, :exam_class, :exam_subject, :exam_creator_id, :exam_expiration_date, :exam_participant_list_id);");
                $stmt->bindParam(':exam_title', $form_exam_title);
                $stmt->bindParam(':exam_class', $form_exam_class);
                $stmt->bindParam(':exam_subject', $form_exam_subject_name);
                $stmt->bindParam(':exam_creator_id', $form_exam_creator_id);
                $stmt->bindParam(':exam_expiration_date', $form_exam_expiration_date);
                $stmt->bindParam(':exam_participant_list_id', $new_list_id);
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
        <title>Add Exams - Student Management System</title>
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
                        <h1 class="mt-4">Add Exams</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Exams</li>
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
                                            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                                                <label for="examtitle">Title</label>
                                                <input value="<?php if ($form_exam_title != "" and $_SESSION['add-item-success'] == "false") { echo "$form_exam_title"; } ?>" required="true" type="text" id="examtitle" name="examtitle" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                            
                                                <label for="examclass">Class</label>
                                                <select required="true" id="examclass" name="examclass"  style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                    <option value="">Choose Class</option>
                                                    <option value='all'>All</option>
                                                    <?php
                                                        $stmt = $conn->prepare("SELECT * FROM Classes WHERE class_homeroom_teacher_id IS NOT NULL;");
                                                        $stmt->execute();
                                                        $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($classes as $class) {
                                                            $class_name = $class['class_name'];
                                                            if ($class_name == $form_exam_class and $_SESSION['add-item-success'] == "false") {
                                                                echo "<option value='$class_name' selected>$class_name</option>";
                                                            } else {
                                                                echo "<option value='$class_name'>$class_name</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                
                                                <label for="examsubject">Subject</label>
                                                <input required="true" type="file" id="examsubject"  accept=".docx, .pdf"  name="examsubject" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="examexpirationdate">Expiration Date</label>
                                                <input  value="<?php if ($form_exam_expiration_date != "" and $_SESSION['add-item-success'] == "false") { echo "$form_exam_expiration_date"; } ?>" type="date" id="examexpirationdate" name="examexpirationdate" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <input type="submit" value="Add" name="add" style="background-color: #0d6efd; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </main>
                <div id="snackbar">Add new exam successfully.</div>
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
