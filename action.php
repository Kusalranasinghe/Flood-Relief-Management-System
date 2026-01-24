<?php
include 'database.php';

if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $id = intval($_GET['id']);

    if ($action == 'accept' || $action == 'reject' || $action == 'delete') {
        $sql = "DELETE FROM requests WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
      
    }

   mysqli_close($conn);
}

header("Location: admindashboard.php");
exit;
?>
