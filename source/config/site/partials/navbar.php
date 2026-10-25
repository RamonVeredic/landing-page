<?php
declare(strict_types=1);
$navCurrent = (string)($navCurrent ?? '');
$navigation = [
    ['label' => 'Beranda', 'href' => '/', 'key' => 'beranda'],
    ['label' => 'Kemampuan', 'href' => '/#kemampuan', 'key' => 'kemampuan'],
    ['label' => 'Dokumentasi', 'href' => '/dokumentasi', 'key' => 'dokumentasi'],
    ['label' => 'Tentang', 'href' => '/tentang', 'key' => 'tentang'],
];
?>
<header class="landing-header">
    <a class="brand" href="/" aria-label="NET.NMS — Beranda">
        <span class="brand-icon"><i class="bi bi-diagram-3-fill" aria-hidden="true"></i></span>
        <span class="brand-copy"><strong>NET.NMS</strong><small>NETWORK MANAGEMENT</small></span>
    </a>
    <div class="landing-header-right">
        <button type="button" class="nav-toggle-button" data-nav-toggle aria-controls="landing-navigation" aria-expanded="false" aria-label="Buka navigasi">
            <i class="bi bi-list" aria-hidden="true"></i>
        </button>
        <nav class="landing-nav" id="landing-navigation" aria-label="Navigasi utama" data-main-nav>
            <?php foreach ($navigation as $item): ?>
            <a href="<?= htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8') ?>"<?= $navCurrent === $item['key'] ? ' aria-current="page"' : '' ?>><?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') ?></a>
            <?php endforeach; ?>
            <div class="header-actions" aria-label="Akses aplikasi segera hadir">
                <button class="button button-muted" type="button" disabled title="Tautan masuk akan ditambahkan">Masuk <span>Segera hadir</span></button>
                <button class="button button-muted" type="button" disabled title="Tautan pendaftaran akan ditambahkan">Daftar <span>Segera hadir</span></button>
            </div>
        </nav>
    </div>
</header>
