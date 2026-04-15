<?php
session_start();
require 'db_connection.php';

$sql = "SELECT * FROM clients";
$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <img src="assets/bg.jpg" id="bg-image" alt="Background Image">

    <nav class="nav-container navbar navbar-expand-md navbar-dark fixed-top">
        <div class="container-fluid">
           <a class="navbar-brand h1 mb-0 tags" href="index.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="portfolio()">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="api_itune.php">Itune</a>
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

    <div class="px-5 container-fluid" id="home">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="text-light">Client List</h1>
            <button class="shadow__btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Client</button>
        </div>

        <div class="table-contain table-responsive mt-4 glass-table-container border border-secondary">
            <table class="table text-center table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="text-center">
                            <th scope="row"><?= $row['id'] ?></th>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><span class="badge <?= $row['status'] === 'Active' ? 'bg-success' : 'bg-secondary' ?>"><?= $row['status'] ?></span></td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning me-1 my-2 edit-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal"
                                    data-id="<?= $row['id'] ?>"
                                    data-name="<?= $row['name'] ?>"
                                    data-email="<?= $row['email'] ?>"
                                    data-status="<?= $row['status'] ?>">
                                    Edit
                                </button>
                                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this client?')" class="btn btn-sm btn-danger me-1 my-2">Delete</a>
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
                <form action="add.php" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Fullname</label>
                            <input type="text" class="form-control bg-secondary text-white border-0" name="fullname" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control bg-secondary text-white border-0" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select bg-secondary text-white border-0" name="status" required>
                                <option value="" selected disabled>Select Status</option>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-light border border-warning" style="z-index: 2000;">
                <div class="modal-header border-secondary">
                    <h1 class="modal-title fs-5">Edit Client Data</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="edit.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">

                        <div class="mb-3">
                            <label class="form-label">Fullname</label>
                            <input type="text" class="form-control bg-secondary text-white border-0" name="fullname" id="edit-fullname" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control bg-secondary text-white border-0" name="email" id="edit-email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select bg-secondary text-white border-0" name="status" id="edit-status" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Update Client</button>
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