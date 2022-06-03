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
                        <h1 class="mt-4">Add Students</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Students</li>
                        </ol>
                        <div class="row">
                            <div class="col-md-12 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <form action="action_page.php">
                                                <label for="studentname">Name</label>
                                                <input required="true" type="text" id="studentname" name="studentname" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                
                                                <label for="studentemail">Email</label>
                                                <input type="text" id="studentemail" name="studentemail" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="studentphone">Phone Number</label>
                                                <input type="text" id="studentphone" name="studentphone" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="studentclass">Class</label>
                                                <select required="true" id="studentclass" name="studentclass"  style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                    <option value="">Choose Class</option>
                                                    <option value="10A">10A</option>
                                                    <option value="10B">10B</option>
                                                </select>

                                                <label for="studentgender">Gender</label>
                                                <select required="true" id="studentgender" name="studentgender"  style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">
                                                    <option value="">Choose Gender</option>    
                                                    <option value="male">Male</option>
                                                    <option value="famale">Female</option>
                                                </select>
                                                
                                                <label for="studentdob">Date Of Birth</label>
                                                <input type="date" id="studentdob" name="studentdob" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="studentphoto">Student Photo</label>
                                                <input required="true" type="file" id="studentphoto" name="studentphoto" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <h4 style="margin-bottom: 15px;">Login Details</h4>

                                                <label for="studentaccount">Account</label>
                                                <input required="true" type="text" id="studentaccount" name="studentaccount" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <label for="studentpassword">Password</label>
                                                <input required="true" type="text" id="studentpassword" name="studentpassword" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; margin-top: 6px; margin-bottom: 16px; resize: vertical;">

                                                <input type="submit" value="Add" style="background-color: #0d6efd; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                                            </form>
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
