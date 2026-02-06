<?php
include 'database.php';

if (isset($_GET['action']) && isset($_GET['id'])) {
    
    $action = $_GET['action'];
    $id = intval($_GET['id']);


    if ($action == 'accept' ) {
        $sql = "UPDATE requests SET status = 'accepted' WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
      
    }

    if ($action == 'reject' ) {
        $sql = "UPDATE requests SET status = 'rejected' WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
      
    }

    if ($action == 'update') {
        header("Location: update_request.php?id=$id");
        exit;
    }

   mysqli_close($conn);
}

header("Location: admindashboard.php");
exit;
?>
