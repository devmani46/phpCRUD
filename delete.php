<?php
require 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (filter_var($id, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
        $db = new Database();
        $conn = $db->getConnection();

        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: Could not execute the delete operation.";
        }
    } else {
        echo "Invalid ID.";
    }
} else {
    echo "ID not specified.";
}
?>
