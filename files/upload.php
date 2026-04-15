<?php
session_start();
include "files_db.php";

if (isset($_POST["upload"])) {
    $fileName = $_FILES["file"]["name"];
    $tempFile = $_FILES["file"]["tmp_name"];
    $name  = $_POST['name'];


    $destination = "uploads_file/" . $fileName;

    if (!is_dir("uploads_file")) {
        mkdir("uploads_file");
    }

    if (move_uploaded_file($tempFile, $destination)) {
        mysqli_query($connection, "INSERT INTO files (name, filename) VALUES ('$name','$fileName')");
        $_SESSION["message"] = "Uploaded Successfully!";
        header("Location: upload.php");
        exit();
    } else {
        $_SESSION["error"] = "Uploaded Failed!";
        header("Location: upload.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files Inventory</title>
    <link rel="icon" href="data:,">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <img src="../assets/bg.jpg" id="bg-image" alt="Background Image">

    <nav class="nav-container navbar navbar-expand-md navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand h1 mb-0 tags" href="index.php">Files</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="portfolio()">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../api_itune.php">Itune</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../mail.php">Mailer</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Files</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="px-5 container-fluid" id="home">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="text-light">Uploaded Files</h1>
            <button class="shadow__btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Upload</button>
        </div>

        <div class="table-contain table-responsive mt-4 glass-table-container border border-secondary">
            <table class="table text-center table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">FILENAME</th>
                        <th scope="col">FILES</th>
                        <th scope="col">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $result = mysqli_query($connection, "SELECT * FROM files");
                    
                    while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="text-center">
                            <th scope="row"><?= $row['id'] ?></th>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['filename'] ?></td>
                            <td class="text-center">
                                <a href="uploads_file/<?= $row['filename']; ?>" target="_blank" class="btn btn-sm btn-info me-1 my-2">
                                    View
                                </a>
                                <a href="delete_file.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger me-1 my-2">Delete</a>
                                <a class="btn btn-sm btn-success me-1 my-2" href="download.php?file=<?= $row["filename"];?>">Download</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>

                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-light border border-primary" style="z-index: 2000;">
                <div class="modal-header border-secondary">
                    <h1 class="modal-title fs-5">Add New Client</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control bg-secondary text-white border-0" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload File</label><br>
                            <input type="file" class="bg-secondary text-white border-0" name="file">
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="upload" class="btn btn-primary">Save File</button>
                    </div>
                </form>
            </div>
        </div>
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
    <script src="assets/script.js"></script>
</body>

</html>
<?php mysqli_close($connection); ?>