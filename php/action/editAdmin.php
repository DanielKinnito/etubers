<?php

require_once 'db_connect.php';

if ($_POST) {
    $adminID = $_POST['editAdminID'];
    $firstName = $_POST['editFirstName'];
    $lastName = $_POST['editLastName'];
    $adminLevel = $_POST['editAdminLevel'];

    $sql = "UPDATE Admins SET FirstName = '$firstName', LastName = '$lastName', AdminLevel = '$adminLevel' WHERE AdminID = $adminID";
    if ($connect->query($sql) === TRUE) {
        echo json_encode(array('success' => true, 'messages' => 'Successfully updated'));
    } else {
        echo json_encode(array('success' => false, 'messages' => 'Error while updating the admin'));
    }

    $connect->close();
}
?>
