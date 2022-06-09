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
    
    if (isset($_POST['submit'])) {
        $student_firstname = $_POST['studentfirstname'];
        $student_lastname = $_POST['studentlastname'];
        $student_email = $_POST['studentemail'];
        $student_phone_number = $_POST['studentphone'];
        $student_class = $_POST['studentclass'];
        $student_gender = $_POST['studentgender'];
        $student_date_of_birth = $_POST['studentdob'];
        // student photo
        $student_photo_name = $_FILES["studentphoto"]["name"];
        $student_photo_size = $_FILES["studentphoto"]["size"];
        $student_photo_tmpname = $_FILES["studentphoto"]["tmp_name"];
        // Validate image
        $valid_image_extension = ["jpg", "jpeg", "png"];
        $student_photo_extension = explode('.', $student_photo_name);
        $student_photo_extension = strtolower(end($student_photo_extension));

        if (!in_array($student_photo_extension, $valid_image_extension)) {
            echo "
                <script> alert('Invalid image extension.') </script>
            ";
            echo "<script> console.log($student_photo_extension); </script>";
        } else if ($student_photo_size > 100000) {
            echo "
                <script> alert('Image size is too large.') </script>
            ";
        } else {
            $student_photo_newname = uniqid();
            $student_photo_newname = $student_photo_newname . '.' . $student_photo_extension;

            if (move_uploaded_file($student_photo_tmpname, 'images/' . $student_photo_newname)) {
                // echo "<script> alert('Upload success.') </script>";
            } else {
                // echo "<script> alert('Upload fail.') </script>";
            }
        }
        // End of validation
        $student_account = $_POST['studentaccount'];
        $student_password = $_POST['studentpassword'];
        $student_password = md5($student_password);

        try {
            $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $conn->prepare("SELECT * FROM Users WHERE user_account = :student_account OR user_email = :student_email");
            $stmt->bindParam(':student_account', $student_account);
            $stmt->bindParam(':student_email', $student_email);
            $stmt->execute();

            $result = $stmt->fetchAll();
            $count = count($result);
            
            if ($count > 0) {
                $error = 'User already exists';
                // echo "<script> alert('User already exists.') </script>";
            }

            $stmt = $conn->prepare("SELECT * FROM Users WHERE user_phone_number = :student_phone_number");
            $stmt->bindParam(':student_phone_number', $student_phone_number);
            $stmt->execute();

            $result = $stmt->fetchAll();
            $count = count($result);
            
            if ($count > 0) {
                $error = 'This phone number has been used.';
                // echo "<script> alert('This phone number has been used.') </script>";
            }

        } catch(PDOException $e) {
            // roll back the transaction if something failed
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
    }
    
    try {
        $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['submit']) and $error=="") {
            $stmt = $conn->prepare("INSERT INTO Users (user_firstname, user_lastname, user_email, user_phone_number, user_class, user_gender, user_date_of_birth, user_photo, user_account, user_password, user_position) 
            VALUES (:user_firstname, :user_lastname, :user_email, :user_phone_number, :user_class, :user_gender, :user_date_of_birth, :user_photo, :user_account, :user_password, :user_position)");
            $stmt->bindParam(':user_firstname', $student_firstname);
            $stmt->bindParam(':user_lastname', $student_lastname);
            $stmt->bindParam(':user_email', $student_email);
            $stmt->bindParam(':user_phone_number', $student_phone_number);
            $stmt->bindParam(':user_class', $student_class);
            $stmt->bindParam(':user_gender', $student_gender);
            $stmt->bindParam(':user_date_of_birth', $student_date_of_birth);
            $stmt->bindParam(':user_photo', $student_photo_newname);
            $stmt->bindParam(':user_account', $student_account);
            $stmt->bindParam(':user_password', $student_password);
            $student_position = 'Student';
            $stmt->bindParam(':user_position', $student_position);
            $stmt->execute();

            $student_firstname = "";
            $student_lastname = "";
            $student_email = "";
            $student_phone_number = "";
            $student_account = "";

            $_SESSION['add-item-success'] = "true";
        }

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
        <title>Add Students - Student Management System</title>
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
                        <h1 class="mt-4">Add Students</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="manage-students.php">Manage Students</a></li>
                            <li class="breadcrumb-item active">Add Students</li>
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
                                            <form action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method="POST">
                                                <label for="studentfirstname">First Name</label>
                                                <input value="<?php if ($student_firstname!="") {echo $student_firstname;} ?>" required="true" type="text" id="studentfirstname" name="studentfirstname" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                
                                                <label for="studentlastname">Last Name</label>
                                                <input value="<?php if ($student_lastname!="") {echo $student_lastname;} ?>" required="true" type="text" id="studentlastname" name="studentlastname" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                
                                                <label for="studentemail">Email</label>
                                                <input value="<?php if ($student_email!="") {echo $student_email;} ?>" type="text" id="studentemail" name="studentemail" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="studentphone">Phone Number</label>
                                                <input value="<?php if ($student_phone_number!="") {echo $student_phone_number;} ?>" type="text" id="studentphone" name="studentphone" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="studentclass">Class</label>
                                                <select id="studentclass" name="studentclass"  style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                    <option value="">Choose Class</option>
                                                    <?php
                                                        $stmt = $conn->prepare("SELECT * FROM Classes WHERE class_homeroom_teacher_id IS NOT NULL;");
                                                        $stmt->execute();
                                                        $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($classes as $class) {
                                                            $class_name = $class['class_name'];
                                                            echo "<option value='$class_name'>$class_name</option>";
                                                        }
                                                    ?>
                                                </select>

                                                <label for="studentgender">Gender</label>
                                                <select required="true" id="studentgender" name="studentgender"  style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                    <option value="">Choose Gender</option>    
                                                    <option value="male">Male</option>
                                                    <option value="famale">Female</option>
                                                </select>
                                                
                                                <label for="studentdob">Date Of Birth</label>
                                                <input type="date" id="studentdob" name="studentdob" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="studentphoto">Student Photo</label>
                                                <input required="true" type="file" id="studentphoto" name="studentphoto" accept=".jpg, .jpeg, .png" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <h4 style="margin-bottom: 15px;">Login Details</h4>

                                                <label for="studentaccount">Account</label>
                                                <input value="<?php if ($student_account!="") {echo $student_account;} ?>" required="true" type="text" id="studentaccount" name="studentaccount" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="studentpassword">Password</label>
                                                <input required="true" type="password" id="studentpassword" name="studentpassword" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <input type="submit" value="Add" name="submit" style="background-color: #0d6efd; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </main>
                <div id="snackbar">Add new student successfully.</div>
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
