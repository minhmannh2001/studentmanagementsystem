<?php
    session_start();
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $position = $_SESSION['position'];

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

    if (isset($_POST['sendmessage'])) {
        $sender_username = $_POST['sender_username'];
        $receiver_username = $_POST['receiver_username'];
        $message = $_POST['message'];
        echo "$sender_username<br>";
        echo "$receiver_username<br>";
        echo "$message<br>";

        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_account = :user_account;");
        $stmt->bindParam(':user_account', $sender_username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $form_contact_owner_id = $result['user_id'];

        $stmt = $conn->prepare("SELECT * FROM Users WHERE user_account = :user_account;");
        $stmt->bindParam(':user_account', $receiver_username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $form_contact_guest_id = $result['user_id'];

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $current_timestamp = date('Y-m-d H:i:s');

        // prepare contact_id
        $stmt = $conn->prepare("SELECT * FROM Contacts WHERE (contact_owner_id=:contact_owner_id AND contact_guest_id=:contact_guest_id) OR (contact_owner_id=:contact_guest_id AND contact_guest_id=:contact_owner_id) ORDER BY contact_id DESC;");
        $stmt->bindParam(':contact_owner_id', $form_contact_owner_id);
        $stmt->bindParam(':contact_guest_id', $form_contact_guest_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($result) == 0) {
            $form_contact_id = 0;
        } else {
            $form_contact_id = $result[0]['contact_id'];
            $form_contact_id += 1;
        }

        echo "Sender Username: $sender_username<br>";
        echo "Sender ID: $form_contact_owner_id<br>";
        echo "Receiver Username: $receiver_username<br>";
        echo "Receiver ID: $form_contact_guest_id<br>";
        echo "Message: $message<br>";
        echo "Contact ID: $form_contact_id<br>";
        echo "Contact Date: $current_timestamp<br>";
        $contact_status = 'waiting';
        $stmt = $conn->prepare("INSERT INTO Contacts (contact_owner_id, contact_guest_id, contact_id, contact_message, contact_date, contact_status)
        VALUES (:contact_owner_id, :contact_guest_id, :contact_id, :contact_message, :contact_date, :contact_status);");
        $stmt->bindParam(':contact_owner_id', $form_contact_owner_id);
        $stmt->bindParam(':contact_guest_id', $form_contact_guest_id);
        $stmt->bindParam(':contact_id', $form_contact_id);
        $stmt->bindParam(':contact_message', $message);
        $stmt->bindParam(':contact_date', $current_timestamp);
        $stmt->bindParam(':contact_status', $contact_status);
        $stmt->execute();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
?>