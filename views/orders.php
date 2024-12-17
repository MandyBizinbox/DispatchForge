<?php
// orders.php - Manage Orders View
$pageTitle = 'Orders';
include '../includes/header.php';
include '../includes/sidebar.php';
?>

<div class="content-area" style="margin-left: 180px; margin-top: 40px; padding: 20px;">
    <h1>Manage Orders</h1>
    <p>View, update, and manage all your orders here.</p>

    <table class="orders-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Total</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Sample Data Rows -->
            <tr>
                <td>#001</td>
                <td>John Doe</td>
                <td>Pending</td>
                <td>$150.00</td>
                <td>2024-06-17</td>
                <td>
                    <a href="#" class="btn-view">View</a>
                    <a href="#" class="btn-edit">Edit</a>
                    <a href="#" class="btn-delete">Delete</a>
                </td>
            </tr>
            <tr>
                <td>#002</td>
                <td>Jane Smith</td>
                <td>Shipped</td>
                <td>$250.00</td>
                <td>2024-06-16</td>
                <td>
                    <a href="#" class="btn-view">View</a>
                    <a href="#" class="btn-edit">Edit</a>
                    <a href="#" class="btn-delete">Delete</a>
                </td>
            </tr>
            <!-- More rows will be dynamically generated -->
        </tbody>
    </table>
</div>

<style>
.orders-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
.orders-table th, .orders-table td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
}
.orders-table th {
    background-color: #474E93;
    color: white;
}
.orders-table tr:nth-child(even) {
    background-color: #f2f0ef;
}
.orders-table tr:hover {
    background-color: #D5E7B5;
}
.btn-view, .btn-edit, .btn-delete {
    padding: 5px 10px;
    margin: 2px;
    border-radius: 4px;
    color: white;
    text-decoration: none;
    font-size: 12px;
}
.btn-view {
    background-color: #72BAA9;
}
.btn-edit {
    background-color: #7E5CAD;
}
.btn-delete {
    background-color: #E57373;
}
.btn-view:hover, .btn-edit:hover, .btn-delete:hover {
    opacity: 0.8;
}
</style>

<?php include '../includes/footer.php'; ?>
