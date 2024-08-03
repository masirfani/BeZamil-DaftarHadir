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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
</head>

<body style="background: url('assets/img/background.jpg');background-size: cover;background-repeat: no-repeat;background-position: center;">
    <div class="container mt-5 pt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow" style="min-height: 70vh;">
                    <div class="card-body py-5">
                        <div class="d-flex justify-content-center">
                            <img src="assets/img/logo.png" alt="" class="img-fluid w-50">
                        </div>

                        <h3 class="text-center">Daftar Kehadiran</h3>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div>
                                <a href="kehadiran.php" class="btn btn-info btn-sm">Semua</a>
                                <a href="?tipe=workshop" class="btn btn-info btn-sm">Kehadiran Workshop</a>
                                <a href="?tipe=simposium" class="btn btn-info btn-sm">Kehadiran Simposium</a>
                            </div>
                            <a href="aksi.php?report=semua" class="btn btn-success btn-sm mb-2">Export ke excel</a>
                        </div>
                        <hr>
                        <table id="realtimeTable" class="display">
                            <thead>
                                <tr>
                                    <th>Nomor</th>
                                    <th>Jenis</th>
                                    <th>Name</th>
                                    <th>Notes</th>
                                    <th>Jam</th>
                                    <th>Hari</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

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
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<?php session_destroy(); ?>



<script>
    $(document).ready(function() {
        // Get the URL parameter 'tipe'
        const urlParams = new URLSearchParams(window.location.search);
        const tipe      = urlParams.get('tipe');

        // Initialize DataTable
        var table = $('#realtimeTable').DataTable({
            "pageLength": 50,
            "columns": [{
                    "data": "nomor"
                },
                {
                    "data": "tipe"
                },
                {
                    "data": "nama"
                },
                {
                    "data": "notes"
                },
                {
                    "data": "jam"
                },
                {
                    "data": "hari"
                },
            ],
            "ajax": {
                "url": "data-kehadiran.php",
                "dataSrc": "",
                "data": function(param) {
                    param.tipe = tipe;
                }
            }
        });

        // Function to update table
        function updateTable() {
            table.ajax.reload(null, false);
        }

        // Update table every 5 seconds
        setInterval(updateTable, 5000);
    });
</script>