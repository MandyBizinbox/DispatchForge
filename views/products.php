<?php
// products.php - Manage Products View
$pageTitle = 'Products';
include '../includes/header.php';
include '../includes/sidebar.php';
require_once '../includes/database.php';

// Fetch products from the database
try {
    $stmt = $conn->query("SELECT id, title, sku, regular_price, sale_price, stock_quantity, product_type FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching products: " . $e->getMessage());
}

// Currency setting (to be replaced with dynamic settings when implemented)
$currency = '$';
?>

<div class="content-area">
    <h1>Manage Products</h1>
    <p>View, update, and manage all your products here.</p>

    <!-- Table Header -->
    <div class="table-header">
        <h2>Products List</h2>
        <a href="/dispatchforge/views/create_product.php" class="btn-create">Create New Product</a>
    </div>

    <!-- Products Table -->
    <table class="products-table" style="width: 100%; border-collapse: collapse; text-align: justify;">
        <thead>
            <tr>
                <th style="padding: 12px 10px; border: 1px solid #ddd; background-color: #474E93; color: white;">ID</th>
                <th style="padding: 12px 10px; border: 1px solid #ddd; background-color: #474E93; color: white;">Product Name</th>
                <th style="padding: 12px 10px; border: 1px solid #ddd; background-color: #474E93; color: white;">SKU</th>
                <th style="padding: 12px 10px; border: 1px solid #ddd; background-color: #474E93; color: white;">Regular Price</th>
                <th style="padding: 12px 10px; border: 1px solid #ddd; background-color: #474E93; color: white;">Sale Price</th>
                <th style="padding: 12px 10px; border: 1px solid #ddd; background-color: #474E93; color: white;">Stock</th>
                <th style="padding: 12px 10px; border: 1px solid #ddd; background-color: #474E93; color: white;">Product Type</th>
                <th style="padding: 12px 10px; border: 1px solid #ddd; background-color: #474E93; color: white;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr style="border: 1px solid #ddd;">
                        <td style="padding: 12px 10px; border: 1px solid #ddd;">#<?php echo htmlspecialchars($product['id']); ?></td>
                        <td style="padding: 12px 10px; border: 1px solid #ddd;"><?php echo htmlspecialchars($product['title']); ?></td>
                        <td style="padding: 12px 10px; border: 1px solid #ddd;"><?php echo htmlspecialchars($product['sku']); ?></td>
                        <td style="padding: 12px 10px; border: 1px solid #ddd;"><?php echo $currency . ' ' . number_format($product['regular_price'], 2); ?></td>
                        <td style="padding: 12px 10px; border: 1px solid #ddd;"><?php echo $currency . ' ' . number_format($product['sale_price'], 2) ?: 'N/A'; ?></td>
                        <td style="padding: 12px 10px; border: 1px solid #ddd;"><?php echo htmlspecialchars($product['stock_quantity']); ?></td>
                        <td style="padding: 12px 10px; border: 1px solid #ddd;"><?php echo ucfirst(htmlspecialchars($product['product_type'])); ?></td>
                        <td style="padding: 12px 10px; border: 1px solid #ddd; text-align: center;">
                            <a href="/dispatchforge/views/create_product.php?id=<?php echo $product['id']; ?>" class="btn-edit">Edit</a>

                            <a href="/dispatchforge/controllers/ProductController.php?action=delete&id=<?php echo $product['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="padding: 12px 10px; text-align: center; border: 1px solid #ddd;">No products found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
