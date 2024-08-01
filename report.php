<?php session_start() ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PDSpatKlin Surabaya SURAMADENUSRA XIII</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <!-- Tambahkan CSS Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body style="background: url('assets/img/background.jpg');background-size: cover;background-repeat: no-repeat;background-position: center;">
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow">
                    <div class="card-body py-5">

                        <div class="d-flex justify-content-center">
                            <img src="assets/img/logo.png" alt="" class="img-fluid w-50">
                        </div>

                        <h3 class="text-center">REPORT</h3>
                        <hr />
                        <?php
                            include 'koneksi.php';

                            $execute = $conn->query("SELECT tipe FROM kehadiran GROUP BY tipe ORDER BY tipe ASC");
                            while ($see = mysqli_fetch_object($execute)):
                        ?>

                            <a href="aksi.php?report=<?= $see->tipe ?>" class="btn btn-success mb-2">Export excel <?= $see->tipe ?></a>
                            
                        <?php endwhile ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center text-lg-start py-2 mt-5">
        <div class="container">
            <div class="text-center my-4">
                <p class="mb-0">Web Design and Organized by <a href="www.zamilcreator.com">ZamilCretor</a></p>
                <!-- This website made with ❤️ By Irfan from Beasteri  -->
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if (!empty($_SESSION['message'])) : ?>
        <script>
            Swal.fire({
                icon: "<?= $_SESSION['message']['type'] ?>",
                title: "<?= $_SESSION['message']['text'] ?>",
                text: "<?= $_SESSION['message']['deskripsi'] ?? "" ?>",
                // showConfirmButton: false,
                // timer: 4000
            });
        </script>
    <?php endif ?>
</body>

</html>

<?php session_destroy(); ?>

