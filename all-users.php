<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tables - Student Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles2.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
    <?php include 'admin-panel-topbar.php' ?>
        <div id="layoutSidenav">
        <?php include 'admin-panel-sidebar.php' ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">All Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">All Users</li>
                        </ol>
                        <h5 style="margin-top: 20px;">Total Users: 4</h5>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                User List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple"  class="hover stripe row-border" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Account</th>
                                            <th>Position</th>
                                            <th>Email</th>
                                            <th>Start date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Account</th>
                                            <th>Position</th>
                                            <th>Email</th>
                                            <th>Start date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>10A1</td>
                                            <td>Tiger Nixon</td>
                                            <td>student1</td>
                                            <td>Student</td>
                                            <td>student1@gmail.com</td>
                                            <td>1/6/2022</td>
                                            <td>
                                                <a href="user-profile.php">More</a>
                                                |
                                                <a href="">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>10B1</td>
                                            <td>Garrett Winters</td>
                                            <td>student2</td>
                                            <td>Student</td>
                                            <td>student2@gmail.com</td>
                                            <td>1/6/2022</td>
                                            <td>
                                                <a href="user-profile.php">More</a>
                                                |
                                                <a href="">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>10B2</td>
                                            <td>Ashton Cox</td>
                                            <td>student3</td>
                                            <td>Student</td>
                                            <td>student3@gmail.com</td>
                                            <td>1/6/2022</td>
                                            <td>
                                                <a href="user-profile.php">More</a>
                                                |
                                                <a href="">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>10B3</td>
                                            <td>Alphonso Davies</td>
                                            <td>student4</td>
                                            <td>Student</td>
                                            <td>student4@gmail.com</td>
                                            <td>1/6/2022</td>
                                            <td>
                                                <a href="">More</a>
                                                |
                                                <a href="">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>T1</td>
                                            <td>Cristiano Ronaldo</td>
                                            <td>teacher1</td>
                                            <td>Teacher</td>
                                            <td>teacher1@gmail.com</td>
                                            <td>4/6/2022</td>
                                            <td>
                                                <a href="">More</a>
                                                |
                                                <a href="">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>T2</td>
                                            <td>Lionel Messi</td>
                                            <td>teacher2</td>
                                            <td>Teacher</td>
                                            <td>teacher2@gmail.com</td>
                                            <td>2/6/2022</td>
                                            <td>
                                                <a href="">More</a>
                                                |
                                                <a href="">Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Student Management Student 2022</div>
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
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
