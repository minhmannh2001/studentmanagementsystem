<?php
    $db_servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "test";

    $username = $_POST['username'];

    echo $username;

    try {
        $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // sql to delete a record
        $sql = "DELETE FROM Users WHERE user_account='$username'";

        // use exec() because no results are returned
        $conn->exec($sql);
        session_start();
        $_SESSION['just-delete'] = 'true';
        // echo "Record deleted successfully";
        header('Location: manage-teachers.php', true, 301);

    } catch(PDOException $e) {
        // echo $sql . "<br>" . $e->getMessage();
        header('Location: 500.html', true, 301);
    }-

    $conn = null;
?> 