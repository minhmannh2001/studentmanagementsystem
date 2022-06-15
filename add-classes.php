<?php
    $error = '';
    
    session_start();
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $position = $_SESSION['position'];

    $_SESSION['add-item-success'] = "false";

    include 'config.php';

    if ($position == "Student") {
        header('Location: 401.html', true, 301);
    }

    if ($username == "") {
        header('Location: 404.html', true, 301);
    }
    
    try {
        // $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);
        $conn = new PDO("mysql:host=$db_servername;port=$db_port;dbname=$db_name", $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        header('Location: 500.html', true, 301);
    }

    if (isset($_POST['add'])) {
        $form_class_name = $_POST['form-classname'];
        $form_homeroom_teacher_id = $_POST['form-homeroomteacher'];

        try {         
            $stmt = $conn->prepare("SELECT * FROM Classes WHERE class_name=:class_name;");
            $stmt->bindParam(':class_name', $form_class_name);
            $stmt->execute();
            $result = $stmt->fetchAll();

            if (count($result) > 0) {
                $error = "Class already exists.";
            }

            if ($error == "") {
                $stmt = $conn->prepare("INSERT INTO Classes (class_name, class_homeroom_teacher_id) VALUES (:class_name, :class_homeroom_teacher_id);");
                $stmt->bindParam(':class_name', $form_class_name);
                $stmt->bindParam(':class_homeroom_teacher_id', $form_homeroom_teacher_id);
                $stmt->execute();
                
                if ($form_homeroom_teacher_id != "") {
                    $stmt = $conn->prepare("UPDATE Users SET user_class = :user_class WHERE user_id=:user_id;");
                    $stmt->bindParam(':user_class', $form_class_name);
                    $stmt->bindParam(':user_id', $form_homeroom_teacher_id);
                    $stmt->execute();
                }

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
        <title>Add Classes - Student Management System</title>
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
                        <h1 class="mt-4">Add Classes</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="manage-classes.php">Manage Classes</a></li>
                            <li class="breadcrumb-item active">Add Classes</li>
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
                                                <input required="true" type="text" id="form-classname" name="form-classname" placeholder="Class Name,  ex: 10A" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="form-homeroomteacher">Homeroom Teacher</label>
                                                <select required="true" id="form-homeroomteacher" name="form-homeroomteacher"  style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                    <option selected value="">Choose Teacher</option>
                                                    <?php
                                                        // $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);
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
                                                            
                                                            if ($result_class == "" or $result_class == NULL) {
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
                                                <input type="submit" name="add" value="Add" style="background-color: #0d6efd; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </main>
                <div id="snackbar">Add new class successfully.</div>
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
