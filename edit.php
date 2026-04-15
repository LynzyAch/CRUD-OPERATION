<?php
session_start();
require_once 'db_connection.php';
mysqli_report(MYSQLI_REPORT_OFF);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id     = (int)$_POST['id'];
    $name   = mysqli_real_escape_string($connection, $_POST['fullname']);
    $email  = mysqli_real_escape_string($connection, $_POST['email']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);

    $sql = "UPDATE clients SET name='$name', email='$email', status='$status' WHERE id=$id";
    
    if (mysqli_query($connection, $sql)) {
        $_SESSION['message'] = "Client Successfully Updated";
    } else {
        $_SESSION['error'] = "Error updating client: " . mysqli_error($connection);
    }

    header("Location: index.php");
    exit();
}
?>