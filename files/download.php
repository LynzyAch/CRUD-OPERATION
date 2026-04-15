<?php

session_start();

if (isset($_GET['file'])) {
    $file = basename($_GET['file']);
    $filePath = "uploads_file/" . $file;

    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream'); 
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));

        readfile($filePath);
        $_SESSION["message"] = "File found!";
        exit();
    } else {
        $_SESSION["error"] = "File not found!";
    }
}

?>