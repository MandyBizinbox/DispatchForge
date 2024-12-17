<?php
// header.php - Reusable header file
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'DispatchForge'; ?></title>
    <link rel="stylesheet" href="/dispatchforge/assets/css/style.css">
    <script src="/dispatchforge/assets/js/main.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Fixed Header -->
    <header class="fixed-header">
        <div class="logo">
            <a href="/dispatchforge/index.php"><strong>DispatchForge</strong></a>
        </div>
    </header>

    <!-- Content Area Wrapper -->
    <div class="content-area-wrapper" style="margin-top: 40px; margin-left 180px">
