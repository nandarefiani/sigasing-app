<section class="content-header">
    <?php
    if (isset($_POST['button_create'])) {

        $database = new database();
        $db = $database->getConnection();

        $validateSql = "SELECT * FROM lokasi WHERE nama_lokasi = ?";
        $stmt = $db->prepare($validateSql);
        $stmt->bindParam(1, $_POST['nama_lokasi']);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
    ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h5><i class="icon fas fa-ban"></i> Gagal</h5>
                Nama Lokasi Sama Sudah Ada
            </div>
    <?php
        } else {
            $insertSQL = "INSERT INTO lokasi SET nama_lokasi=?";
            $stmt = $db->prepare($insertSQL);
            $stmt->bindParam(1, $_POST['nama_lokasi']);
            if ($stmt->execute()) {
                $_SESSION['hasil'] = true;
                $_SESSION['pesan'] = "Berhasil Simpan Data";
            } else {
                $_SESSION['hasil'] = False;
                $_SESSION['pesan'] = "Gagal Simpan Data";
            }
            echo "<meta http-equiv='refresh' content='0;url=?page=lokasiread'>";
        }
    }
    ?>
    <div class="container-fluid">
        <div class="row mb2">
            <div class="col-sm-6">
                <h1>Tambah Data Lokasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
                    <li class="breadcrumb-item"><a href="?page=lokasiread">Lokasi</a></li>
                    <li class="breadcrumb-item active">Tambah Data</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Lokasi</h3>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <label for="nama_lokasi">Nama Lokasi</label>
                    <input type="text" class="form-control" name="nama_lokasi" required>
                </div>
                <a href="?page=lokasiread" class="btn btn-danger btn-sm float-right">
                    <i class="fa fa-times-circle"></i> Batal
                </a>
                <button type="submit" name="button_create" class="btn btn-success btn-sm float-right">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </form>
        </div>
</section>
<?php include_once "partials/scripts.php" ?>