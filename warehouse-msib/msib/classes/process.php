<?php
require '../config/database.php';
require 'gudang.php';

$process = $_POST['process'];

$db = new Database();
$db = $db->getConnection();
$gudang = new Gudang($db);

$gudang->name = $_POST['name'];
$gudang->location = $_POST['location'];
$gudang->capacity = $_POST['capacity'];
$gudang->status = $_POST['status'] == '1' ? 'aktif' : 'tidak_aktif';
$gudang->opening_hour = $_POST['opening_hour'];
$gudang->closing_hour = $_POST['closing_hour'];

switch ($process) {
    case 'create':
        $gudang->create();
        break;
    case 'update':
        $gudang->id = $_POST['id'];
        $gudang->update();
        break;
    case 'delete':
        $gudang->id = $_POST['id'];
        $gudang->delete();
        break;
}

$db = NULL;
header('Location: ../index.php');
exit();
