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
                            <li class="breadcrumb-item active">Messenger</li>
                        </ol>
                        <div class="row">
                            <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1_copy.jpg" class="user-image">
                            <h4 style="margin-bottom: 0px;">Miro Badev</h4>
                            <div class="col-md-12 grid-margin">
                                <div class="d-flex align-items-center">                              
                                    <p style="margin-bottom: 0;">Status:&nbsp&nbsp</p><span style="height: 15px; width: 15px; background-color: #6cc16f; border-radius: 50%; display: inline-block;"></span>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px;">
                                <div class="card" style="padding-top: 20px; padding-bottom: 10px;">
                                    <div class="col-md-12 grid-margin d-flex flex-column" style="margin-bottom: 15px;">
                                        <div class="card" style="background-color: #f0f4f7;">
                                            <div class="card-body d-flex flex-column">
                                                <div style="margin-left: auto">Hello</div>
                                            </div>
                                        </div>
                                        <div style="margin-left: auto; color: #707880; margin-top: 5px;">
                                            From Miro Badev,&nbsp&nbspsent at 11:05 3/6/2022
                                        </div>
                                    </div>
                                    <div class="col-md-12 grid-margin d-flex flex-column">
                                        <div class="card" style="background-color: #f0f4f7;">
                                            <div class="card-body d-flex justify-content-between">
                                                <div>Hi</div>
                                                <a href="">Modify</a>
                                            </div>
                                        </div>
                                        <div style="color: #707880; margin-top: 5px;">
                                            From me,&nbsp&nbspsent at 11:05 3/6/2022
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                            <form action="">
                                <label for="message" style="margin-top: 20px;"><h5>Write message:</h5></label>
                                <textarea required="true" placeholder="Write something..." id="message" name="message" style="width: 99%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;"></textarea>                                     
                                <input type="submit" value="Send" style="background-color: #0d6efd; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                            </form>
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
