<?php
include_once '../config/database.php';
include_once 'gudang.php';

$database = new Database();
$db = $database->getConnection();

$gudang = new Gudang($db);
$stmt = $gudang->read();

echo "<table border='1'>";
echo "<tr><th>ID</th><th>Name</th><th>Location</th><th>Capacity</th><th>Status</th><th>Opening Hour</th><th>Closing Hour</th></tr>";

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['location']}</td>
            <td>{$row['capacity']}</td>
            <td>{$row['status']}</td>
            <td>{$row['opening_hour']}</td>
            <td>{$row['closing_hour']}</td>
            <td><a href='update.php?id={$row['id']}'>Edit</a> | <a href='delete.php?id={$row['id']}'>Delete</a></td>
        </tr>";
}
echo "</table>";
