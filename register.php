<?php
    if (isset($_POST['submit'])) {
        $error = "";
        $emailErrorMsg = "";
        $nameErrorMsg = "";
        $usernameErrorMsg = "";
        $passwordErrorMsg = "";
        $firstname = $_POST["inputFirstName"];
        $lastname = $_POST["inputLastName"];
        $username = $_POST["inputUsername"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm-password"];

        if($firstname == ""){
            $nameErrorMsg = "Please enter your firstname";
        }
        if($firstname == ""){
            $nameErrorMsg = "Please enter your lastname";
        }
        if ($username == ""){
            $usernameErrorMsg = "Please enter your username";
        }
        if($email == ""){
            $emailErrorMsg = "Please enter the email"; 
        } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErrorMsg = "Please enter a valid email";  
        }
        if($confirmPassword == ""){
            $passwordErrorMsg = "Enter confirm password";
        }
        if(strlen($password) < 6){
            $passwordErrorMsg = "Enter a password greater than 6 characters";
        }else if($password != $confirmPassword){
            $passwordErrorMsg = "Password and Confirm Password field should be same";
        }
        if($password == ""){
            $passwordErrorMsg = "Enter your password";
        }

        if ($error == "" && $nameErrorMsg == "" && $usernameErrorMsg == "" && $emailErrorMsg == "" && $passwordErrorMsg == ""){
            include 'config.php';
    
            try {
                $conn = new PDO("mysql:host=$db_servername;port=$db_port;dbname=$db_name", $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $stmt = $conn->prepare("SELECT * FROM Users WHERE user_account = :user_account OR user_email = :user_email");
                $stmt->bindParam(':user_account', $username);
                $stmt->bindParam(':user_email', $email);
                $stmt->execute();

                $result = $stmt->fetchAll();
                $count = count($result);
                
                if ($count > 0) {
                    $error = 'User already exists';
                } else {
                    // begin the transaction
                    $conn->beginTransaction();
                    
                    $password = md5($password);

                    // our SQL statements
                    $conn->exec("INSERT INTO Users (user_firstname, user_lastname, user_email, user_phone_number, user_account, user_password, user_position)
                    VALUES ('$firstname', '$lastname', '$email', 'Not Set', '$username', '$password', 'Student');");
                    
                    // commit the transaction
                    $conn->commit();
                    // echo "New records created successfully";
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    $_SESSION['position'] = 'Student';
                    header('Location: index.php', true, 301);
                }
    
            } catch(PDOException $e) {
                // roll back the transaction if something failed
                $conn->rollback();
                echo "Error: " . $e->getMessage();
            }
            
            $conn = null;
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
        <title>Sign up - Student Management System</title>
        <link href="css/styles2.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content" style="background-color: #212529;">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <form action="<?php $_SERVER['PHP_SEFT'] ?>" method="POST">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputFirstName" name="inputFirstName" type="text" placeholder="Enter your first name" value="<?php if ($firstname!="") {echo $firstname;} ?>"/>
                                                        <label for="inputFirstName">First name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" name="inputLastName" type="text" placeholder="Enter your last name" value="<?php if ($lastname!="") {echo $lastname;} ?>"/>
                                                        <label for="inputLastName">Last name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                if ($nameErrorMsg != "") {
                                                    echo "<p style='margin-bottom: 10px; margin-top: 0px; color: red;'>$nameErrorMsg</p>";
                                                }
                                            ?>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputUsername" type="text" name="inputUsername" placeholder="Enter your username" value="<?php if ($username!="") {echo $username;} ?>"/>
                                                <label for="inputUsername">Username</label>
                                            </div>
                                            <?php
                                                if ($usernameErrorMsg != "") {
                                                    echo "<p style='margin-bottom: 10px; margin-top: 0px; color: red;'>$usernameErrorMsg</p>";
                                                }
                                            ?>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" value="<?php if ($email!="") {echo $email;} ?>"/>
                                                <label for="inputEmail">Email address</label>
                                            </div>
                                            <?php
                                                if ($emailErrorMsg != "") {
                                                    echo "<p style='margin-bottom: 10px; margin-top: 0px; color: red;'>$emailErrorMsg</p>";
                                                }
                                            ?>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Create a password" value="<?php if ($password!="") {echo $password;} ?>"/>
                                                        <label for="inputPassword">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="password" name="confirm-password" placeholder="Confirm password" value="<?php if ($confirmPassword!="") {echo $confirmPassword;} ?>"/>
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                if ($passwordErrorMsg != "") {
                                                    echo "<p style='margin-bottom: 10px; margin-top: 0px; color: red;'>$passwordErrorMsg</p>";
                                                }
                                                if ($error != "") {
                                                    echo "<p style='margin-bottom: 10px; margin-top: 0px; color: red;'>$error</p>";
                                                }
                                            ?>
                                            <div class="mt-4 mb-0">
                                                <button class="d-grid btn btn-primary btn-block" type="submit" name="submit" style="width: 100%;">Create Account</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
        <script src="js/scripts.js"></script>
    </body>
</html>
