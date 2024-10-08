<?php
require_once 'classes/gudang.php';
require_once 'config/database.php';

$data = [];
$nomor = 1;

$db = new Database();
$db = $db->getConnection();
$gudang = new Gudang($db);

$stmt = $gudang->read();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}
$db = null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <!-- navbar -->
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

    <!-- content -->
    <div class="container">
        <div class="card mt-4">
            <div class="card-header">
                <h4>Daftar Gudang</h4>
            </div>
            <div class="card-body">
                <div>
                    <a href="form.php" class="btn btn-success col-2">Tambah Data</a>
                </div>
                <table class="table table-striped" id="tabel">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Gudang</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Kapasitas</th>
                            <th scope="col">Status</th>
                            <th scope="col">Waktu Buka</th>
                            <th scope="col">Waktu Tutup</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $item) : ?>
                            <tr>
                                <td><?= $nomor; ?></td>
                                <td><?= $item['name']; ?></td>
                                <td><?= $item['location']; ?></td>
                                <td><?= $item['capacity']; ?></td>
                                <td><?= $item['status'] == 'aktif' ? "Aktif" : "Tidak Aktif"; ?></td>
                                <td><?= $item['opening_hour']; ?></td>
                                <td><?= $item['closing_hour']; ?></td>
                                <td class="d-flex gap-1">
                                    <a href="form.php?id=<?= $item['id']; ?>" class="btn btn-warning"><span class="material-symbols-outlined">
                                            edit
                                        </span>
                                    </a>
                                    <?php if ($item['status'] == 'aktif') :  ?>
                                        <form action="classes/process.php" method="post">
                                            <input type="hidden" value="delete" name="process">
                                            <input type="hidden" value="<?= $item['id']; ?>" name="id">
                                            <button type="submit" class="btn btn-danger">
                                                <span class="material-symbols-outlined">
                                                    delete
                                                </span>
                                            </button>
                                        </form>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php $nomor++;
                        endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/dataTables.js"></script>
    <script>
        let table = new DataTable('#tabel');
    </script>
</body>

</html>