<?php
    $error = '';
    
    session_start();
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $position = $_SESSION['position'];
    
    $_SESSION['change-information'] = "false";

    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "test";

    try {
        $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_account = :user_account OR user_email = :user_email");
        $stmt->bindParam(':user_account', $user_account);
        $stmt->bindParam(':user_email', $user_email);
        $stmt->execute();

        $result = $stmt->fetchAll();
        $count = count($result);
        
        if ($count > 0) {
            $error = 'User already exists';
            // echo "<script> alert('User already exists.') </script>";
        }

        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_phone_number = :user_phone_number");
        $stmt->bindParam(':user_phone_number', $user_phone_number);
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

    if (isset($_POST['submit'])) {
        $user_firstname = $_POST['userfirstname'];
        $user_lastname = $_POST['userlastname'];
        $user_email = $_POST['useremail'];
        $user_phone_number = $_POST['userphone'];
        $user_class = $_POST['userclass'];
        $user_gender = $_POST['usergender'];
        $user_date_of_birth = $_POST['userdob'];
        // user photo
        $user_photo_name = $_FILES["userphoto"]["name"];
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
        // End of validation
        $user_account = $_POST['useraccount'];
        $user_password = $_POST['userpassword'];
        $user_password = md5($user_password);

        try {
            $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $conn->prepare("SELECT * FROM Users WHERE user_account = :user_account OR user_email = :user_email");
            $stmt->bindParam(':user_account', $user_account);
            $stmt->bindParam(':user_email', $user_email);
            $stmt->execute();

            $result = $stmt->fetchAll();
            $count = count($result);
            
            if ($count > 0) {
                $error = 'User already exists';
                // echo "<script> alert('User already exists.') </script>";
            }

            $stmt = $conn->prepare("SELECT * FROM Users WHERE user_phone_number = :user_phone_number");
            $stmt->bindParam(':user_phone_number', $user_phone_number);
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
            $stmt->bindParam(':user_firstname', $user_firstname);
            $stmt->bindParam(':user_lastname', $user_lastname);
            $stmt->bindParam(':user_email', $user_email);
            $stmt->bindParam(':user_phone_number', $user_phone_number);
            $stmt->bindParam(':user_class', $user_class);
            $stmt->bindParam(':user_gender', $user_gender);
            $stmt->bindParam(':user_date_of_birth', $user_date_of_birth);
            $stmt->bindParam(':user_photo', $user_photo_newname);
            $stmt->bindParam(':user_account', $user_account);
            $stmt->bindParam(':user_password', $user_password);
            $user_position = 'user';
            $stmt->bindParam(':user_position', $user_position);
            $stmt->execute();

            $user_firstname = "";
            $user_lastname = "";
            $user_email = "";
            $user_phone_number = "";
            $user_account = "";

            $_SESSION['change-information'] = "true";
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
        <title>Dashboard - user Management System</title>
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
                        <h1 class="mt-4">Add users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
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
                                                <input value="<?php if ($user_firstname!="") {echo $user_firstname;} ?>" required="true" type="text" id="userfirstname" name="userfirstname" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                
                                                <label for="userlastname">Last Name</label>
                                                <input value="<?php if ($user_lastname!="") {echo $user_lastname;} ?>" required="true" type="text" id="userlastname" name="userlastname" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                
                                                <label for="useremail">Email</label>
                                                <input value="<?php if ($user_email!="") {echo $user_email;} ?>" type="text" id="useremail" name="useremail" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="userphone">Phone Number</label>
                                                <input value="<?php if ($user_phone_number!="") {echo $user_phone_number;} ?>" type="text" id="userphone" name="userphone" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="userclass">Class</label>
                                                <select id="userclass" name="userclass"  style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
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

                                                <label for="usergender">Gender</label>
                                                <select required="true" id="usergender" name="usergender"  style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                    <option value="">Choose Gender</option>    
                                                    <option value="male">Male</option>
                                                    <option value="famale">Female</option>
                                                </select>
                                                
                                                <label for="userdob">Date Of Birth</label>
                                                <input type="date" id="userdob" name="userdob" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="userphoto">user Photo</label>
                                                <input required="true" type="file" id="userphoto" name="userphoto" accept=".jpg, .jpeg, .png" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <h4 style="margin-bottom: 15px;">Login Details</h4>

                                                <label for="useraccount">Account</label>
                                                <input value="<?php if ($user_account!="") {echo $user_account;} ?>" required="true" type="text" id="useraccount" name="useraccount" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="userpassword">Password</label>
                                                <input required="true" type="password" id="userpassword" name="userpassword" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <input type="submit" value="Add" name="submit" style="background-color: #0d6efd; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
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
