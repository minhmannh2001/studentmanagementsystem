<?php
    $warning = '';
    
    session_start();
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $position = $_SESSION['position'];
    
    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "test";

    $user_profile = $_GET['username'];

    try {
        $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $password = md5($password);

        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_account = :user_account OR user_email = :user_email");
        if ($user_profile == '') {
            $stmt->bindParam(':user_account', $username);
            $stmt->bindParam(':user_email', $email);
        } else {
            $email_profile = 'random';
            $stmt->bindParam(':user_account', $user_profile);
            $stmt->bindParam(':user_email', $email_profile);
        }
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $user_id = $result['user_id'];
            $user_account = $result['user_account'];
            $user_firstname = $result['user_firstname'];
            $user_lastname = $result['user_lastname'];
            $user_class = $result['user_class'];
            $user_gender = $result['user_gender'];
            $user_date_of_birth = $result['user_date_of_birth'];
            $user_phone_number = $result['user_phone_number'];
            $user_position = $result['user_position'];
            $user_email = $result['user_email'];
            if ($user_class == 'Not Set' or $user_date_of_birth == 'Not Set' or $user_gender == 'Not Set' or $user_phone_number == 'Not Set' and $user_profile == '') {
                $warning = 'You need to provide enough information to use full functionalities of application.';
            }
        } else {
            header('Location: 500.html', true, 301);
        }
    } catch(PDOException $e) {
        // roll back the transaction if something failed
        $conn->rollback();
        echo "Error: " . $e->getMessage();
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
        <title>Dashboard - Student Management System</title>
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
                        <h1 class="mt-4">User Profile</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ol>
                        <div class="row">
                            <div class="col-md-12 grid-margin">
                                <div class="card" style="margin-bottom: 30px;">
                                    <div class="card-body d-flex">
                                        <img src="https://dummyimage.com/300x400/343a40/6c757d" alt="">
                                        <div class="d-flex flex-column" style="margin-left: 50px;">
                                            <div class="d-flex flex-column" style="background-color: #15395a; padding: 20px 30px; border-radius: 5px; margin-bottom: 20px;">
                                                <h3 style="color: white;"><?php echo "$user_firstname" . " " . "$user_lastname" ?></h3>
                                                <strong style="color: #ceaa4d;"><?php echo "$user_position" ?></strong>
                                            </div>
                                            <div>
                                                <div class="d-flex">
                                                    <b>ID:&nbsp</b>
                                                    <p><?php echo "$user_id" ?></p>
                                                </div>
                                                <div class="d-flex">
                                                    <b>Username:&nbsp</b>
                                                    <p><?php echo "$user_account"; ?></p>
                                                </div>
                                                <div class="d-flex">
                                                    <b>Position:&nbsp</b>
                                                    <p><?php echo "$user_position" ?></p>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="d-flex">
                                                        <b>Class:&nbsp</b>
                                                        <p>
                                                            <?php if ($user_class != '') {
                                                                echo "$user_class";
                                                            } else {
                                                                echo 'Not Set';
                                                            }
                                                            ?>
                                                        </p>
                                                    </div>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <div class="d-flex">
                                                        <b>Gender:&nbsp</b>
                                                        <p>
                                                            <?php if ($user_gender != '') {
                                                                echo "$user_gender";
                                                            } else {
                                                                echo 'Not Set';
                                                            }
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="d-flex">
                                                    <b>Date Of Birth:&nbsp</b>
                                                    <p>
                                                        <?php if ($user_date_of_birth != '') {
                                                            echo "$user_date_of_birth";
                                                        } else {
                                                            echo 'Not Set';
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                                <div class="d-flex">
                                                    <b>Email:&nbsp</b>
                                                    <p>
                                                        <?php echo "$user_email" ?>
                                                    </p>
                                                </div>
                                                <div class="d-flex">
                                                    <b>Phone Number:&nbsp</b>
                                                    <p><?php echo "$user_phone_number" ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    if ($warning != '') {
                                        echo "<p style='color: red;'>$warning</p>";
                                    }
                                ?>
                                <a href="user-detail.php" style="text-decoration: none; background-color: #0d6efd; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Change Information</a>
                                <?php
                                    if ($user_profile != "") {
                                        echo '<form action="">
                                            <label for="message" style="margin-top: 20px;"><h5>Write message:</h5></label>
                                            <textarea required="true" placeholder="Write something..." id="message" name="message" style="width: 99%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;"></textarea>                                     
                                            <input type="submit" value="Send" style="background-color: #0d6efd; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; margin-bottom: 15px;">
                                        </form>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </main>
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
    </body>
</html>
