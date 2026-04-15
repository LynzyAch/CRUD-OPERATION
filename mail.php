<?php

session_start();

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $to      = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_SPECIAL_CHARS);
    $body    = filter_input(INPUT_POST, 'message', FILTER_DEFAULT);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'joshuaayuda7@gmail.com';
        $mail->Password   = 'yljg zyuz rkvr elpa';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('joshuaayuda7@gmail.com', 'Ayuda Joshua');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        $_SESSION['message'] = "Email sent successfully.";
        header("Location: mail.php"); 
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = "Email failed: Check the SMTP Connection!";
        header("Location: mail.php"); 
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mailer</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <img src="/assets/bg.jpg" id="bg-image" alt="Background Image">

    <nav class="nav-container navbar navbar-expand-md navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand h1 mb-0 tags" href="mail.php">Mailer</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="portfolio()">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="api_itune.php">Itune</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Mailer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="files/upload.php">Files</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="email-contain container-fluid px-5 text-center text-light" id="email-contain">
        <form action="mail.php" method="POST" class="form glass-card" id="email">
            <h3 class="form-title">Send Email</h3>

            <div class="form__group field">
                <input type="email" class="form__field" placeholder="To" id="to" name="email" autocomplete="off">
                <label for="to" class="form__label">To</label>
            </div>

            <div class="form__group field">
                <input type="text" class="form__field" placeholder="Subject" id="subject" name="subject" autocomplete="off">
                <label for="subject" class="form__label">Subject</label>
            </div>

            <div class="form__group field">
                <input type="text" class="form__field" placeholder="Message" id="message" name="message" autocomplete="off">
                <label for="message" class="form__label">Message</label>
            </div>

            <button type="submit" class="shadow__btn mt-4 w-100" onclick="getSearch(event)">Send</button>
        </form>
    </div>

    <?php if (isset($_SESSION['message'])) { ?>
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                icon: 'success',
                title: '<?php echo $_SESSION['message']; ?>',
                background: 'rgb(255, 255, 255)',
                color: '#0059ff'
            });
        </script>
    <?php
        unset($_SESSION['message']);
    } ?>

    <?php if (isset($_SESSION['error'])) { ?>
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                icon: 'error',
                title: '<?php echo $_SESSION['error']; ?>',
                background: 'rgb(255, 255, 255)',
                color: '#0025fa'
            });
        </script>
    <?php
        unset($_SESSION['error']);
    } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>