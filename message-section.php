<?php
    $warning = '';
    
    session_start();
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $position = $_SESSION['position'];
    
    include 'config.php';

    if ($username == "") {
        header('Location: 404.html', true, 301);
    }
    
    try {
        $conn = new PDO("mysql:host=$db_servername;port=$db_port;dbname=$db_name", $db_username, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
        <title>Message Section - Student Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles2.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            .user-image {
                width:100px;
                border-radius:50%;
                margin:10px;
                margin-right: 40px;
            }
            .friend:hover{
                background:#f1f4f6;
                cursor:pointer;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <?php include 'admin-panel-topbar.php' ?>
        <div id="layoutSidenav">
            <?php include 'admin-panel-sidebar.php' ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Message Section</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Message Section</li>
                        </ol>
                        <div class="row">
                            <div class="col-md-12 grid-margin">
                                <div class="d-flex align-items-center">
                                    <?php
                                        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_account = :user_account;");
                                        $stmt->bindParam(':user_account', $username);
                                        $stmt->execute();
                                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                        $current_user_id = $result['user_id'];

                                        $stmt = $conn->prepare("SELECT DISTINCT contact_owner_id, contact_guest_id, contact_status FROM Contacts WHERE contact_guest_id=:contact_guest_id AND contact_status = 'waiting'");
                                        $stmt->bindParam(':contact_guest_id', $current_user_id);
                                        $stmt->execute();
                                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        $total_no_waiting_message = count($results);

                                        $stmt = $conn->prepare("SELECT DISTINCT contact_owner_id, contact_guest_id FROM Contacts WHERE contact_guest_id=:contact_guest_id OR contact_owner_id=:contact_guest_id");
                                        $stmt->bindParam(':contact_guest_id', $current_user_id);
                                        $stmt->execute();
                                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    ?>
                                    <span style="height: 15px; width: 15px; background-color: #f4ba60; border-radius: 50%; display: inline-block;"></span>&nbsp<p style="margin-bottom: 0;">Waiting messages: <?php echo "$total_no_waiting_message"; ?></p>                             
                                </div>
                                <!-- <div>
                                    <form action="">
                                        <input placeholder="Search contacts..." type="text" id="searchcontact" name="searchcontact" style="width: 99%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">            
                                    </form>
                                </div> -->
                            </div>
                            <h4 style="margin-bottom: 0px; margin-top: 15px;">Contact List</h4>
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-md-12 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <div>
                                                <?php
                                                    if (count($results) == 0) {
                                                        echo "You don't have any contact to anyone.";
                                                    } else {
                                                        $already_show = [];
                                                        foreach ($results as $result) {
                                                            $contact_user_id = $result['contact_owner_id'];
                                                            if ($contact_user_id == $current_user_id) {
                                                                $contact_user_id = $result['contact_guest_id'];
                                                                if (!in_array($contact_user_id, $already_show)) {
                                                                    array_push($already_show, $contact_user_id);
                                                                } else {
                                                                    continue;
                                                                }
                                                            } else {
                                                                if (!in_array($contact_user_id, $already_show)) {
                                                                    array_push($already_show, $contact_user_id);
                                                                } else {
                                                                    continue;
                                                                }
                                                            }
                                                            $stmt = $conn->prepare("SELECT * FROM Users WHERE user_id=:user_id;");
                                                            $stmt->bindParam(':user_id', $contact_user_id);
                                                            $stmt->execute();
                                                            $contact_user_information = $stmt->fetch(PDO::FETCH_ASSOC);
                                                            $contact_user_email = $contact_user_information['user_email'];
                                                            $contact_user_name = $contact_user_information['user_firstname'] . " " . $contact_user_information['user_lastname'];
                                                            $contact_user_photo = $contact_user_information['user_photo'];
                                                            $contact_user_photo_url = 'images/' . $contact_user_photo;
                                                            echo "
                                                                <a href='messenger.php?owner_id=$current_user_id&guest_id=$contact_user_id' style='text-decoration: none; color: inherit;'>
                                                                    <div class='d-flex friend' style='border-bottom:1px solid #e7ebee;'>
                                                                ";
                                                                if ($contact_user_photo_url == "images/") {
                                                                    echo "<img src='https://dummyimage.com/100x100/343a40/6c757d' alt='' class='user-image'>";
                                                                }
                                                                else {
                                                                    echo "<div style='background-image: url(" . "$contact_user_photo_url" . "); width: 100px; height: 100px; background-size: cover;' class='user-image'></div>";
                                                                }
                                                            echo "
                                                                        <div class='d-flex flex-column justify-content-center'>
                                                                            <p class='username' style='margin-bottom: 5px;'><strong>$contact_user_name</strong></p>
                                                                            <p class='email'>$contact_user_email</p>
                                                            ";
                                                            if ($contact_user_id != $current_user_id) {
                                                                $stmt = $conn->prepare("SELECT * FROM Contacts WHERE (contact_guest_id=:contact_guest_id AND contact_owner_id=:contact_owner_id) AND contact_status='waiting'");
                                                                
                                                                $stmt->bindParam(':contact_owner_id', $contact_user_id);
                                                                $stmt->bindParam(':contact_guest_id', $current_user_id);
                                                                $stmt->execute();
                                                                $results = $stmt->fetchAll();
                                                                if (count($results) == 0) {
                                                                    echo "
                                                                                    <div class='d-flex align-items-center'>
                                                                                            <span style='height: 10px; width: 10px; background-color: #6cc16f; border-radius: 50%; display: inline-block; margin: 7px; margin-left: 0px;'>
                                                                                            <p style='width: 100px; margin-bottom: 0; margin-top: -6px;'>&nbsp&nbsp&nbsp&nbspOnline</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    ";
                                                                }
                                                                else {
                                                                    echo "
                                                                                    <div class='d-flex align-items-center'>
                                                                                            <span style='height: 10px; width: 10px; background-color: #f4ba60; border-radius: 50%; display: inline-block; margin: 7px; margin-left: 0px;'>
                                                                                            <p style='width: 100px; margin-bottom: 0; margin-top: -6px;'>&nbsp&nbsp&nbsp&nbspWaiting</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    ";
                                                                }
                                                            } 
                                                        }
                                                    
                                                    }
                                                ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <nav aria-label="Page navigation example" style="margin-top: 20px;">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav> -->
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
