<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settings = [
        'woocommerce_api_key' => $_POST['woocommerce_api_key'],
        'woocommerce_api_secret' => $_POST['woocommerce_api_secret'],
        'takealot_api_key' => $_POST['takealot_api_key'],
        'takealot_api_secret' => $_POST['takealot_api_secret']
    ];
    file_put_contents('../settings.json', json_encode($settings));
    header('Location: ../views/settings.php?success=1');
}
?>
