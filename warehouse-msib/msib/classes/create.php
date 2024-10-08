<?php

include '../config/database.php';
include '../classes/gudang.php';


$database = new Database();
$db = $database->getConnection();

$gudang = new Gudang($db);
if (isset($_POST['name'])) {
    $gudang->name = $_POST['name'];
    $gudang->location = $_POST['location'];
    $gudang->capacity = $_POST['capacity'];
    $gudang->status = $_POST['status'];
    $gudang->opening_hour = $_POST['opening_hour'];
    $gudang->closing_hour = $_POST['closing_hour'];


    if ($gudang->create()) {
        # code...
        echo "gudang Berhasil Ditambahkan.";
        $_POST = [];
    } else {
        echo "Gudang Gagal Ditambahkan.";
    }
}
?>
<form method="post">
    <label>Name</label>
    <input type="text" name="name" <br>
    <label>location</label>
    <input type="text" name="location" <br>
    <label>Capacity</label>
    <input type="text" name="capacity"></br>
    <label>Status</label>
    <!-- <input type="text" name="status"></br> -->
    <label>Status</label>
    <select name="status">
        <option value="aktif">Aktif</option>
        <option value="tidak_aktif">Tidak Aktif</option>
    </select><br>
    <label>Opening_hour</label>
    <input type="text" name="opening_hour"><br>
    <label>Closing_hour</label>
    <input type="text" name="closing_hour"><br>
    <button type="submit">Create Data</button>
    <br>
    <a href="index.php">Back to Warehouse Management</a>
</form>