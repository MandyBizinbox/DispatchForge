<?php
include '../includes/header.php';
include '../includes/sidebar.php';

// Load settings from JSON
$settings = json_decode(file_get_contents('../settings.json'), true);
?>

<main>
    <h2>Platform Integrations</h2>
    <form method="POST" action="../controllers/SettingsController.php">
        <h3>WooCommerce</h3>
        <label>API Key: <input type="text" name="woocommerce_api_key" value="<?= $settings['woocommerce_api_key'] ?? '' ?>"></label><br>
        <label>API Secret: <input type="text" name="woocommerce_api_secret" value="<?= $settings['woocommerce_api_secret'] ?? '' ?>"></label><br>

        <h3>Takealot</h3>
        <label>API Key: <input type="text" name="takealot_api_key" value="<?= $settings['takealot_api_key'] ?? '' ?>"></label><br>
        <label>API Secret: <input type="text" name="takealot_api_secret" value="<?= $settings['takealot_api_secret'] ?? '' ?>"></label><br>

        <button type="submit">Save Settings</button>
    </form>
</main>

<?php include '../includes/footer.php'; ?>
