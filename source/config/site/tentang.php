<?php
declare(strict_types=1);
$navCurrent = 'tentang';
$pageTitle = 'Tentang NET.NMS — Dibangun dari kebutuhan jaringan';
$pageDescription = 'Alasan NET.NMS dikembangkan, tujuan dan pendekatan pengembangan aplikasi pengelolaan jaringan.';
?>
<!doctype html>
<html lang="id">
<?php require __DIR__ . '/partials/head.php'; ?>
<body>
<a class="skip-link" href="#main-content">Lewati ke konten utama</a>
<div class="landing-shell information-shell">
    <?php require __DIR__ . '/partials/navbar.php'; ?>
    <main class="information-main" id="main-content">
        <article class="about-page">
            <header class="information-header">
                <span class="eyebrow">TENTANG PROYEK</span>
                <h1>Dibangun untuk orang yang <em>menjaga jaringan.</em></h1>
                <p>NET.NMS lahir dari kebutuhan memahami kondisi jaringan di lapangan. Tujuannya sederhana: menghadirkan informasi yang terstruktur, mudah dibaca, dan relevan dengan pekerjaan teknis sehari-hari.</p>
            </header>
            <div class="information-grid">
                <section class="information-card">
                    <span class="section-kicker">01 / TUJUAN</span>
                    <h2>Visibilitas yang lebih baik</h2>
                    <p>NET.NMS dirancang membantu pemantauan OLT, ONU, dan perangkat jaringan terkait. Informasi status dan sinyal lebih berguna ketika dapat ditelusuri dalam satu alur.</p>
                </section>
                <section class="information-card">
                    <span class="section-kicker">02 / PENDEKATAN</span>
                    <h2>Berangkat dari kebutuhan nyata</h2>
                    <p>Prioritas pengembangan mengikuti kebutuhan operasional: kemudahan menemukan perangkat, memahami perubahan, dan membantu langkah penanganan.</p>
                </section>
                <section class="information-card information-card-wide">
                    <span class="section-kicker">03 / PENGEMBANGAN</span>
                    <h2>Bertahap, terbuka terhadap evaluasi</h2>
                    <p>Pembuatan aplikasi memanfaatkan bantuan kecerdasan buatan dengan arahan dan peninjauan manusia. Implementasi dan kemampuan tiap fitur tetap perlu diverifikasi pada lingkungan serta perangkat yang digunakan.</p>
                    <p>Dokumentasi diperlakukan sebagai bagian dari produk, bukan sekadar lampiran. Karena itu panduan aplikasi dan referensi teknis dikumpulkan dalam satu pusat dokumentasi yang dapat dikembangkan dari waktu ke waktu.</p>
                </section>
            </div>
            <section class="about-copy section-heading">
                <span class="section-kicker">PELAJARI LEBIH LANJUT</span>
                <h2>Mulai dari dokumentasi, lanjutkan ke penggunaan.</h2>
                <p>Pelajari alur penggunaan, referensi OID, dan panduan integrasi sebelum menambahkan perangkat atau menyiapkan lingkungan aplikasi.</p>
                <div class="about-actions">
                    <a class="button button-primary button-lg" href="/dokumentasi">Pusat dokumentasi <i class="bi bi-arrow-up-right"></i></a>
                    <a class="button button-ghost button-lg" href="/">Kembali ke beranda <i class="bi bi-arrow-left"></i></a>
                </div>
            </section>
        </article>
    </main>
    <?php require __DIR__ . '/partials/footer.php'; ?>
</div>
</body>
</html>
