<?php

declare(strict_types=1);

$brandSubtitle = 'Tentang Aplikasi';
$navCurrent = 'tentang';
$cssVersion = (string)(@filemtime(__DIR__ . '/asset/css/styiles.css') ?: 1);
$pageTitle = 'Tentang NET.NMS · Pengelolaan Jaringan Terpusat';
$pageDescription = 'Kenali NET.NMS, aplikasi pemantauan dan pengelolaan jaringan yang dikembangkan dari kebutuhan operasional sehari-hari dan masukan pengguna.';
?>
<!doctype html>
<html lang="id">
<?php require __DIR__ . '/partials/head.php'; ?>
<body>
<div class="landing-shell information-shell">
    <?php require __DIR__ . '/partials/navbar.php'; ?>

    <main class="information-main">
        <article class="about-page" aria-labelledby="about-title">
            <header>
                <p class="eyebrow"><span></span> Tentang NET.NMS</p>
                <h1 id="about-title">Berawal dari kebutuhan.<br>Berkembang bersama pengguna.</h1>
                <div class="about-copy">
                    <p>Memahami kondisi jaringan adalah bagian penting dari pekerjaan sehari-hari. NET.NMS hadir untuk membantu Anda memantau perangkat, menelusuri perubahan, dan mengelola informasi jaringan dari satu tempat.</p>
                </div>
            </header>

            <div class="information-grid">
                <section class="information-card" aria-labelledby="about-purpose-title">
                    <span class="section-kicker">Tujuan kami</span>
                    <h2 id="about-purpose-title">Membuat pemantauan lebih sederhana</h2>
                    <p>Status perangkat, kondisi sinyal, dan aktivitas jaringan disajikan secara ringkas agar lebih mudah diperiksa. Tujuannya membantu Anda mengenali kondisi jaringan dan menentukan tindak lanjut.</p>
                </section>

                <section class="information-card" aria-labelledby="about-origin-title">
                    <span class="section-kicker">Awal perjalanan</span>
                    <h2 id="about-origin-title">Dibangun dari penggunaan sehari-hari</h2>
                    <p>NET.NMS berangkat dari kebutuhan operasional di lapangan. Pengalaman penggunaan langsung menjadi dasar untuk menyempurnakan fitur, memperjelas tampilan, dan memperbaiki alur kerja.</p>
                </section>

                <section class="information-card information-card-wide" aria-labelledby="about-development-title">
                    <span class="section-kicker">Proses pengembangan</span>
                    <h2 id="about-development-title">Bantuan AI, dengan arahan manusia</h2>
                    <p>Kecerdasan buatan menjadi bagian dari proses pembuatan NET.NMS. Pemilik proyek menentukan kebutuhan, memberi arahan, meninjau hasil, dan melakukan pengujian pada lingkungan yang tersedia.</p>
                    <p>Pengembangan dilakukan bertahap, dengan ruang untuk evaluasi dan perbaikan. Hasil dari AI tetap perlu diperiksa, sementara pengalaman pengguna membantu menemukan hal-hal yang belum terjangkau dalam pengujian.</p>
                </section>
            </div>

            <section class="about-copy section-heading" aria-labelledby="about-feedback-title">
                <h2 id="about-feedback-title">Masukan Anda ikut membentuk NET.NMS</h2>
                <p>NET.NMS terus berkembang. Jika ada alur yang membingungkan, kendala penggunaan, atau fitur yang Anda butuhkan, ceritakan kepada kami. Masukan tersebut membantu menentukan perbaikan berikutnya.</p>
                <div class="about-actions">
                    <a class="button button-primary button-large" href="/#masukan">Kirim masukan</a>
                    <a class="button button-ghost button-large" href="/dokumentasi">Lihat dokumentasi OID</a>
                </div>
            </section>
        </article>
    </main>

    <?php require __DIR__ . '/partials/footer.php'; ?>
</div>
</body>
</html>
