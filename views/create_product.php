<?php
// create_product.php - Create or Edit Product View
$pageTitle = isset($_GET['id']) ? 'Edit Product' : 'Create Product';
include '../includes/header.php';
include '../includes/sidebar.php';
require_once '../includes/database.php';

$product_id = $_GET['id'] ?? null;
$product = [];
$product_units = [];
$product_attributes = [];

// Fetch product details if editing
if ($product_id) {
    try {
        // Fetch product data
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        // Fetch product units (break-apart data)
        $stmt_units = $conn->prepare("SELECT * FROM product_units WHERE product_id = ?");
        $stmt_units->execute([$product_id]);
        $product_units = $stmt_units->fetchAll(PDO::FETCH_ASSOC);

        // Fetch product attributes
        $stmt_attrs = $conn->prepare(
            "SELECT pa.name, pa.values FROM product_attribute_relationship pr 
             JOIN product_attributes pa ON pr.attribute_id = pa.id 
             WHERE pr.product_id = ?"
        );
        $stmt_attrs->execute([$product_id]);
        $product_attributes = $stmt_attrs->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error fetching product data: " . $e->getMessage());
    }
}
?>

<!-- Include TinyMCE -->
<script src="https://cdn.tiny.cloud/1/6rfp0d3ozdb83tnp8lkj0rwn87vav54hamrx6apnp4bjwoxt/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea.wysiwyg',
        height: 200,
        plugins: 'advlist autolink lists link image charmap print preview anchor',
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat'
    });
</script>

<div class="content-area">
    <h1><?php echo isset($product_id) ? 'Edit Product' : 'Create New Product'; ?></h1>

    <!-- Product Form -->
    <form method="POST" action="../controllers/ProductController.php?action=store" enctype="multipart/form-data">
        <!-- Hidden Product ID for Edit -->
        <?php if ($product_id): ?>
            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <?php endif; ?>

        <!-- Basic Information Section -->
        <div class="section-container">
            <h2 class="section-title">Basic Information</h2>
            <div class="section-content">
                <label>Product Name: <input type="text" name="title" value="<?php echo htmlspecialchars($product['title'] ?? ''); ?>" required></label>
                <label>Short Description: <textarea name="short_description" class="wysiwyg" maxlength="1000"><?php echo htmlspecialchars($product['short_description'] ?? ''); ?></textarea></label>
                <label>Long Description: <textarea name="description" class="wysiwyg"><?php echo htmlspecialchars($product['description'] ?? ''); ?></textarea></label>
                <label>Product Images: <input type="file" name="images[]" multiple></label>
            </div>
        </div>

        <!-- Product Data Section -->
        <div class="section-container">
            <h2 class="section-title">Product Data</h2>
            <label>Product Type:
                <select name="product_type">
                    <option value="simple" <?php echo ($product['product_type'] ?? '') === 'simple' ? 'selected' : ''; ?>>Simple</option>
                    <option value="grouped" <?php echo ($product['product_type'] ?? '') === 'grouped' ? 'selected' : ''; ?>>Grouped/Bundle</option>
                    <option value="variable" <?php echo ($product['product_type'] ?? '') === 'variable' ? 'selected' : ''; ?>>Variable</option>
                </select>
            </label>
        </div>

        <!-- Inventory Section -->
        <div class="section-container">
            <h3>Inventory</h3>
            <label>SKU: <input type="text" name="sku" value="<?php echo htmlspecialchars($product['sku'] ?? ''); ?>" required></label>
            <label>Stock Quantity: <input type="number" name="stock_quantity" value="<?php echo htmlspecialchars($product['stock_quantity'] ?? ''); ?>"></label>
            <!-- Break-apart functionality -->
            <h4>Break Apart Options</h4>
            <?php foreach ($product_units as $unit): ?>
                <div>
                    <label>Name: <input type="text" name="unit_name[]" value="<?php echo htmlspecialchars($unit['unit_name']); ?>"></label>
                    <label>SKU: <input type="text" name="unit_sku[]" value="<?php echo htmlspecialchars($unit['unit_sku']); ?>"></label>
                    <label>Quantity: <input type="number" name="unit_qty[]" value="<?php echo htmlspecialchars($unit['unit_qty']); ?>"></label>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Attributes Section -->
        <div class="section-container">
            <h3>Attributes</h3>
            <?php foreach ($product_attributes as $attribute): ?>
                <div>
                    <label>Attribute Name: <input type="text" name="attribute_name[]" value="<?php echo htmlspecialchars($attribute['name']); ?>"></label>
                    <label>Values: <input type="text" name="attribute_values[]" value="<?php echo htmlspecialchars($attribute['values']); ?>"></label>
                </div>
            <?php endforeach; ?>
            <button type="button" onclick="addNewAttribute()">Add New Attribute</button>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn-create">Save Product</button>
    </form>
</div>

<script>
    function addNewAttribute() {
        const container = document.querySelector('.section-container:last-child');
        const div = document.createElement('div');
        div.innerHTML = `
            <label>Attribute Name: <input type="text" name="attribute_name[]"></label>
            <label>Values: <input type="text" name="attribute_values[]"></label>
        `;
        container.appendChild(div);
    }
</script>

<?php include '../includes/footer.php'; ?>
