<?php
declare(strict_types=1);

$navCurrent = 'beranda';
$pageTitle = 'NET.NMS — Pantau jaringan, pahami setiap perubahan';
$pageDescription = 'NET.NMS membantu tim jaringan memantau OLT, ONU, status perangkat dan sinyal dalam satu alur kerja. Jelajahi fitur dan dokumentasi teknis.';
?>
<!doctype html>
<html lang="id">
<?php require __DIR__ . '/partials/head.php'; ?>
<body>
<a class="skip-link" href="#main-content">Lewati ke konten utama</a>
<div class="site-shell">
    <?php require __DIR__ . '/partials/navbar.php'; ?>

    <main id="main-content">
        <section class="hero" aria-labelledby="hero-title">
            <div class="hero-mesh" aria-hidden="true"></div>
            <div class="container hero-grid">
                <div class="hero-copy">
                    <span class="eyebrow eyebrow-light"><span class="eyebrow-dot"></span> Network operations, made clearer</span>
                    <h1 id="hero-title">Jaringan kompleks.<br><em>Kendali lebih jelas.</em></h1>
                    <p class="hero-lead">Dari OLT hingga ONU, status perangkat hingga sinyal—NET.NMS membantu Anda melihat informasi yang penting tanpa kehilangan konteks di lapangan.</p>
                    <div class="hero-actions">
                        <a class="button button-primary button-lg" href="/dokumentasi">Jelajahi dokumentasi <i class="bi bi-arrow-up-right" aria-hidden="true"></i></a>
                        <a class="button button-outline button-lg" href="#kemampuan">Lihat kemampuan <i class="bi bi-arrow-down" aria-hidden="true"></i></a>
                    </div>
                    <div class="hero-note"><i class="bi bi-info-circle" aria-hidden="true"></i> Daftar dan masuk akan tersedia setelah tautan aplikasi disiapkan.</div>
                    <div class="hero-bottom"><span class="line-decor" aria-hidden="true"></span><span>Dirancang untuk alur kerja pengelolaan jaringan.</span></div>
                </div>

                <div class="showcase" aria-label="Ilustrasi antarmuka pemantauan NET.NMS, bukan data jaringan langsung">
                    <div class="showcase-glow" aria-hidden="true"></div>
                    <div class="showcase-window">
                        <div class="showcase-sidebar" aria-hidden="true">
                            <span class="mini-mark">N</span>
                            <i class="bi bi-grid-1x2-fill active"></i>
                            <i class="bi bi-diagram-3"></i>
                            <i class="bi bi-hdd-network"></i>
                            <i class="bi bi-activity"></i>
                            <span class="sidebar-spacer"></span>
                            <i class="bi bi-gear"></i>
                        </div>
                        <div class="showcase-main">
                            <div class="showcase-bar">
                                <span class="screen-crumb">Workspace <i class="bi bi-chevron-right"></i> Overview</span>
                                <span class="screen-avatar" aria-hidden="true">N</span>
                            </div>
                            <div class="showcase-title-row"><div><span class="screen-label">NETWORK OVERVIEW</span><h2>Pusat pemantauan</h2></div><span class="screen-demo">Tampilan ilustrasi</span></div>
                            <div class="metric-grid">
                                <div class="metric-card"><span><i class="bi bi-hdd-stack"></i> OLT</span><strong>Perangkat</strong><small>Kelola node utama</small></div>
                                <div class="metric-card"><span><i class="bi bi-router"></i> ONU</span><strong>Status</strong><small>Pantau konektivitas</small></div>
                                <div class="metric-card"><span><i class="bi bi-reception-4"></i> Optik</span><strong>Sinyal</strong><small>Tinjau kondisi jalur</small></div>
                            </div>
                            <div class="screen-detail-grid">
                                <div class="topology-panel">
                                    <div class="panel-heading"><strong>Topologi jaringan</strong><span>Simulasi</span></div>
                                    <div class="network-graph" aria-hidden="true">
                                        <svg viewBox="0 0 340 180" role="presentation" focusable="false">
                                            <defs><linearGradient id="trace" x1="0" y1="0" x2="1" y2="0"><stop stop-color="#70e3d2"/><stop offset="1" stop-color="#a399ff"/></linearGradient></defs>
                                            <path d="M54 90 H116 Q128 90 128 78 V45 Q128 33 143 33 H223 M128 90 H223 M128 102 V136 Q128 148 143 148 H223" fill="none" stroke="url(#trace)" stroke-width="2.5" stroke-linecap="round" opacity=".82"/>
                                            <circle cx="54" cy="90" r="22" fill="#162b38" stroke="#70e3d2" stroke-width="2"/>
                                            <circle cx="54" cy="90" r="8" fill="#70e3d2"/>
                                            <circle cx="238" cy="33" r="15" fill="#1b2a40" stroke="#a399ff" stroke-width="2"/>
                                            <circle cx="238" cy="90" r="15" fill="#1b2a40" stroke="#a399ff" stroke-width="2"/>
                                            <circle cx="238" cy="148" r="15" fill="#1b2a40" stroke="#a399ff" stroke-width="2"/>
                                            <circle cx="238" cy="33" r="4" fill="#c1baff"/><circle cx="238" cy="90" r="4" fill="#c1baff"/><circle cx="238" cy="148" r="4" fill="#c1baff"/>
                                            <text x="54" y="131" text-anchor="middle">OLT</text>
                                            <text x="268" y="37">ONU 01</text><text x="268" y="94">ONU 02</text><text x="268" y="152">ONU 03</text>
                                        </svg>
                                    </div>
                                    <div class="topology-legend"><span><i class="legend-dot teal"></i> Perangkat utama</span><span><i class="legend-dot violet"></i> Perangkat akhir</span></div>
                                </div>
                                <div class="activity-panel">
                                    <div class="panel-heading"><strong>Alur kerja</strong><i class="bi bi-three-dots"></i></div>
                                    <div class="activity-step"><span class="activity-icon teal"><i class="bi bi-search"></i></span><div><strong>Amati</strong><small>Status perangkat</small></div></div>
                                    <div class="activity-step"><span class="activity-icon purple"><i class="bi bi-graph-up"></i></span><div><strong>Analisis</strong><small>Tren &amp; sinyal</small></div></div>
                                    <div class="activity-step"><span class="activity-icon amber"><i class="bi bi-check2-circle"></i></span><div><strong>Tindak lanjut</strong><small>Sesuai kebutuhan</small></div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="showcase-floating"><span><i class="bi bi-stars"></i> Satu tampilan</span><strong>Lebih banyak konteks.</strong></div>
                </div>
            </div>
            <div class="container hero-topics" aria-label="Cakupan pemantauan"><span>Fokus pemantauan</span><span>OLT / ONU</span><span>SNMP &amp; OID</span><span>Status perangkat</span><span>Sinyal optik</span><span>Integrasi</span></div>
        </section>

        <section class="section capabilities-section" id="kemampuan" aria-labelledby="capabilities-heading">
            <div class="container">
                <div class="section-intro"><div><span class="eyebrow">DARI DATA KE PEMAHAMAN</span><h2 id="capabilities-heading">Bukan sekadar melihat status.<br><em>Memahami jaringan Anda.</em></h2></div><p>Informasi teknis lebih berguna saat disajikan dengan alur yang mudah diikuti—dari kondisi perangkat hingga keputusan operasional.</p></div>
                <div class="feature-grid">
                    <article class="feature-card"><div class="feature-symbol"><i class="bi bi-hdd-network" aria-hidden="true"></i></div><span class="feature-number">01 / VISIBILITY</span><h3>Pantau perangkat dari satu konteks</h3><p>Telusuri OLT, ONU, dan perangkat jaringan lainnya tanpa harus berpindah-pindah sumber informasi.</p><span class="feature-bottom">Inventaris &amp; status <i class="bi bi-arrow-up-right" aria-hidden="true"></i></span></article>
                    <article class="feature-card feature-card-highlight"><div class="feature-symbol"><i class="bi bi-activity" aria-hidden="true"></i></div><span class="feature-number">02 / INSIGHT</span><h3>Kenali perubahan lebih cepat</h3><p>Periksa informasi sinyal dan kondisi operasional untuk menentukan area yang perlu perhatian lebih lanjut.</p><span class="feature-bottom">Sinyal &amp; kondisi <i class="bi bi-arrow-up-right" aria-hidden="true"></i></span></article>
                    <article class="feature-card"><div class="feature-symbol"><i class="bi bi-diagram-3" aria-hidden="true"></i></div><span class="feature-number">03 / WORKFLOW</span><h3>Kelola dengan arah yang jelas</h3><p>Hubungkan data perangkat dengan tindakan yang relevan, sesuai metode yang didukung perangkat dan sistem.</p><span class="feature-bottom">Konteks &amp; tindak lanjut <i class="bi bi-arrow-up-right" aria-hidden="true"></i></span></article>
                </div>
            </div>
        </section>

        <section class="section workflow-section" aria-labelledby="workflow-heading">
            <div class="container workflow-grid">
                <div class="workflow-content"><span class="eyebrow">CARA KERJANYA</span><h2 id="workflow-heading">Satu alur, dari <em>pantau</em> hingga tindak lanjut.</h2><p>Tampilan yang terstruktur membantu tim tetap fokus pada pekerjaan, bukan pada kerumitan antarperangkat.</p><a href="/tentang" class="text-link">Kenali NET.NMS <i class="bi bi-arrow-up-right" aria-hidden="true"></i></a></div>
                <ol class="workflow-steps">
                    <li><span>01</span><div><h3>Hubungkan &amp; kelola</h3><p>Susun informasi perangkat jaringan ke dalam sistem yang lebih teratur.</p></div><i class="bi bi-plug" aria-hidden="true"></i></li>
                    <li><span>02</span><div><h3>Pantau &amp; telusuri</h3><p>Periksa status, sinyal, dan informasi teknis yang tersedia untuk perangkat.</p></div><i class="bi bi-binoculars" aria-hidden="true"></i></li>
                    <li><span>03</span><div><h3>Tinjau &amp; tindak lanjuti</h3><p>Gunakan informasi tersebut untuk membantu penanganan di lapangan.</p></div><i class="bi bi-arrow-return-right" aria-hidden="true"></i></li>
                </ol>
            </div>
        </section>

        <section class="section docs-section" id="panduan" aria-labelledby="docs-heading">
            <div class="container">
                <div class="section-intro"><div><span class="eyebrow">KNOWLEDGE BASE</span><h2 id="docs-heading">Dokumentasi yang ikut<br><em>tumbuh bersama aplikasi.</em></h2></div><p>Temukan panduan penggunaan, referensi OID, dan langkah integrasi. Ruang dokumentasi disiapkan agar panduan baru mudah ditambahkan.</p></div>
                <div class="docs-grid">
                    <a class="doc-preview doc-preview-featured" href="/dokumentasi#panduan-mulai"><span class="doc-type"><i class="bi bi-book-half"></i> PANDUAN APLIKASI</span><div class="doc-icon"><i class="bi bi-journal-text"></i></div><h3>Mulai menggunakan NET.NMS</h3><p>Kenali alur dasar dari penataan perangkat hingga pemantauan harian.</p><span class="doc-arrow">Baca panduan <i class="bi bi-arrow-up-right"></i></span></a>
                    <a class="doc-preview" href="/dokumentasi#olt-hisfocus"><span class="doc-type"><i class="bi bi-braces"></i> REFERENSI TEKNIS</span><div class="doc-icon"><i class="bi bi-hdd-stack"></i></div><h3>Katalog OID &amp; SNMP</h3><p>Referensi per perangkat dengan fungsi, indeks, dan metode akses.</p><span class="doc-arrow">Lihat referensi <i class="bi bi-arrow-up-right"></i></span></a>
                    <a class="doc-preview" href="/dokumentasi#waha-installation"><span class="doc-type"><i class="bi bi-link-45deg"></i> INTEGRASI</span><div class="doc-icon"><i class="bi bi-chat-dots"></i></div><h3>Integrasi WPPConnect</h3><p>Panduan instalasi layanan dan penghubungannya ke NET.NMS.</p><span class="doc-arrow">Buka panduan <i class="bi bi-arrow-up-right"></i></span></a>
                </div>
                <div class="docs-bottom"><span><i class="bi bi-plus-circle"></i> Punya panduan baru? Tambahkan melalui katalog dokumentasi berbasis PHP.</span><a class="text-link" href="/dokumentasi">Semua dokumentasi <i class="bi bi-arrow-right"></i></a></div>
            </div>
        </section>

        <section class="closing-section" aria-labelledby="closing-heading"><div class="container closing-content"><span class="eyebrow eyebrow-light">LANGKAH BERIKUTNYA</span><h2 id="closing-heading">Pemantauan yang lebih <em>terarah</em> dimulai dari informasi yang tepat.</h2><p>Jelajahi kemampuan NET.NMS sekarang. Akses pendaftaran dan masuk akan diaktifkan setelah tautan aplikasinya tersedia.</p><div class="closing-actions"><a class="button button-primary button-lg" href="/dokumentasi">Buka pusat dokumentasi <i class="bi bi-arrow-up-right"></i></a><button class="button button-soon button-lg" type="button" disabled title="Tautan pendaftaran belum tersedia">Daftar <span>Segera hadir</span></button><button class="button button-soon button-lg" type="button" disabled title="Tautan masuk belum tersedia">Masuk <span>Segera hadir</span></button></div></div></section>
    </main>

    <?php require __DIR__ . '/partials/footer.php'; ?>
</div>
</body>
</html>
