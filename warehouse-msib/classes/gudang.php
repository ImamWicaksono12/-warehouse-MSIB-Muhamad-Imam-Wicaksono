<?php
class Gudang
{
    private $conn;
    private $table_name = "gudang";

    public $id;
    public $name;
    public $location;
    public $capacity;
    public $status;
    public $opening_hour;
    public $closing_hour;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    #Membuat data Gudang
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . "(name, location, capacity, status, opening_hour, closing_hour) VALUES(:name, :location, :capacity, :status, :opening_hour, :closing_hour)";
        $stmt = $this->conn->prepare($query);


        $stmt->bindParam("name", $this->name);
        $stmt->bindParam("location", $this->location);
        $stmt->bindParam("capacity", $this->capacity);
        $stmt->bindParam("status", $this->status);
        $stmt->bindParam("opening_hour", $this->opening_hour);
        $stmt->bindParam("closing_hour", $this->closing_hour);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    #Membaca seluruh data gudang
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function findById($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam("id", $id);
        $stmt->execute();
        return $stmt;
    }

    #Mengupdate Data Gudang
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET name=:name, location=:location, capacity=:capacity, status=:status, opening_hour=:opening_hour, closing_hour=:closing_hour WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam("name", $this->name);
        $stmt->bindParam("location", $this->location);
        $stmt->bindParam("capacity", $this->capacity);
        $stmt->bindParam("status", $this->status);
        $stmt->bindParam("opening_hour", $this->opening_hour);
        $stmt->bindParam("closing_hour", $this->closing_hour);
        $stmt->bindParam("id", $this->id);


        if ($stmt->execute()) {
            # code...
            return true;
        }
        return false;
    }

    #Menghapus gudang atau non aktif
    public function delete()
    {
        $query = "UPDATE " . $this->table_name . " SET status='tidak_aktif' WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            # code...
            return true;
        }
        return false;
    }
}
