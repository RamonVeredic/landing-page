<?php

declare(strict_types=1);

$pageTitle = (string)($pageTitle ?? 'NET.NMS');
$pageDescription = (string)($pageDescription ?? 'NET.NMS Network Management System.');
$cssVersion = (string)($cssVersion ?? (@filemtime(__DIR__ . '/../asset/css/styiles.css') ?: 1));
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
    <meta name="robots" content="noindex,nofollow">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="icon" type="image/png" href="/asset/icon.png">
    <link rel="stylesheet" href="/asset/vendor/bootstrap-icons/bootstrap-icons.min.css?v=1.13.1">
    <link rel="stylesheet" href="/asset/css/styiles.css?v=<?= rawurlencode($cssVersion) ?>">
    <?php $noticeCssVersion = (string)(@filemtime(__DIR__ . '/../asset/css/notice.css') ?: 1); ?>
    <link rel="stylesheet" href="/asset/css/notice.css?v=<?= rawurlencode($noticeCssVersion) ?>">
</head>
