<?php
    $error = '';
    
    session_start();
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $position = $_SESSION['position'];
    
    $_SESSION['change-information'] = "false";

    include 'config.php';

    if ($position == "Student") {
        header('Location: 401.html', true, 301);
    }
    
    if ($username == "") {
        header('Location: 404.html', true, 301);
    }
    
    if (isset($_POST['changeclass'])) {
        try {
            $conn = new PDO("mysql:host=$db_servername;port=$db_port;dbname=$db_name", $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $form_class_name = $_POST['form-classname'];
            $form_homeroom_teacher_id = $_POST['form-homeroomteacher'];
            $class_id = $_SESSION['current-class-id'];
            $old_class_homeroom_teacher_id = $_SESSION['old-class-homeroom-teacher-id'];
            
            $stmt = $conn->prepare("SELECT * FROM Classes WHERE class_name=:class_name;");
            $stmt->bindParam(':class_name', $form_class_name);
            $stmt->execute();
            $result = $stmt->fetchAll();

            if (count($result) > 0) {
                if ($form_class_name != $_SESSION['current_class_detail']) {
                    $error = "This class name has been used.";
                }
            }

            if ($error == "") {
                if ($form_homeroom_teacher_id != "") {
                    $stmt = $conn->prepare("UPDATE Classes SET class_name=:class_name, class_homeroom_teacher_id=:class_homeroom_teacher_id WHERE class_id=:class_id;");
                    $stmt->bindParam(':class_name', $form_class_name);
                    $stmt->bindParam(':class_id', $class_id);
                    $stmt->bindParam(':class_homeroom_teacher_id', $form_homeroom_teacher_id);
                } else {
                    $stmt = $conn->prepare("UPDATE Classes SET class_name=:class_name WHERE class_id=:class_id;");
                    $stmt->bindParam(':class_name', $form_class_name);
                    $stmt->bindParam(':class_id', $class_id);
                }
                $stmt->execute();
                if ($form_homeroom_teacher_id != "") {
                    $conn = new PDO("mysql:host=$db_servername;port=$db_port;dbname=$db_name", $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
                    $stmt = $conn->prepare("UPDATE Users SET user_class = NULL WHERE user_id=:user_id;");
                    $stmt->bindParam(':user_id', $old_class_homeroom_teacher_id);
                    $stmt->execute();

                    $stmt = $conn->prepare("UPDATE Users SET user_class = :user_class WHERE user_id=:user_id;");
                    $stmt->bindParam(':user_class', $form_class_name);
                    $stmt->bindParam(':user_id', $form_homeroom_teacher_id);
                    $stmt->execute();
                }
                $class_detail = $form_class_name;
                $_SESSION['current_class_detail'] = $form_class_name;
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

    $class_detail = $_POST['classname'];
    if ($class_detail != "") {
        $_SESSION['current_class_detail'] = $class_detail;
    }

    if ($class_detail == "") {
        $class_detail = $_SESSION['current_class_detail'];
    }

    try {
        $conn = new PDO("mysql:host=$db_servername;port=$db_port;dbname=$db_name", $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT * FROM Classes WHERE class_name = :class_name");
        $stmt->bindParam(':class_name', $class_detail);
        $stmt->execute();

        $result = $stmt->fetch();

        $class_name = $result['class_name'];
        $class_id = $result['class_id'];
        $_SESSION['current-class-id'] = $class_id;
        $class_homeroom_teacher_id = $result['class_homeroom_teacher_id'];
        $_SESSION['old-class-homeroom-teacher-id'] = $class_homeroom_teacher_id;
        $class_creation_date = $result['class_creation_date'];
        $class_creation_date = date_create($class_creation_date);
        $class_creation_date = date_format($class_creation_date, "Y-m-d");
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
        <title>Class Detail - Student Management System</title>
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
                        <h1 class="mt-4">Class <?php echo "$class_name";?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Class Detail</li>
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
                                            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                                                <label for="form-classname">Class Name</label>
                                                <input required="true" value="<?php if ($class_name != "") { echo "$class_name"; } ?>" type="text" id="form-classname" name="form-classname" placeholder="Class Name,  ex: 10A" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <?php
                                                    if ($class_homeroom_teacher_id != "") {
                                                        try {
                                                            $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
                                                            $sql = "SELECT user_firstname, user_lastname FROM Users WHERE user_id=$class_homeroom_teacher_id";
                                                            $result = $conn->query($sql);
                                                            $row = $result->fetch_assoc();
                                                            $class_homeroom_teacher_firstname = $row['user_firstname'];
                                                            $class_homeroom_teacher_lastname = $row['user_lastname'];
                                                            $class_homeroom_teacher_name = $class_homeroom_teacher_firstname . " " . $class_homeroom_teacher_lastname;
                                                        } catch(PDOException $e) {
                                                            echo "Connection failed: " . $e->getMessage();
                                                            header('Location: 500.html', true, 301);
                                                        }
                                                    } else {
                                                        $class_homeroom_teacher_name = "";
                                                    }
                                                ?>

                                                <label for="form-homeroomteacher">Homeroom Teacher</label>
                                                <select id="form-homeroomteacher" name="form-homeroomteacher"  style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                    <?php
                                                        if ($class_homeroom_teacher_name != "") {
                                                            echo "<option selected value='$class_homeroom_teacher_id'>$class_homeroom_teacher_name</option>";
                                                        } else {
                                                            echo "<option selected value=''>Choose Teacher</option>";
                                                        }
                                                        
                                                        $conn = new PDO("mysql:host=$db_servername;port=$db_port;dbname=$db_name", $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                                                        // set the PDO error mode to exception
                                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                                        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_position = 'Teacher' AND user_class IS NOT NULL;");
                                                        $stmt->execute();
                                                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($results as $result) {
                                                            $result_id = $result['user_id'];
                                                            $result_firstname = $result['user_firstname'];
                                                            $result_lastname = $result['user_lastname'];
                                                            $result_name = $result_firstname . " " . $result_lastname;
                                                            $result_class = $result['user_class'];
                                                            
                                                            if ($result_class == "") {
                                                                echo "<option value='$result_id'>$result_name</option>";
                                                            }
                                                        }

                                                        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_position = 'Teacher' AND user_class IS NULL;");
                                                        $stmt->execute();
                                                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        foreach ($results as $result) {
                                                            $result_id = $result['user_id'];
                                                            $result_firstname = $result['user_firstname'];
                                                            $result_lastname = $result['user_lastname'];
                                                            $result_name = $result_firstname . " " . $result_lastname;
                                                            
                                                            echo "<option value='$result_id'>$result_name</option>";
                                                        }
                                                    ?>
                                                </select>

                                                <label for="classcreationdate">Creation Date</label>
                                                <input readonly type="date" value="<?php if ($class_creation_date != "") { echo "$class_creation_date"; } ?>" id="classcreationdate" name="classcreationdate" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <input type="submit" value="Change" name="changeclass" style="background-color: #0d6efd; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
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
