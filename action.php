<?php
include 'database.php';

if (isset($_GET['action']) && isset($_GET['id'])) {

    $action = $_GET['action'];
    $id = intval($_GET['id']);

    if ($action == 'accept') {
        $sql = "UPDATE requests SET status = 'accepted', act_date = NOW() WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        mysqli_close($conn);
        header("Location: requestdashboard.php");
        exit;
    }

    if ($action == 'reject') {
        $sql = "UPDATE requests SET status = 'rejected', act_date = NOW() WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        mysqli_close($conn);
        header("Location: requestdashboard.php");
        exit;
    }

    if ($action == 'update') {
        header("Location: update_request.php?id=$id");
        exit;
    }

    if ($action == 'delete') {
        $sql = "DELETE FROM requests WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        mysqli_close($conn);
        header("Location: userdashboard.php");
        exit;
    }

    if ($action == 'delete_user') {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        mysqli_close($conn);
        header("Location: viewusers.php");
        exit;
    }
}

header("Location: admindashboard.php");
exit;
?>