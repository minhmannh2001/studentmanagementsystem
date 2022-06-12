<?php
    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "test";

    $username = $_POST['username'];
    $delete_object = $_POST['deleteobject'];

    // echo $delete_object;

    try {
        $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($delete_object == "") {
            // sql to delete a record
            $sql = "DELETE FROM Users WHERE user_account='$username'";
    
            // use exec() because no results are returned
            $conn->exec($sql);
        } else if ($delete_object == "class") {
            $class_name = $_POST["classname"];
            // echo "$class_name";
            $sql = "DELETE FROM Classes WHERE class_name='$class_name'";
            $conn->exec($sql);
        } else if ($delete_object == "exam") {
            $exam_id = $_POST["examid"];
            // echo "$exam_id";
            $sql = "DELETE FROM Exams WHERE exam_id='$exam_id'";
            $conn->exec($sql);
        } else if ($delete_object == "challenge") {
            $challenge_id = $_POST["challengeid"];
            // echo "$challenge_id";
            $sql = "DELETE FROM Challenges WHERE challenge_id='$challenge_id'";
            $conn->exec($sql);
        }
        session_start();
        $_SESSION['just-delete'] = 'true';
        // echo "Record deleted successfully";
        header('Location: ' . $_SERVER['HTTP_REFERER']);

    } catch(PDOException $e) {
        // echo $sql . "<br>" . $e->getMessage();
        header('Location: 500.html', true, 301);
    }-

    $conn = null;
?> 