<?php
include "../db-config.php";

// Check if the ID is provided
if (!isset($_GET['id'])) {
    header("Location: register-history.php"); // Redirect if no ID is provided
    exit();
}

$id = $_GET['id'];

// Prepare and execute the delete query
$delete_query = "DELETE FROM pendaftaran WHERE id = ?";
$stmt = $conn->prepare($delete_query);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: register-history.php?msg=Record deleted successfully"); // Redirect after successful deletion
    exit();
} else {
    header("Location: register-history.php?msg=Failed to delete record"); // Redirect if deletion fails
    exit();
}
?>
