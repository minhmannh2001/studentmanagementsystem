<?php
    $error = '';
    
    session_start();
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $position = $_SESSION['position'];
    
    $_SESSION['change-information'] = "false";
    
    include 'config.php';

    if ($username == "") {
        header('Location: 404.html', true, 301);
    }
    
    $user_detail = $_POST['user_username'];
    if ($user_detail != "") {
        $_SESSION['current_user_detail'] = $user_detail;
    }
    if ($user_detail == "") {
        $user_detail = $_POST['useraccount'];
            if ($user_detail != "") {
                $_SESSION['current_user_detail'] = $user_detail;
            }
    }

    if ($user_detail == "") {
        $user_detail = $_SESSION['current_user_detail'];
    }

    $current_username = $_POST['username'];
    if ($current_username == "") {
        $current_username = $username;
    }

    $allow_change = false;

    if ($user_detail == $current_username) {
        $allow_change = true;
    } else if ($position == 'Teacher') {
        $allow_change = true;
    }

    try {
        $conn = new PDO("mysql:host=$db_servername;port=$db_port;dbname=$db_name", $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_account = :user_account");
        $stmt->bindParam(':user_account', $user_detail);
        $stmt->execute();

        $result = $stmt->fetch();
        
        $user_firstname = $result['user_firstname'];
        $user_lastname = $result['user_lastname'];
        $user_id = $result['user_id'];
        $user_class = $result['user_class'];
        $user_account = $result['user_account'];
        if ($result['user_class'] == '') {
            $user_class = 'Not Set';
        }
        $user_email = $result['user_email'];
        $user_gender = $result['user_gender'];
        $user_password = $result['user_password'];
        $user_position = $result['user_position'];
        $user_date_of_birth = $result['user_date_of_birth'];
        if ($user_date_of_birth != "") {
            $user_date_of_birth = date_create($user_date_of_birth);
            $user_date_of_birth = date_format($user_date_of_birth, "Y-m-d");
        }
        $user_photo = $result['user_photo'];
        $user_photo_path = "images/" . $user_photo;
    } catch(PDOException $e) {
        // roll back the transaction if something failed
        $conn->rollback();
        echo "Error: " . $e->getMessage();
        header('Location: 500.html', true, 301);
    }

    if (isset($_POST['submit'])) {
        try {

            $user_email = $_POST['useremail'];
            $user_phone_number = $_POST['userphone'];
            $allow_change_class = false;
            if ($position == 'Teacher' or $user_detail == $username) {
                $allow_change_class = true;
            }
            if ($allow_change_class) {
                $user_class = $_POST['userclass'];
            } else {
                $user_class = "";
            }
            $user_gender = $_POST['usergender'];
            $user_date_of_birth = $_POST['userdob'];
            // user photo
            $user_photo_name = $_FILES["userphoto"]["name"];
            if ($user_photo_name != "") {
                $user_photo_size = $_FILES["userphoto"]["size"];
                $user_photo_tmpname = $_FILES["userphoto"]["tmp_name"];
                // Validate image
                $valid_image_extension = ["jpg", "jpeg", "png"];
                $user_photo_extension = explode('.', $user_photo_name);
                $user_photo_extension = strtolower(end($user_photo_extension));
    
                if (!in_array($user_photo_extension, $valid_image_extension)) {
                    echo "
                        <script> alert('Invalid image extension.') </script>
                    ";
                    echo "<script> console.log($user_photo_extension); </script>";
                } else if ($user_photo_size > 100000) {
                    echo "
                        <script> alert('Image size is too large.') </script>
                    ";
                } else {
                    $user_photo_newname = uniqid();
                    $user_photo_newname = $user_photo_newname . '.' . $user_photo_extension;
    
                    if (move_uploaded_file($user_photo_tmpname, 'images/' . $user_photo_newname)) {
                        // echo "<script> alert('Upload success.') </script>";
                    } else {
                        // echo "<script> alert('Upload fail.') </script>";
                    }
                }
            } else {
                $user_photo_newname = "";
            }
            // End of validation
            $user_newpassword = $_POST['userpassword'];
            $user_raw_newpassword = $user_newpassword;
            $user_newpassword = md5($user_newpassword);

            $user_confirm_newpassword = $_POST['userconfirmpassword'];
            $user_confirm_newpassword = md5($user_confirm_newpassword);

            if ($user_raw_newpassword != "") {
                if ($user_password == $user_newpassword) {
                    $error = "Password is the same.";
                } else if ($user_newpassword != $user_confirm_newpassword) {
                    $error = "Password and Confirm Password field should be same.";
                }
                if (strlen($user_raw_newpassword) < 6) {
                    $error = "Enter a password greater than 6 characters";
                }
            }

            if ($error == "") {
                if ($user_date_of_birth != "") {
                    $stmt = $conn->prepare("UPDATE Users SET user_email=:user_email, user_phone_number=:user_phone_number, user_gender=:user_gender, user_photo=:user_photo, user_date_of_birth=:user_date_of_birth, user_class=:user_class, user_password=:user_password  WHERE user_account=:user_account;");
                    $stmt->bindParam(':user_email', $user_email);
                    $stmt->bindParam(':user_phone_number', $user_phone_number);
                    $stmt->bindParam(':user_gender', $user_gender);
                    $stmt->bindParam(':user_photo', $user_photo_newname);
                    $stmt->bindParam(':user_date_of_birth', $user_date_of_birth);
                    $stmt->bindParam(':user_class', $user_class);
                    $stmt->bindParam(':user_password', $user_password);
                    $stmt->bindParam(':user_account', $user_detail);
                    $stmt->execute();
                }
                else {
                    $stmt = $conn->prepare("UPDATE Users SET user_email=:user_email, user_phone_number=:user_phone_number, user_gender=:user_gender, user_photo=:user_photo, user_class=:user_class, user_password=:user_password  WHERE user_account=:user_account;");
                    $stmt->bindParam(':user_email', $user_email);
                    $stmt->bindParam(':user_phone_number', $user_phone_number);
                    $stmt->bindParam(':user_gender', $user_gender);
                    $stmt->bindParam(':user_photo', $user_photo_newname);
                    $stmt->bindParam(':user_class', $user_class);
                    $stmt->bindParam(':user_password', $user_password);
                    $stmt->bindParam(':user_account', $user_detail);
                    $stmt->execute();

                    $stmt = $conn->prepare("UPDATE Users SET user_date_of_birth = NULL WHERE user_account=:user_account;");
                    $stmt->bindParam(':user_account', $user_detail);
                    $stmt->execute();
                }

                $old_classname = $_SESSION['old-classname'];
                
                if ($user_class != "" and $user_class != $old_classname) {
                    $stmt = $conn->prepare("UPDATE Classes SET class_homeroom_teacher_id=NULL WHERE class_name=:class_name;");
                    $stmt->bindParam(':class_name', $old_classname);
                    $stmt->execute();

                    $stmt = $conn->prepare("UPDATE Classes SET class_homeroom_teacher_id=:class_homeroom_teacher_id WHERE class_name=:class_name;");
                    $stmt->bindParam(':class_homeroom_teacher_id', $user_id);
                    $stmt->bindParam(':class_name', $user_class);
                    $stmt->execute();
                }

                $_SESSION['change-information'] = "true";
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
        <title>User Detail - Student Management System</title>
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
                        <h1 class="mt-4"><?php echo "$user_firstname $user_lastname"; ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <?php 
                                if ($user_position == "Teacher") {
                                    echo "<li class='breadcrumb-item'><a href='manage-teachers.php'>Manage Teachers</a></li>";
                                } else {
                                    echo "<li class='breadcrumb-item'><a href='manage-students.php'>Manage Students</a></li>";
                                }
                            ?>
                            
                            <li class="breadcrumb-item active">Change Information</li>
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
                                                <label for="userfirstname">First Name</label>
                                                <input readonly value="<?php if ($user_firstname!="") {echo $user_firstname;} ?>" type="text" id="userfirstname" name="userfirstname" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                
                                                <label for="userlastname">Last Name</label>
                                                <input readonly value="<?php if ($user_lastname!="") {echo $user_lastname;} ?>" type="text" id="userlastname" name="userlastname" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                
                                                <label for="useremail">Email</label>
                                                <input value="<?php if ($user_email!="") {echo $user_email;} ?>" type="text" id="useremail" name="useremail" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="userphone">Phone Number</label>
                                                <input value="<?php if ($user_phone_number!="") {echo $user_phone_number;} ?>" type="text" id="userphone" name="userphone" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="userclass">Class</label>
                                                <?php 
                                                    $allow_change_class = false;
                                                    if ($position == 'Teacher' or $user_detail == $username) {
                                                        $allow_change_class = true;
                                                    }
                                                ?>
                                                <select <?php if (!$allow_change_class) { echo 'readonly'; } ?> id="userclass" name="userclass"  style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                    <option value="">Choose Class</option>
                                                    <?php
                                                        if ($user_position == "Student") {
                                                            $stmt = $conn->prepare("SELECT * FROM Classes WHERE class_homeroom_teacher_id IS NOT NULL;");
                                                        } else {
                                                            $stmt = $conn->prepare("SELECT * FROM Classes WHERE class_homeroom_teacher_id IS NULL OR class_homeroom_teacher_id=:class_homeroom_teacher_id;");
                                                            $stmt->bindParam(':class_homeroom_teacher_id', $user_id);
                                                        }
                                                        $stmt->execute();
                                                        $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($classes as $class) {
                                                            $class_name = $class['class_name'];
                                                            $allow_change_class = false;
                                                            if ($position == 'Teacher' or $user_detail == $username) {
                                                                $allow_change_class = true;
                                                            }
                                                            if ($class_name == $user_class) {
                                                                if ($allow_change_class) {
                                                                    $_SESSION['old-classname'] = $class_name;
                                                                    echo "<option value='$class_name' selected>$class_name</option>";
                                                                } else {
                                                                    echo "<option value='$class_name' disabled selected>$class_name</option>";
                                                                }
                                                            } else {
                                                                if ($allow_change_class) {
                                                                    echo "<option value='$class_name' >$class_name</option>";
                                                                } else {
                                                                    echo "<option value='$class_name' disabled>$class_name</option>";
                                                                }
                                                            }
                                                        }
                                                    ?>
                                                </select>

                                                <label for="usergender">Gender</label>
                                                <select id="usergender" name="usergender"  style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                    <option value="">Choose Gender</option>
                                                    <?php
                                                        if ($user_gender == "Male") {
                                                            echo "<option value='Male' selected>Male</option>";
                                                        }
                                                        else {
                                                            echo "<option value='Male' >Male</option>";
                                                        }
                                                        if ($user_gender == "Female") {
                                                            echo "<option value='Female' selected>Female</option>";
                                                        }
                                                        else {
                                                            echo "<option value='Female' >Female</option>";
                                                        }
                                                    ?>
                                                </select>
                                                
                                                <label for="userdob">Date Of Birth</label>
                                                <input value="<?php if ($user_date_of_birth) { echo "$user_date_of_birth";} ?>" type="date" id="userdob" name="userdob" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                

                                                
                                                <?php
                                                    if ($user_photo_path == "images/" and $change_information == "false") {
                                                        echo "<label for='userphoto'>User Photo (<b>Not Set</b>)</label>";
                                                    } else {
                                                        echo "<label for='userphoto'>New Photo</label>";
                                                    }
                                                ?>
                                                <input type="file" id="userphoto" name="userphoto" accept=".jpg, .jpeg, .png" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <h4 style="margin-bottom: 15px;">Login Details</h4>

                                                <label for="useraccount">Account</label>
                                                <input readonly value="<?php if ($user_account!="") {echo $user_account;} ?>" type="text" id="useraccount" name="useraccount" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                
                                                <label for="userpassword">Password</label>
                                                <input type="password" id="userpassword" name="userpassword" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                
                                                <label for="userconfirmpassword">Confirm Password</label>
                                                <input type="password" id="userconfirmpassword" name="userconfirmpassword" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                
                                                <?php
                                                    if ($allow_change) {
                                                        echo "
                                                        <input type='submit' value='Update' name='submit' style='background-color: #0d6efd; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;'>
                                                        ";
                                                    }
                                                ?>
                                                
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </main>
                <div id="snackbar">Change information successfully.</div>
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
                $change_information = $_SESSION['change-information'];
                if ($change_information == "true") {
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
