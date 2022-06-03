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
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
    <?php include 'admin-panel-topbar.php' ?>
        <div id="layoutSidenav">
        <?php include 'admin-panel-sidebar.php' ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Exam 1</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="manage-exams.php">Manage Exams</a></li>
                            <li class="breadcrumb-item active">Exam 1</li>
                        </ol>
                        <hr>
                        <h3>Description</h3>
                        <div class="d-flex justify-content-between align-items-center" style="width: 50%;">
                            <div>
                                <div class="d-flex align-items-center">
                                    <p>Creator:&nbsp</p>
                                    <p><a href="" style="text-decoration: none;">Aphonso Davies</a></p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p>Class:&nbsp</p>
                                    <p><a href="" style="text-decoration: none;">10A</a></p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p>Subject:&nbsp</p>
                                    <p><a href="">https://studentms/exams/example1</a>(<a href="">Download</a>)</p>
                                </div>
                            </div>
                            <div style="border-radius: 5px; background-color: #f2f2f2; padding: 20px;">
                                <div class="d-flex align-items-center;">
                                    <p>Creation Date:&nbsp&nbsp</p>
                                    <p>00:00, 1/6/2022</p>
                                </div>
                                <div class="d-flex align-items-center" style="margin-bottom: -20px;">
                                    <p>Expiration Date:&nbsp&nbsp</p>
                                    <p>21:00, 2/6/2022</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5>Total Submission: 3</h5>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Submission List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple"  class="hover stripe row-border" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Class</th>
                                            <th>Assignment</th>
                                            <th>Submission Date</th>
                                            <th>Grade</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Class</th>
                                            <th>Assignment</th>
                                            <th>Submission Date</th>
                                            <th>Grade</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>10A1</td>
                                            <td>Tiger Nixon</td>
                                            <td>10A</td>
                                            <td class="d-flex justify-content-between">
                                                <a href="">https://studentms/exams/submission/tiger-nixon.docs</a>
                                                <a href="">Download</a>
                                            </td>
                                            <td>05:00,  1/6/2022</td>
                                            <td>
                                                <b>8/10</b>
                                                |
                                                <a href="">Modify</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>10B1</td>
                                            <td>Garrett Winters</td>
                                            <td>10B</td>
                                            <td class="d-flex justify-content-between">
                                                <a href="">https://studentms/exams/submission/tiger-nixon.docs</a>
                                                <a href="">Download</a>
                                            </td>
                                            <td style="color: red;">09:30,  3/6/2022</td>
                                            <td>
                                                <b>?/10</b>
                                                |
                                                <a href="">Mark</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>10B2</td>
                                            <td>Garrett Winters</td>
                                            <td>10B</td>
                                            <td class="d-flex justify-content-between">
                                                <a href="">https://studentms/exams/submission/tiger-nixon.docs</a>
                                                <a href="">Download</a>
                                            </td>
                                            <td>10:10,  1/6/2022</td>
                                            <td>
                                                <form action="">
                                                    <input type="text" style="border: 1px solid #ccc; border-radius: 4px; width: 20%;">
                                                    <input type="submit" value="Save">
                                                </form>
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
