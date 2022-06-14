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

    if ($username == "") {
        header('Location: 404.html', true, 301);
    }
    
    try {
        $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        // roll back the transaction if something failed
        $conn->rollback();
        echo "Error: " . $e->getMessage();
        header('Location: 500.html', true, 301);
    }

    $owner_id = $_GET['owner_id'];
    $guest_id = $_GET['guest_id'];


    $stmt = $conn->prepare("SELECT * FROM Users WHERE user_account = :user_account;");
    $stmt->bindParam(':user_account', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $current_user_id = $result['user_id'];

    if ($owner_id != $current_user_id) {
        header('Location: 401.html', true, 301);
    }

    $stmt = $conn->prepare("SELECT * FROM Users WHERE user_id=:user_id;");
    $stmt->bindParam(':user_id', $guest_id);
    $stmt->execute();
    $guest_information = $stmt->fetch(PDO::FETCH_ASSOC);
    $guest_email = $guest_information['user_email'];
    $guest_account = $guest_information['user_account'];
    $guest_name = $guest_information['user_firstname'] . " " . $guest_information['user_lastname'];
    $guest_photo = $guest_information['user_photo'];
    $guest_photo_url = 'images/' . $guest_photo;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Messenger - Student Management System</title>
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
                        <h1 class="mt-4">Messenger</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="message-section.php">Message Section</a></li>
                            <li class="breadcrumb-item active">Messenger</li>
                        </ol>
                        <div class="row">
                            <?php
                                if ($guest_photo_url == "images/") {
                                    echo "<img src='https://dummyimage.com/100x100/343a40/6c757d' alt='' class='user-image'>";
                                }
                                else {
                                    echo "<div style='background-image: url(" . "$guest_photo_url" . "); width: 100px; height: 100px; background-size: cover;' class='user-image'></div>";
                                }
                            ?>
                            <a href="user-profile.php" style="color: inherit; text-decoration: none;">
                                <h4 style="margin-bottom: 0px;"><?php echo "$guest_name" ?></h4>
                            </a>
                            <div class="col-md-12 grid-margin">
                                <div class="d-flex align-items-center">                              
                                    <p style="margin-bottom: 0;">Status:&nbsp&nbsp</p><span style="height: 15px; width: 15px; background-color: #6cc16f; border-radius: 50%; display: inline-block;"></span>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px;">
                                <div class="card" style="padding-top: 20px; padding-bottom: 10px;">
                                <?php
                                    $stmt = $conn->prepare("SELECT * FROM Contacts WHERE (contact_guest_id=:contact_guest_id AND contact_owner_id=:contact_owner_id) OR (contact_owner_id=:contact_guest_id AND contact_guest_id=:contact_owner_id) ORDER BY contact_id, contact_date ASC");
                                    $stmt->bindParam(':contact_owner_id', $current_user_id);
                                    $stmt->bindParam(':contact_guest_id', $guest_id);
                                    $stmt->execute();
                                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($results as $result) {
                                        $contact_owner_id = $result['contact_owner_id'];
                                        $contact_guest_id = $result['contact_guest_id'];
                                        $contact_message = $result['contact_message'];
                                        $contact_date = $result['contact_date'];
                                        $contact_date = date_create($contact_date);
                                        $contact_date = date_format($contact_date, "H:i d/m/Y");
                                        $contact_status = $result['contact_status'];
                                        $contact_is_modified = $result['contact_is_modified'];

                                        echo "
                                            <div class='col-md-12 grid-margin d-flex flex-column' style='margin-bottom: 15px;'>
                                                <div class='card' style='background-color: #f0f4f7;'>
                                                    <div class='card-body d-flex flex-column'>
                                        ";
                                        if ($contact_owner_id == $current_user_id) {
                                            echo "
                                                        <div>$contact_message</div>
                                                    </div>
                                                </div>
                                            ";
                                        } else if ($contact_guest_id == $current_user_id) {
                                            echo "
                                                        <div style='margin-left: auto'>$contact_message</div>
                                                    </div>
                                                </div>
                                            ";
                                            $stmt = $conn->prepare("UPDATE Contacts SET contact_status = 'seen' WHERE (contact_guest_id=:contact_guest_id AND contact_owner_id=:contact_owner_id)");
                                            $stmt->bindParam(':contact_owner_id', $guest_id);
                                            $stmt->bindParam(':contact_guest_id', $current_user_id);
                                            $stmt->execute();
                                        }
                                        if ($contact_owner_id == $current_user_id) {
                                            echo "
                                                    <div style='color: #707880; margin-top: 5px;'>
                                                        From me, sent at $contact_date
                                                    </div>
                                                </div>
                                            ";
                                        } else if ($contact_guest_id == $current_user_id) {
                                            echo "
                                                    <div style='margin-left: auto; color: #707880; margin-top: 5px;'>
                                                        From $guest_name,&nbsp&nbspsent at $contact_date
                                                    </div>
                                                </div>
                                            ";
                                        }
                                    }
                                ?>
                                    
                                
                                </div>
                            </div>
                            <form action="save-message.php" method="POST">
                                <input type="hidden" name="sender_username" value="<?php echo $username; ?>">
                                <input type="hidden" name="receiver_username" value="<?php echo $guest_account; ?>">
                                <label for="message" style="margin-top: 20px;"><h5>Write message:</h5></label>
                                <textarea required="true" placeholder="Write something..." id="message" name="message" style="width: 99%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;"></textarea>                                     
                                <input type="submit" value="Send" name="sendmessage" style="background-color: #0d6efd; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                            </form>
                        </div>
                        
                    </div>
                </main>
                <div id="snackbar">Send message successfully.</div>
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
                $_SESSION['add-item-success'] = "false";
            ?>
        </script>
    </body>
</html>
