<?php
declare(strict_types=1);
$pageTitle = (string)($pageTitle ?? 'NET.NMS — Network Management');
$pageDescription = (string)($pageDescription ?? 'Pemantauan dan pengelolaan jaringan yang lebih terarah bersama NET.NMS.');
$cssVersion = (string)(@filemtime(__DIR__ . '/../asset/css/styiles.css') ?: 1);
$jsVersion = (string)(@filemtime(__DIR__ . '/../asset/js/script.js') ?: 1);
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
    <meta name="theme-color" content="#071b29">
    <meta name="robots" content="noindex,nofollow">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="icon" type="image/png" href="/asset/icon.png">
    <link rel="stylesheet" href="/asset/vendor/bootstrap-icons/bootstrap-icons.min.css?v=1.13.1">
    <link rel="stylesheet" href="/asset/css/styiles.css?v=<?= rawurlencode($cssVersion) ?>">
    <script defer src="/asset/js/script.js?v=<?= rawurlencode($jsVersion) ?>"></script>
</head>
