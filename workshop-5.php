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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card border-0 shadow">
                    <div class="card-body">

                        <div class="d-flex justify-content-center">
                            <img src="assets/img/logo.png" alt="" class="img-fluid w-50">
                        </div>
                        <h3 class="text-center">Daftar Kehadiran<br>Workshop 5: Blood Bank and Transfusion Medicine</h3>

                        <hr />
                        <form action="aksi.php" method="POST">
                        <input type="hidden" name="tipe" value="Workshop 5: Blood Bank and Transfusion Medicine">
                            <label for="name">Nama Lengkap Tanpa Gelar</label>
                            <select name="nama" id="name" class="form-control form-control-lg"></select>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="sudah" name="goodybag" id="flexCheckChecked" checked />
                                <label class="form-check-label" for="flexCheckChecked">Sudah terima Goodybag</label>
                            </div>
                            <label class="mt-3">Notes</label>
                            <textarea name="notes" class="form-control" placeholder="Tuliskan permintaan anda..."></textarea>
                            <button type="submit" class="btn btn-success mt-4 w-100">Simpan</button>
                        </form>
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
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2
            $("#name").select2();

            // Ganti dengan ID spreadsheet dan nama sheet Anda
            var spreadsheetID = "1y5LOgvsThQ1Nxhya8yoTnqqU2caVaAJPL_2AA0MQfzM";
            var sheetName = "Rekap gabungan"; // Ganti dengan nama sheet Anda

            // URL untuk mendapatkan data dari Google Sheets sebagai CSV
            var url = `https://docs.google.com/spreadsheets/d/${spreadsheetID}/gviz/tq?sheet=${sheetName}&tqx=out:csv`;

            // Mengambil data menggunakan jQuery AJAX
            $.ajax({
                url: url,
                dataType: "text",
                success: function(data) {
                    // Memproses data CSV
                    var rows = data.split("\n");
                    var options = "";

                    rows.forEach(function(row, index) {
                        var cells = row.split(",");
                        if (cells.length > 0) {
                            var nama = cells[6].replace(/"/g, "");
                            nama = nama.replace("NAMA", "Masukkan Nama Anda...");
                            nama = nama.replace("dr.", "");
                            nama = nama.replace("Dr.", "");
                            nama = nama.replace("Dr", "");
                            nama = nama.replace("DR", "");
                            nama = nama.replace("DR.", "");
                            nama = nama.replace("dR.", "");
                            nama = nama.replace("dr", "");
                            // Menambahkan opsi ke dalam Select2
                            options += `<option value="${nama}">${nama}</option>`;
                        }
                    });

                    // Menambahkan opsi ke elemen <select>
                    $("#name").html(options).trigger("change"); // Memicu perubahan untuk Select2
                },
                error: function() {
                    $("#data").html("<p>Terjadi kesalahan saat memuat data.</p>");
                },
            });
        });
    </script>
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

