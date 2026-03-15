<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_id'])) {
    header("Location: adminlogin.php");
    exit;
}
$pendingCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM requests WHERE status='pending'"))['c'];
$adminRes = mysqli_query($conn, "SELECT * FROM admin WHERE id='{$_SESSION['admin_id']}'");
$adminRow = mysqli_fetch_assoc($adminRes);
$adminName = isset($adminRow['name']) ? $adminRow['name'] : 'Administrator';
?>

<div class="admin-topbar">
    <div class="admin-brand">
        <span class="logo">#HelpSriLanka</span>
    </div>
    <div class="admin-topbar-actions">
        <a href="admindashboard.php" class="btn-nav-action btn-nav-white"> Dashboard</a>
        <a href="viewvolunteers.php" class="btn-nav-action btn-nav-white"> Volunteers</a>
        <a href="requestdashboard.php" class="btn-nav-action btn-nav-white">
             Requests
            <?php if ($pendingCount > 0): ?>
                <span style="background:#ef4444;color:white;font-size:11px;padding:2px 7px;border-radius:20px;margin-left:4px;"><?php echo $pendingCount; ?></span>
            <?php endif; ?>
        </a>
        <a href="viewusers.php" class="btn-nav-action btn-nav-white"> Users</a>
        <a href="logout.php" class="btn-nav-action btn-nav-white-danger"> Logout</a>
        <div class="admin-profile">
            <span class="admin-avatar">👤</span>
            <span class="admin-name"><?php echo $adminName; ?></span>
        </div>
    </div>
</div>