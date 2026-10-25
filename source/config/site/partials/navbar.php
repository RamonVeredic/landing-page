<?php
declare(strict_types=1);
$brandSubtitle = (string)($brandSubtitle ?? 'Network Management');
$navCurrent = (string)($navCurrent ?? '');
require_once dirname(__DIR__) . '/landing.php';

$landingNav = [
    'beranda' => ['label' => 'Beranda', 'href' => '/'],
    'tentang' => ['label' => 'Tentang', 'href' => '/tentang'],
    'dokumentasi' => ['label' => 'Dokumentasi', 'href' => '/dokumentasi'],
];
?>
<header class="landing-header">
    <a class="brand" href="/" aria-label="NET.NMS beranda">
        <i class="brand-icon bi bi-boxes" aria-hidden="true"></i>
        <span class="brand-copy"><strong>NET.NMS</strong><small>Network Management</small></span>
    </a>
    <div class="landing-header-right">
        <input type="checkbox" id="landingNavToggle" class="nav-toggle-input">
        <label class="nav-toggle-button" for="landingNavToggle" aria-label="Buka menu navigasi"><span></span><span></span><span></span></label>
        <nav class="landing-nav" aria-label="Navigasi utama">
<?php foreach ($landingNav as $navKey => $navItem): ?>
            <a href="<?= htmlspecialchars((string)$navItem['href'], ENT_QUOTES, 'UTF-8') ?>"<?= $navKey === $navCurrent ? ' aria-current="page"' : '' ?>><?= htmlspecialchars((string)$navItem['label'], ENT_QUOTES, 'UTF-8') ?></a>
<?php endforeach; ?>
            <a class="button button-primary" href="<?= htmlspecialchars(landing_nms_href('login'), ENT_QUOTES, 'UTF-8') ?>">Masuk</a>
        </nav>
    </div>
</header>
