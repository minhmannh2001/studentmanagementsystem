<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Manage Challenges - Student Management System</title>
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
                        <h1 class="mt-4">Manage Challenges</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="admin-panel.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Challenges</li>
                        </ol>
                        <hr>
                            <div class="d-flex align-items-center">
                                <p><b>Rule:&nbsp&nbsp</b></p>
                                <p>Teacher creates a challenge. Upload 1 file txt which has the content of poem, story, etc. By Providing some suggestions about challenges, students nead to guess the name of that poem, story</p>
                            </div>
                            <p>If true, the content will be shown.</p>
                        <hr>
                        <a href="add-challenges.php" style="background-color: #0d6efd; color: white; padding: 12px 20px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none;">Add new</a>
                        <h5 style="margin-top: 20px;">Total Challenges: 3</h5>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Challenges List
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple"  class="hover stripe row-border" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Creator</th>
                                            <th>Number Of Participants</th>
                                            <th>Creation Date</th>
                                            <th>Expiration Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Title</th>
                                            <th>Content</th>
                                            <th>Creator</th>
                                            <th>Number Of Participants</th>
                                            <th>Creation Date</th>
                                            <th>Expiration Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Challenge 1</td>
                                            <td class="d-flex justify-content-between">
                                                <a href="">https://studentms/exams/example1</a>
                                                <a href="">Download</a>
                                            </td>
                                            <td>Tiger Nixon</td>
                                            <td>30</td>
                                            <td>00:00,  1/6/2022</td>
                                            <td>23:00,  1/6/2022</td>
                                            <td>
                                                <a href="exam-detail.php">More</a>
                                                |
                                                <a href="">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Challenge 2</td>
                                            <td class="d-flex justify-content-between">
                                                <a href="">https://studentms/exams/example2</a>
                                                <a href="">Download</a>
                                            </td>
                                            <td>Garrett Winters</td>
                                            <td>16</td>
                                            <td>00:00,  1/6/2022</td>
                                            <td>12:00,  3/6/2022</td>
                                            <td>
                                                <a href="exam-detail.php">More</a>
                                                |
                                                <a href="">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Challenge 3</td>
                                            <td class="d-flex justify-content-between">
                                                <a href="">https://studentms/exams/example3</a>
                                                <a href="">Download</a>
                                            </td>
                                            <td>Garrett Winters</td>
                                            <td>12</td>
                                            <td>00:00,  1/6/2022</td>
                                            <td>00:00,  12/6/2022</td>
                                            <td>
                                                <a href="exam-detail.php">More</a>
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
