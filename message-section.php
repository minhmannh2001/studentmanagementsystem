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
                            <div class="col-md-12 grid-margin">
                                <div class="d-flex align-items-center">                              
                                    <span style="height: 15px; width: 15px; background-color: #6cc16f; border-radius: 50%; display: inline-block;"></span>&nbsp<p style="margin-bottom: 0;">Online users: 5</p>
                                    &nbsp&nbsp&nbsp&nbsp
                                    <span style="height: 15px; width: 15px; background-color: #f4ba60; border-radius: 50%; display: inline-block;"></span>&nbsp<p style="margin-bottom: 0;">Waiting messages: 2</p>                             
                                </div>
                                <div>
                                    <form action="">
                                        <input placeholder="Search contacts..." type="text" id="searchcontact" name="searchcontact" style="width: 99%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">            
                                    </form>
                                </div>
                            </div>
                            <h4 style="margin-bottom: 0px;">Users List</h4>
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-md-12 grid-margin">
                                    <div class="card">
                                        <div class="card-body">
                                            <div>
                                                <a href="messenger.php" style="text-decoration: none; color: inherit;">
                                                    <div class="d-flex friend" style="border-bottom:1px solid #e7ebee;">
                                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1_copy.jpg" class="user-image">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="username" style="margin-bottom: 5px;"><strong>Miro Badev</strong></p>
                                                            <p class="email">mirobadev@gmail.com</p>
                                                            <div class="d-flex align-items-center">
                                                                    <span style="height: 10px; width: 10px; background-color: #6cc16f; border-radius: 50%; display: inline-block; margin: 7px; margin-left: 0px;">
                                                                    <p style="width: 100px; margin-bottom: 0; margin-top: -6px;">&nbsp&nbsp&nbsp&nbspOnline</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="" style="text-decoration: none; color: inherit;">
                                                    <div class="d-flex friend" style="border-bottom:1px solid #e7ebee;">
                                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/2_copy.jpg" class="user-image">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="username" style="margin-bottom: 5px;"><strong>Martin Joseph</strong></p>
                                                            <p class="email">marjoseph@gmail.com</p>
                                                            <div class="d-flex align-items-center">
                                                                    <span style="height: 10px; width: 10px; background-color: #f4ba60; border-radius: 50%; display: inline-block; margin: 7px; margin-left: 0px;">
                                                                    <p style="width: 100px; margin-bottom: 0; margin-top: -6px;">&nbsp&nbsp&nbsp&nbspWating</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="" style="text-decoration: none; color: inherit;">
                                                    <div class="d-flex friend" style="border-bottom:1px solid #e7ebee;">
                                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/3_copy.jpg" class="user-image">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="username" style="margin-bottom: 5px;"><strong>Tomas Kennedy</strong></p>
                                                            <p class="email">tomaskennedy@gmail.com</p>
                                                            <div class="d-flex align-items-center">
                                                                    <span style="height: 10px; width: 10px; background-color: #6cc16f; border-radius: 50%; display: inline-block; margin: 7px; margin-left: 0px;">
                                                                    <p style="width: 100px; margin-bottom: 0; margin-top: -6px;">&nbsp&nbsp&nbsp&nbspOnline</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="" style="text-decoration: none; color: inherit;">
                                                    <div class="d-flex friend" style="border-bottom:1px solid #e7ebee;">
                                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/4_copy.jpg" class="user-image">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="username" style="margin-bottom: 5px;"><strong>Enrique	Sutton</strong></p>
                                                            <p class="email">enriquesutton@gmail.com</p>
                                                            <div class="d-flex align-items-center">
                                                                    <span style="height: 10px; width: 10px; background-color: #6cc16f; border-radius: 50%; display: inline-block; margin: 7px; margin-left: 0px;">
                                                                    <p style="width: 100px; margin-bottom: 0; margin-top: -6px;">&nbsp&nbsp&nbsp&nbspOnline</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="" style="text-decoration: none; color: inherit;">
                                                    <div class="d-flex friend" style="border-bottom:1px solid #e7ebee;">
                                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1_copy.jpg" class="user-image">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="username" style="margin-bottom: 5px;"><strong>Miro Badev</strong></p>
                                                            <p class="email">mirobadev@gmail.com</p>
                                                            <div class="d-flex align-items-center">
                                                                    <span style="height: 10px; width: 10px; background-color: #6cc16f; border-radius: 50%; display: inline-block; margin: 7px; margin-left: 0px;">
                                                                    <p style="width: 100px; margin-bottom: 0; margin-top: -6px;">&nbsp&nbsp&nbsp&nbspOnline</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="" style="text-decoration: none; color: inherit;">
                                                    <div class="d-flex friend" style="border-bottom:1px solid #e7ebee;">
                                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/2_copy.jpg" class="user-image">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="username" style="margin-bottom: 5px;"><strong>Martin Joseph</strong></p>
                                                            <p class="email">marjoseph@gmail.com</p>
                                                            <div class="d-flex align-items-center">
                                                                    <span style="height: 10px; width: 10px; background-color: #eaeef0; border-radius: 50%; display: inline-block; margin: 7px; margin-left: 0px;">
                                                                    <p style="width: 100px; margin-bottom: 0; margin-top: -6px;">&nbsp&nbsp&nbsp&nbspOffline</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="" style="text-decoration: none; color: inherit;">
                                                    <div class="d-flex friend" style="border-bottom:1px solid #e7ebee;">
                                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/3_copy.jpg" class="user-image">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="username" style="margin-bottom: 5px;"><strong>Tomas Kennedy</strong></p>
                                                            <p class="email">tomaskennedy@gmail.com</p>
                                                            <div class="d-flex align-items-center">
                                                                    <span style="height: 10px; width: 10px; background-color: #eaeef0; border-radius: 50%; display: inline-block; margin: 7px; margin-left: 0px;">
                                                                    <p style="width: 100px; margin-bottom: 0; margin-top: -6px;">&nbsp&nbsp&nbsp&nbspOffline</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="" style="text-decoration: none; color: inherit;">
                                                    <div class="d-flex friend" style="border-bottom:1px solid #e7ebee;">
                                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/4_copy.jpg" class="user-image">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="username" style="margin-bottom: 5px;"><strong>Enrique	Sutton</strong></p>
                                                            <p class="email">enriquesutton@gmail.com</p>
                                                            <div class="d-flex align-items-center">
                                                                    <span style="height: 10px; width: 10px; background-color: #eaeef0; border-radius: 50%; display: inline-block; margin: 7px; margin-left: 0px;">
                                                                    <p style="width: 100px; margin-bottom: 0; margin-top: -6px;">&nbsp&nbsp&nbsp&nbspOffline</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="" style="text-decoration: none; color: inherit;">
                                                    <div class="d-flex friend" style="border-bottom:1px solid #e7ebee;">
                                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/3_copy.jpg" class="user-image">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="username" style="margin-bottom: 5px;"><strong>Tomas Kennedy</strong></p>
                                                            <p class="email">tomaskennedy@gmail.com</p>
                                                            <div class="d-flex align-items-center">
                                                                    <span style="height: 10px; width: 10px; background-color: #eaeef0; border-radius: 50%; display: inline-block; margin: 7px; margin-left: 0px;">
                                                                    <p style="width: 100px; margin-bottom: 0; margin-top: -6px;">&nbsp&nbsp&nbsp&nbspOffline</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="" style="text-decoration: none; color: inherit;">
                                                    <div class="d-flex friend" style="border-bottom:1px solid #e7ebee;">
                                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/4_copy.jpg" class="user-image">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="username" style="margin-bottom: 5px;"><strong>Enrique	Sutton</strong></p>
                                                            <p class="email">enriquesutton@gmail.com</p>
                                                            <div class="d-flex align-items-center">
                                                                    <span style="height: 10px; width: 10px; background-color: #eaeef0; border-radius: 50%; display: inline-block; margin: 7px; margin-left: 0px;">
                                                                    <p style="width: 100px; margin-bottom: 0; margin-top: -6px;">&nbsp&nbsp&nbsp&nbspOffline</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <nav aria-label="Page navigation example" style="margin-top: 20px;">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
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
