<?php
    if (isset($_POST['submit'])) {
        $error = "";
        $emailErrorMsg = "";
        $passwordErrorMsg = "";
        $email = $_POST["inputEmail"];
        $password = $_POST["inputPassword"];
        $_password = $password;

        if($email == ""){
            $emailErrorMsg = "Please enter the email or username"; 
        }
        if(strlen($password) < 6){
            $passwordErrorMsg = "Password must be at least 6 characters";
        }
        if($password == ""){
            $passwordErrorMsg = "Please enter your password";
        }

        if ($error == "" && $emailErrorMsg == "" && $passwordErrorMsg == ""){
            $db_servername = "localhost";
            $db_username = "root";
            $db_password = "";
            $db_name = "test";
    
            try {
                $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $password = md5($password);

                $stmt = $conn->prepare("SELECT * FROM Users WHERE (user_account = :user_account OR user_email = :user_email) AND user_password = :user_password");
                $stmt->bindParam(':user_account', $email);
                $stmt->bindParam(':user_email', $email);
                $stmt->bindParam(':user_password', $password);
                $stmt->execute();

                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $position = $result['user_position'];
                $username = $result['user_account'];
                $email = $result['user_email'];

                if ($result) {
                    session_start();

                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    $_SESSION['position'] = $position;
                    
                    header('Location: index.php', true, 301);

                } else {
                    $error = 'Invalid username, email or password';
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
        <title>Login - Student Management System</title>
        <link href="css/styles2.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content" style="background-color: #212529;">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
                                        <form action="<?php $_SERVER['PHP_SEFT']?>" method='POST'>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="text" name="inputEmail" placeholder="name@example.com" value="<?php if ($email!="") {echo $email;} ?>"/>
                                                <label for="inputEmail">Email address or Username</label>
                                            </div>
                                            <?php
                                                if ($emailErrorMsg != "") {
                                                    echo "<p style='margin-bottom: 10px; margin-top: 0px; color: red;'>$emailErrorMsg</p>";
                                                }
                                            ?>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="inputPassword" placeholder="Password" value="<?php if ($_password!="") {echo $_password;} ?>"/>
                                                <label for="inputPassword">Password</label>
                                            </div>
                                            <?php
                                                if ($passwordErrorMsg != "") {
                                                    echo "<p style='margin-bottom: 10px; margin-top: 0px; color: red;'>$passwordErrorMsg</p>";
                                                }
                                                if ($error != "") {
                                                    echo "<p style='margin-bottom: 10px; margin-top: 0px; color: red;'>$error</p>";
                                                }
                                            ?>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" name="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Forgot Password?</a>
                                                <button class="btn btn-primary" type="submit" name="submit">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
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
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
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
