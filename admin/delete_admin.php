<?php
require_once '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {

        $stmt = $pdo->prepare("DELETE FROM admin WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: list_admin.php");
            exit();
        } else {
            echo "Error: Unable to execute the query.";
        }

    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
?>
