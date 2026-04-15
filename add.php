<?php
session_start();
require_once 'db_connection.php'; 
mysqli_report(MYSQLI_REPORT_OFF);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $name   = mysqli_real_escape_string($connection, $_POST['fullname']);
    $email  = mysqli_real_escape_string($connection, $_POST['email']);
    $status = mysqli_real_escape_string($connection, $_POST['status']);

    $sql    = "INSERT INTO clients (name, email, status) VALUES ('$name', '$email', '$status')";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        $_SESSION['message'] = "Client added successfully.";
    } else {
        if (mysqli_errno($connection) == 1062) {
            $_SESSION['error'] = "Email already exists.";
        } else {
            $_SESSION['error'] = "Error: " . mysqli_error($connection);
        }
    }
    header("Location: index.php");
    exit();
}
header("Location: index.php");
exit();
?>