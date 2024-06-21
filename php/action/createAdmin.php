<?php

require_once '../db_connect.php';

if ($_POST) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $adminLevel = $_POST['adminLevel'];

    $sql = "INSERT INTO Admins (FirstName, LastName, AdminLevel) VALUES ('$firstName', '$lastName', '$adminLevel')";
    if ($connect->query($sql) === TRUE) {
        echo json_encode(array('success' => true, 'messages' => 'Successfully added'));
    } else {
        echo json_encode(array('success' => false, 'messages' => 'Error while adding the admin'));
    }

    $connect->close();
}
?>
