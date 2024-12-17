<?php
require_once '../includes/database.php';

class ProductController
{
    public function store()
    {
        global $conn;

        try {
            // Product fields
            $product_id = $_POST['product_id'] ?? null; // Check if editing
            $title = $_POST['title'] ?? '';
            $product_type = $_POST['product_type'] ?? 'simple';
            $sku = $_POST['sku'] ?? '';
            $stock_quantity = $_POST['stock_quantity'] ?? 0;
            $short_description = $_POST['short_description'] ?? '';
            $description = $_POST['description'] ?? '';

            if (empty($title) || empty($sku)) {
                die('Product title and SKU are required.');
            }

            if ($product_id) {
                // Update existing product
                $stmt = $conn->prepare("
                    UPDATE products 
                    SET title = ?, product_type = ?, sku = ?, stock_quantity = ?, short_description = ?, description = ?
                    WHERE id = ?
                ");
                $stmt->execute([$title, $product_type, $sku, $stock_quantity, $short_description, $description, $product_id]);
            } else {
                // Insert new product
                $stmt = $conn->prepare("
                    INSERT INTO products (title, product_type, sku, stock_quantity, short_description, description) 
                    VALUES (?, ?, ?, ?, ?, ?)
                ");
                $stmt->execute([$title, $product_type, $sku, $stock_quantity, $short_description, $description]);
                $product_id = $conn->lastInsertId();
            }

            // Save break-apart options (units)
            $this->saveProductUnits($product_id);

            // Save attributes
            $this->saveAttributes($product_id);

            header('Location: ../views/products.php?success=1');
            exit();
        } catch (PDOException $e) {
            die("Error saving product: " . $e->getMessage());
        }
    }

    private function saveProductUnits($product_id)
    {
        global $conn;

        // Delete existing units (if editing)
        $stmt = $conn->prepare("DELETE FROM product_units WHERE product_id = ?");
        $stmt->execute([$product_id]);

        // Save units
        if (!empty($_POST['unit_name'])) {
            foreach ($_POST['unit_name'] as $key => $name) {
                $sku = $_POST['unit_sku'][$key] ?? '';
                $qty = $_POST['unit_qty'][$key] ?? 0;

                if (!empty($name) && !empty($sku)) {
                    $stmt = $conn->prepare("
                        INSERT INTO product_units (product_id, unit_name, unit_sku, unit_qty, unit_type) 
                        VALUES (?, ?, ?, ?, 'box')
                    ");
                    $stmt->execute([$product_id, $name, $sku, $qty]);
                }
            }
        }
    }

    private function saveAttributes($product_id)
    {
        global $conn;

        // Delete existing relationships (if editing)
        $stmt = $conn->prepare("DELETE FROM product_attribute_relationship WHERE product_id = ?");
        $stmt->execute([$product_id]);

        // Save new attributes
        if (!empty($_POST['attribute_name'])) {
            foreach ($_POST['attribute_name'] as $key => $name) {
                $values = $_POST['attribute_values'][$key] ?? '';

                if (!empty($name)) {
                    // Insert attribute
                    $stmt = $conn->prepare("INSERT INTO product_attributes (name, `values`) VALUES (?, ?)");
                    $stmt->execute([$name, $values]);
                    $attribute_id = $conn->lastInsertId();

                    // Link to product
                    $stmt = $conn->prepare("
                        INSERT INTO product_attribute_relationship (product_id, attribute_id)
                        VALUES (?, ?)
                    ");
                    $stmt->execute([$product_id, $attribute_id]);
                }
            }
        }
    }
}

// Handle product creation and editing
$controller = new ProductController();
$action = $_GET['action'] ?? '';

if ($action === 'store') {
    $controller->store();
} else {
    header('Location: ../views/products.php');
    exit();
}
