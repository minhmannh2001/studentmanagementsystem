            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="admin-panel.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            

                            <?php
                                if ($position == "Teacher") {
                                    echo "
                                        <a class='nav-link collapsed' href='#' data-bs-toggle='collapse' data-bs-target='#collapseLayouts-class' aria-expanded='false' aria-controls='collapseLayouts'>
                                            <div class='sb-nav-link-icon'><i class='fas fa-columns'></i></div>
                                            Classes
                                            <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div>
                                        </a>
                                        <div class='collapse' id='collapseLayouts-class' aria-labelledby='headingOne' data-bs-parent='#sidenavAccordion'>
                                            <nav class='sb-sidenav-menu-nested nav'>
                                                <a class='nav-link' href='add-classes.php'>Add Classes</a>
                                                <a class='nav-link' href='manage-classes.php'>Manage Classes</a>
                                            </nav>
                                        </div>
            
                                        <a class='nav-link collapsed' href='#' data-bs-toggle='collapse' data-bs-target='#collapseLayouts-teacher' aria-expanded='false' aria-controls='collapseLayouts'>
                                            <div class='sb-nav-link-icon'><i class='fas fa-columns'></i></div>
                                            Teachers
                                            <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div>
                                        </a>
                                        <div class='collapse' id='collapseLayouts-teacher' aria-labelledby='headingOne' data-bs-parent='#sidenavAccordion'>
                                            <nav class='sb-sidenav-menu-nested nav'>
                                                <a class='nav-link' href='add-teachers.php'>Add Teachers</a>
                                                <a class='nav-link' href='manage-teachers.php'>Manage Teachers</a>
                                            </nav>
                                        </div>
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
                                        <a class='nav-link collapsed' href='#' data-bs-toggle='collapse' data-bs-target='#collapseLayouts-challenge' aria-expanded='false' aria-controls='collapseLayouts'>
                                            <div class='sb-nav-link-icon'><i class='fas fa-columns'></i></div>
                                            Challenges
                                            <div class='sb-sidenav-collapse-arrow'><i class='fas fa-angle-down'></i></div>
                                        </a>
                                        <div class='collapse' id='collapseLayouts-challenge' aria-labelledby='headingOne' data-bs-parent='#sidenavAccordion'>
                                            <nav class='sb-sidenav-menu-nested nav'>
                                                <a class='nav-link' href='add-challenges.php'>Add Challenges</a>
                                                <a class='nav-link' href='manage-challenges.php'>Manage Challenges</a>
                                            </nav>
                                        </div>
                                    ";
                                } else {
                                    echo "
                                        <a class='nav-link' href='manage-exams.php'>
                                            <div class='sb-nav-link-icon'><i class='fas fa-tachometer-alt'></i></div>
                                            Exam List
                                        </a>
                                        <a class='nav-link' href='manage-challenges.php'>
                                            <div class='sb-nav-link-icon'><i class='fas fa-tachometer-alt'></i></div>
                                            Challenge List
                                        </a>
                                    ";
                                }
                            ?>
                            

                            
                            <?php
                                $db_servername = "localhost";
                                $db_username = "root";
                                $db_password = "";
                                $db_name = "test";
                            
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

                                $stmt = $conn->prepare("SELECT * FROM Users WHERE user_account = :user_account;");
                                $stmt->bindParam(':user_account', $username);
                                $stmt->execute();
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                $current_user_id = $result['user_id'];

                                $stmt = $conn->prepare("SELECT DISTINCT contact_owner_id, contact_guest_id, contact_status FROM Contacts WHERE contact_guest_id=:contact_guest_id AND contact_status = 'waiting'");
                                $stmt->bindParam(':contact_guest_id', $current_user_id);
                                $stmt->execute();
                                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                $nb_new_meassages = count($results);
                            ?>
                            
                            
                            <a class="nav-link" href="all-users.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                All Users
                            </a>

                            <a class="nav-link" href="message-section.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Messenger&nbsp&nbsp
                                <?php
                                    if ($nb_new_meassages > 0) {
                                        echo "<strong style='color: white;'>($nb_new_meassages new)</strong>";
                                    } 
                                ?>
                                
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