            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="admin-panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts-class" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Classes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts-class" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="add-classes.php">Add Classes</a>
                                    <a class="nav-link" href="manage-classes.php">Manage Classes</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts-teacher" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Teachers
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts-teacher" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="add-teachers.php">Add Teachers</a>
                                    <a class="nav-link" href="manage-teachers.php">Manage Teachers</a>
                                </nav>
                            </div>

                            <?php
                                if ($position == "Teacher") {
                                    echo "
                                        <a class='nav-link collapsed' href='#' data-bs-toggle='collapse' data-bs-target='#collapseLayouts-student' aria-expanded='false' aria-controls='collapseLayouts'>
                                        <div class='sb-nav-link-icon'><i class='fas fa-columns'></i></div>
                                        Students
                                        <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div>
                                        </a>
                                        <div class='collapse' id='collapseLayouts-student' aria-labelledby='headingOne' data-bs-parent='#sidenavAccordion'>
                                            <nav class='sb-sidenav-menu-nested nav'>
                                                <a class='nav-link' href='add-students.php'>Add Students</a>
                                                <a class='nav-link' href='manage-students.php'>Manage Students</a>
                                            </nav>
                                        </div>

                                        <a class='nav-link collapsed' href='#' data-bs-toggle='collapse' data-bs-target='#collapseLayouts-exam' aria-expanded='false' aria-controls='collapseLayouts'>
                                            <div class='sb-nav-link-icon'><i class='fas fa-columns'></i></div>
                                            Exams
                                            <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div>
                                        </a>
                                        <div class='collapse' id='collapseLayouts-exam' aria-labelledby='headingOne' data-bs-parent='#sidenavAccordion'>
                                            <nav class='sb-sidenav-menu-nested nav'>
                                                <a class='nav-link' href='add-exams.php'>Add Exams</a>
                                                <a class='nav-link' href='manage-exams.php'>Manage Exams</a>
                                            </nav>
                                        </div>
                                    ";
                                } else {
                                    echo "
                                        <a class='nav-link' href='manage-exams.php'>
                                            <div class='sb-nav-link-icon'><i class='fas fa-tachometer-alt'></i></div>
                                            Exam List
                                        </a>
                                
                                    ";
                                }
                            ?>
                            

                            

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts-challenge" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Challenges
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts-challenge" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="add-challenges.php">Add Challenges</a>
                                    <a class="nav-link" href="manage-challenges.php">Manage Challenges</a>
                                </nav>
                            </div>
                            
                            <a class="nav-link" href="all-users.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                All Users
                            </a>

                            <a class="nav-link" href="message-section.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Messenger&nbsp&nbsp
                                <strong style="color: white;">(1 new)</strong>
                            </a>
                            </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php
                            $user_username = $_SESSION['username'];
                            echo "$user_username";
                        ?>
                    </div>
                </nav>
            </div>