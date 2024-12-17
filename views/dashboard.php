<?php
// dashboard.php - Main Dashboard View
$pageTitle = 'Dashboard';
include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="content-area" style="margin-left: 180px; margin-top: 40px; padding: 20px;">
    <h1>Welcome to DispatchForge</h1>
    <p>This is your central dashboard where you can monitor key metrics and navigate quickly.</p>

    <div class="dashboard-widgets">
        <!-- Dashboard Widget 1 -->
        <div class="widget">
            <h3>Total Products</h3>
            <p>120</p>
        </div>
        
        <!-- Dashboard Widget 2 -->
        <div class="widget">
            <h3>Pending Orders</h3>
            <p>15</p>
        </div>

        <!-- Dashboard Widget 3 -->
        <div class="widget">
            <h3>Low Stock Alerts</h3>
            <p>8 Products</p>
        </div>

        <!-- Dashboard Widget 4 -->
        <div class="widget">
            <h3>Latest Reports</h3>
            <p><a href="/dispatchforge/views/reports.php">View Reports</a></p>
        </div>
    </div>
</div>

<style>
.dashboard-widgets {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}
.widget {
    background-color: #f2f0ef;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    width: 220px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.widget h3 {
    color: #474E93;
    margin-bottom: 10px;
}
.widget p {
    font-size: 18px;
    margin: 0;
}
.widget a {
    text-decoration: none;
    color: #7E5CAD;
}
.widget a:hover {
    color: #72BAA9;
}
</style>

<?php include '../includes/footer.php'; ?>
