<?php

require_once 'db_connect.php';

if ($_POST) {
    $adminID = $_POST['adminID'];

    $sql = "DELETE FROM Admins WHERE AdminID = $adminID";
    if ($connect->query($sql) === TRUE) {
        echo json_encode(array('success' => true, 'messages' => 'Successfully removed'));
    } else {
        echo json_encode(array('success' => false, 'messages' => 'Error while removing the admin'));
    }

    $connect->close();
}
?>
