<?php
session_start();
require_once 'db_connection.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; 

    $sql = "DELETE FROM clients WHERE id = $id";
    
    if (mysqli_query($connection, $sql)) {
        $_SESSION['message'] = "Client Deleted Successfully";
    } else {
        $_SESSION['error'] = "Error deleting client: " . mysqli_error($connection);
    }
} else {
    $_SESSION['error'] = "No client ID provided.";
}
header("Location: index.php");
exit();
?>