<?php
require 'config/database.php';
require 'classes/gudang.php';

$db = new Database();
$db = $db->getConnection();
$gudang = new Gudang($db);

$editMode = isset($_GET['id']) != NULL ? true : false;

$data;
if ($editMode) {
    $id = $_GET['id'];
    $stmt = $gudang->findById($id);
    $data;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    if (!isset($data[0])) {
        $db = NULL;
        header('Location: ./index.php');
        exit();
    }
    $data = $data[0];
}
$db = NULL;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Warehouse MSIB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#"></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gudang
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="index.php">Daftar Gudang</a></li>
                            <li><a class="dropdown-item" href="form.php">Tambah Gudang Baru</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <!-- Form Create -->
        <?php if (!$editMode) : ?>
            <div class="card mt-3">
                <div class="card-header">
                    <h4>Tambah Gudang Baru</h4>
                </div>
                <div class="card-body">
                    <form action="classes/process.php" method="post">
                        <input type="hidden" value="create" name="process">
                        <div class="mb-2">
                            <label for="nama" class="form-label">Nama Gudang</label>
                            <input type="text" class="form-control" id="nama" name="name" required>
                        </div>
                        <div class="mb-2">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="name" name="location" required>
                        </div>
                        <div class="mb-2">
                            <label for="name" class="form-label">Kapasitas</label>
                            <input type="number" class="form-control" id="name" name="capacity" min="0" required>
                        </div>
                        <div class="mb-2">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="1" selected>Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="name" class="form-label">Jam Buka</label>
                            <input type="time" class="form-control" id="name" name="opening_hour" required>
                        </div>
                        <div class="mb-2">
                            <label for="name" class="form-label">Jam Tutup</label>
                            <input type="time" class="form-control" id="name" name="closing_hour" required>
                        </div>
                        <div class="mb-2">
                            <a href="index.php" class="btn btn-warning">Kembali ke Daftar Gudang</a>
                            <button class="btn btn-success col-2" type="submit">Tambah Data</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif ?>

        <!-- Form Update -->
        <?php if ($editMode): ?>
            <div class="card mt-3">
                <div class="card-header">
                    <h4>Edit Data </h4>
                </div>
                <div class="card-body">
                    <form action="classes/process.php" method="post">
                        <input type="hidden" value="update" name="process">
                        <input type="hidden" value="<?= $data['id']; ?>" name="id">
                        <div class="mb-2">
                            <label for="nama" class="form-label">Nama Gudang</label>
                            <input type="text" class="form-control" value="<?= $data['name']; ?>" id="nama" name="name" required>
                        </div>
                        <div class="mb-2">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" value="<?= $data['location']; ?>" id="name" name="location" required>
                        </div>
                        <div class="mb-2">
                            <label for="name" class="form-label">Kapasitas</label>
                            <input type="number" class="form-control" value="<?= $data['capacity']; ?>" id="name" name="capacity" min="0" required>
                        </div>
                        <div class="mb-2">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="1" <?= $data['status'] == 'aktif' ? 'selected' : ''; ?>>Aktif</option>
                                <option value="0" <?= $data['status'] == 'tidak_aktif' ? 'selected' : ''; ?>>Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="name" class="form-label">Jam Buka</label>
                            <input type="time" class="form-control" value="<?= $data['opening_hour']; ?>" id="name" name="opening_hour" required>
                        </div>
                        <div class="mb-2">
                            <label for="name" class="form-label">Jam Tutup</label>
                            <input type="time" class="form-control" value="<?= $data['closing_hour']; ?>" id="name" name="closing_hour" required>
                        </div>
                        <div class="mb-2">
                            <a href="index.php" class="btn btn-warning">Kembali ke Daftar Gudang</a>
                            <button class="btn btn-success col-2" type="submit">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>