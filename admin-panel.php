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
    
    try {
        $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        header('Location: 500.html', true, 301);
    }

    if ($username == "") {
        header('Location: 404.html', true, 301);
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
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-md-12 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-sm-flex align-items-baseline report-summary-header">
                                                    <h5 class="font-weight-semibold">Report Summary</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="margin-bottom: 30px; margin-top: 0px;">
                                        <div class="row report-inner-cards-wrapper">
                                            <div class="col-md -6 col-xl report-inner-card d-flex justify-content-between" style="border-right: 1px solid #dfdfdf;">
                                                <div class="inner-card-text">
                                                    <span class="report-title">Total Class</span>
                                                    <?php
                                                        $stmt = $conn->prepare("SELECT * FROM Classes;");
                                                        $stmt->execute();
                                                        $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        $nb_classes = count($classes);
                                                        echo "<h4>$nb_classes</h4>";
                                                        if ($position == "Teacher") {
                                                            echo "<a href='manage-classes.php'><span class='report-count'> View Classes</span></a>";
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl report-inner-card d-flex justify-content-between" style="border-right: 1px solid #dfdfdf;">
                                                <div class="inner-card-text">
                                                    <span class="report-title">Total Students</span>
                                                    <?php
                                                        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_position = 'Student';");
                                                        $stmt->execute();
                                                        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        $nb_students = count($students);
                                                        echo "<h4>$nb_students</h4>";
                                                        if ($position == "Teacher") {
                                                            echo "<a href='manage-students.php'><span class='report-count'> View Students</span></a>";
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl report-inner-card d-flex justify-content-between" style="border-right: 1px solid #dfdfdf;">
                                                <div class="inner-card-text">
                                                    <span class="report-title">Total Teachers</span>
                                                    <?php
                                                        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_position = 'Teacher';");
                                                        $stmt->execute();
                                                        $teachers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        $nb_teachers = count($teachers);
                                                        echo "<h4>$nb_teachers</h4>";
                                                        if ($position == "Teacher") {
                                                            echo "<a href='manage-teachers.php'><span class='report-count'> View Teachers</span></a>";
                                                        }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl report-inner-card" style="border-right: 1px solid #dfdfdf;">
                                                <div class="inner-card-text">
                                                    <span class="report-title">Total Class Exams</span>
                                                    <?php
                                                        $stmt = $conn->prepare("SELECT * FROM Exams;");
                                                        $stmt->execute();
                                                        $exams = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        $nb_exams = count($exams);
                                                        echo "<h4>$nb_exams</h4>";
                                                    ?>
                                                    <a href="manage-exams.php"><span class="report-count"> View Class Exams</span></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl report-inner-card">
                                                <div class="inner-card-text">
                                                    <span class="report-title">Total Challenges</span>
                                                    <?php
                                                        $stmt = $conn->prepare("SELECT * FROM Challenges;");
                                                        $stmt->execute();
                                                        $challenges = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        $nb_challenges = count($challenges);
                                                        echo "<h4>$nb_challenges</h4>";
                                                    ?>
                                                    <a href="manage-challenges.php"><span class="report-count"> View Challenges</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
