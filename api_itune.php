<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Itune API | Apple</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    
    <img src="assets/bg.jpg" id="bg-image" alt="Background Image">

    <nav class="nav-container navbar navbar-expand-md navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand h1 mb-0 tags" href="#">ITUNE by Apple</a>
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
                        <a class="nav-link active" href="#">Itune</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mail.php">Mailer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="files/upload.php">Files</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" id="api">
        <div class="glass-search-container mb-4 text-center mx-auto" style="max-width: 700px;">
            <h3 class="search-title text-light">SEARCH ITUNE CONTENTS</h3>
            <form class="d-flex justify-content-center mt-3" id="search-form">
                <input class="form-control me-3 glass-search w-75" type="search" placeholder="Search (e.g., 'Justin Bieber Songs', or any 'Podcast')" id="search-input" autocomplete="off" required>
                <button class="shadow__btn" type="submit">Search</button>
            </form>
        </div>
    </div>

    <div class="api-contain container-fluid border" id="api-contain"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/script.js"></script>
</body>

</html>