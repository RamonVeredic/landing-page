<?php

declare(strict_types=1);

$brandSubtitle = 'Dokumentasi OID';
$navCurrent = 'dokumentasi';
$cssVersion = (string)(@filemtime(__DIR__ . '/asset/css/styiles.css') ?: 1);
$pageTitle = 'Dokumentasi OID · NET.NMS';
$pageDescription = 'Referensi OID SNMP untuk perangkat yang didukung NET.NMS.';

define('NMS_OID_REFERENCE', true);
$catalogs = (array)(require __DIR__ . '/oid-reference.php');
$guides = (array)(require __DIR__ . '/docs-guides.php');
?>
<!doctype html>
<html lang="id">
<?php require __DIR__ . '/partials/head.php'; ?>

<body>
    <a class="skip-link" href="#main-content">Lewati ke konten utama</a>
    <div class="landing-shell information-shell">
        <?php require __DIR__ . '/partials/navbar.php'; ?>

        <main class="information-main documentation-main" id="main-content">
            <header class="documentation-header">
                <span class="eyebrow">PUSAT DOKUMENTASI NET.NMS</span>
                <h1>Pengetahuan teknis.<br><em>Dalam satu tempat.</em></h1>
                <p>Mulai dari panduan penggunaan NET.NMS, referensi OID SNMP, hingga integrasi layanan terkait. Pilih kategori untuk membaca tanpa meninggalkan halaman.</p>
            </header>

            <section class="documentation-categories" data-documentation-categories aria-labelledby="documentation-category-title">
                <div class="section-heading">
                    <span class="section-kicker">JELAJAHI MATERI</span>
                    <h2 id="documentation-category-title">Pilih topik yang ingin dipelajari</h2>
                </div>
                <div class="documentation-category-grid">
                    <?php foreach ($guides as $guideId => $guide): ?>
                        <button class="documentation-category-card" type="button" data-doc-kind="guide" data-documentation-open="<?= htmlspecialchars((string)$guideId, ENT_QUOTES, 'UTF-8') ?>">
                            <i class="bi <?= htmlspecialchars((string)($guide['icon'] ?? 'bi-book'), ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true"></i>
                            <span><strong><?= htmlspecialchars((string)$guide['title'], ENT_QUOTES, 'UTF-8') ?></strong><small><?= htmlspecialchars((string)$guide['summary'], ENT_QUOTES, 'UTF-8') ?></small></span>
                            <i class="bi bi-arrow-up-right" aria-hidden="true"></i>
                        </button>
                    <?php endforeach; ?>
                    <?php foreach ($catalogs as $catalogId => $catalog): ?>
                        <?php
                        $categoryTitle = match ((string)$catalogId) {
                            'olt-hisfocus' => 'Referensi OID OLT Hioso 2 PON',
                            'mikrotik' => 'Referensi OID MikroTik',
                            default => 'Referensi OID Switch',
                        };
                        $categoryIcon = match ((string)$catalogId) {
                            'olt-hisfocus' => 'bi-hdd-network',
                            'mikrotik' => 'bi-router',
                            default => 'bi-diagram-3',
                        };
                        ?>
                        <button class="documentation-category-card" type="button" data-documentation-open="<?= htmlspecialchars((string)$catalogId, ENT_QUOTES, 'UTF-8') ?>">
                            <i class="bi <?= htmlspecialchars($categoryIcon, ENT_QUOTES, 'UTF-8') ?>" aria-hidden="true"></i>
                            <span><strong><?= htmlspecialchars($categoryTitle, ENT_QUOTES, 'UTF-8') ?></strong><small><?= number_format(count((array)($catalog['oids'] ?? []))) ?> referensi OID</small></span>
                            <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        </button>
                    <?php endforeach; ?>
                    <button class="documentation-category-card" type="button" data-documentation-open="waha-installation">
                        <i class="bi bi-whatsapp" aria-hidden="true"></i>
                        <span><strong>Instalasi WPPConnect</strong><small>Docker Compose dan konfigurasi awal</small></span>
                        <i class="bi bi-arrow-right" aria-hidden="true"></i>
                    </button>
                </div>
            </section>

            <div class="documentation-detail-toolbar" data-documentation-detail-toolbar hidden>
                <button class="button button-ghost" type="button" data-documentation-back><i class="bi bi-arrow-left" aria-hidden="true"></i> Semua kategori</button>
            </div>

            <div class="documentation-toolbar" data-oid-toolbar hidden>
                <form class="oid-search" role="search">
                    <label class="visually-hidden" for="oidSearchInput">Cari OID atau kegunaan</label>
                    <span class="oid-search-field" data-tip="Cari OID atau kegunaan" data-tip-pos="bottom">
                        <input id="oidSearchInput" type="search" placeholder="Cari OID atau kegunaan" autocomplete="off">
                    </span>
                    <button class="button button-primary" type="submit"><i class="bi bi-search" aria-hidden="true"></i> Cari</button>
                </form>
            </div>
            <p class="oid-search-status" id="oidSearchStatus" aria-live="polite"></p>

            <section class="oid-catalog" aria-label="Isi dokumentasi">
                <?php foreach ($guides as $guideId => $guide): ?>
                    <article class="oid-reference-group" id="<?= htmlspecialchars((string)$guideId, ENT_QUOTES, 'UTF-8') ?>" data-documentation-panel="<?= htmlspecialchars((string)$guideId, ENT_QUOTES, 'UTF-8') ?>" data-doc-kind="guide" hidden>
                        <header>
                            <span><?= htmlspecialchars((string)($guide['category'] ?? 'Panduan aplikasi'), ENT_QUOTES, 'UTF-8') ?></span>
                            <h3><?= htmlspecialchars((string)$guide['title'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <p><?= htmlspecialchars((string)$guide['summary'], ENT_QUOTES, 'UTF-8') ?></p>
                        </header>
                        <div class="guide-chapters">
                            <?php foreach ((array)($guide['sections'] ?? []) as $chapter): ?>
                                <section class="guide-chapter">
                                    <h4><?= htmlspecialchars((string)($chapter['title'] ?? ''), ENT_QUOTES, 'UTF-8') ?></h4>
                                    <p><?= htmlspecialchars((string)($chapter['description'] ?? ''), ENT_QUOTES, 'UTF-8') ?></p>
                                    <?php if (!empty($chapter['bullets'])): ?>
                                        <ul class="documentation-steps">
                                            <?php foreach ((array)$chapter['bullets'] as $point): ?>
                                                <li><?= htmlspecialchars((string)$point, ENT_QUOTES, 'UTF-8') ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </section>
                            <?php endforeach; ?>
                        </div>
                        <p class="guide-aside"><i class="bi bi-info-circle" aria-hidden="true"></i> Panduan disusun sebagai acuan. Periksa kesesuaiannya dengan versi NET.NMS dan perangkat Anda sebelum melakukan perubahan di jaringan produksi.</p>
                    </article>
                <?php endforeach; ?>
                <?php foreach ($catalogs as $catalogId => $catalog): ?>
                    <article class="oid-reference-group" id="<?= htmlspecialchars($catalogId, ENT_QUOTES, 'UTF-8') ?>" data-documentation-panel="<?= htmlspecialchars((string)$catalogId, ENT_QUOTES, 'UTF-8') ?>" data-doc-kind="oid" hidden>
                        <header>
                            <span>Sumber OID</span>
                            <h3><?= htmlspecialchars((string)$catalog['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                            <dl class="oid-source">
                                <div>
                                    <dt>Perangkat</dt>
                                    <dd><?= htmlspecialchars((string)($catalog['source']['Perangkat'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></dd>
                                </div>
                                <div>
                                    <dt>Model</dt>
                                    <dd><?= htmlspecialchars((string)($catalog['source']['Model'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></dd>
                                </div>
                                <div>
                                    <dt>Software version</dt>
                                    <dd><?= htmlspecialchars((string)($catalog['source']['Software version'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></dd>
                                </div>
                                <div class="oid-source-base">
                                    <dt>Base OID</dt>
                                    <dd><?php foreach ((array)($catalog['base_oids'] ?? []) as $baseOid): ?><code><?= htmlspecialchars((string)$baseOid, ENT_QUOTES, 'UTF-8') ?></code><?php endforeach; ?></dd>
                                </div>
                            </dl>
                        </header>
                        <div class="table-scroll">
                            <table class="oid-reference-table">
                                <thead>
                                    <tr>
                                        <th scope="col">OID</th>
                                        <th scope="col">Kegunaan</th>
                                        <th scope="col">Indeks</th>
                                        <th scope="col">Akses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ((array)($catalog['oids'] ?? []) as $row): ?>
                                        <tr>
                                            <td><code><?= htmlspecialchars((string)($row['oid'] ?? ''), ENT_QUOTES, 'UTF-8') ?></code></td>
                                            <td><?= htmlspecialchars((string)($row['description'] ?? 'Keterangan belum tersedia.'), ENT_QUOTES, 'UTF-8') ?></td>
                                            <td><code><?= htmlspecialchars((string)($row['index'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></code></td>
                                            <td><span class="oid-method"><?= htmlspecialchars((string)($row['method'] ?? '-'), ENT_QUOTES, 'UTF-8') ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </article>
                <?php endforeach; ?>

                <article class="oid-reference-group waha-installation" id="waha-installation" data-documentation-panel="waha-installation" data-doc-kind="integration" hidden>
                    <header>
                        <span>WhatsApp HTTP API</span>
                        <h3>Instalasi dan integrasi WPPConnect</h3>
                        <p>Panduan dari pemasangan container sampai WPPConnect terhubung ke NET.NMS. Pilih cara instalasi yang sesuai dengan server Anda.</p>
                        <nav class="documentation-anchor-nav" aria-label="Bagian panduan WPPConnect">
                            <a href="#waha-casaos">CasaOS</a><a href="#waha-docker">Docker</a><a href="#waha-token">Token</a><a href="#waha-test">Pengujian</a><a href="#waha-connect">Hubungkan NET.NMS</a>
                        </nav>
                    </header>

                    <div class="documentation-guide">
                        <section id="waha-casaos">
                            <p class="section-kicker">Pilihan 1</p>
                            <h4>Instalasi melalui CasaOS</h4>
                            <ol class="documentation-steps">
                                <li>Buka <strong>CasaOS → Custom Install</strong>.</li>
                                <li>Pilih <i class="bi bi-box-arrow-right"></i> untuk import </li>
                                <li>Salin blok <code>compose.yaml</code> tempel kedalam kolom <strong>Docker Compose</strong>.</li>
                                <div class="documentation-code-block">
                                    <div class="documentation-code-heading">
                                        <span>compose.yaml</span>
                                        <button class="button button-ghost" type="button" data-copy-code><i class="bi bi-copy" aria-hidden="true"></i> <span>Salin</span></button>
                                    </div>
<pre>name: wppconnect
services:
  wppconnect:
    image: wppconnect/wppconnect-server:latest
    container_name: wppconnect
    restart: unless-stopped
    environment:
      - MANAGER_ENABLED=true
      - SECRET_KEY=isi-dengan-secret-key-anda
    ports:
      - "21465:21465"
    volumes:
      - /DATA/AppData/wppconnect/tokens:/usr/src/wpp-server/tokens
      - /DATA/AppData/wppconnect/userdata:/usr/src/wpp-server/userDataDir
    labels:
      icon: https://cdn.jsdelivr.net/gh/RamonVeredic/icon@main/whatsapp/logo.png
x-casaos:
  icon: https://cdn.jsdelivr.net/gh/RamonVeredic/icon@main/whatsapp/logo.png
  index: /manager/
  port_map: "21465"
  scheme: http
  title:
    custom: WPPConnect
</pre>
                                </div>
                        </section>

                        <section id="waha-docker">
                            <p class="section-kicker">Pilihan 2</p>
                            <h4>Instalasi dengan Docker Compose</h4>
                            <p>Simpan konfigurasi berikut sebagai <code>compose.yaml</code>. Ganti API key dan password sebelum menjalankannya.</p>
                            <div class="documentation-code-block">
                                <div class="documentation-code-heading">
                                    <span>compose.yaml</span>
                                    <button class="button button-ghost" type="button" data-copy-code><i class="bi bi-copy" aria-hidden="true"></i> <span>Salin</span></button>
                                </div>
                                <pre><code>version: '3.8'

services:
  wppconnect:
    image: wppconnect/wppconnect-server:latest
    container_name: wppconnect
    restart: unless-stopped
    ports:
      - "21465:21465"
    environment:
      SECRET_KEY: "isi-dengan-secret-key-anda"
      MANAGER_ENABLED: "true"
      TZ: "Asia/Jakarta"
    volumes:
      - /DATA/AppData/wppconnect/tokens:/usr/src/wpp-server/tokens
      - /DATA/AppData/wppconnect/userDataDir:/usr/src/wpp-server/userDataDir
    logging:
      driver: "json-file"
      options:
        max-size: "10m"
        max-file: "3"</code></pre>
                            </div>
                            <div class="documentation-code-block">
                                <div class="documentation-code-heading"><span>Jalankan container</span><button class="button button-ghost" type="button" data-copy-code><i class="bi bi-copy"></i> <span>Salin</span></button></div>
                                <pre><code>docker compose pull
docker compose up -d
docker compose ps
docker compose logs --tail=100 wppconnect</code></pre>
                            </div>
                        </section>

                        <section id="waha-session">
                            <p class="section-kicker">Session WhatsApp</p>
                            <h4>Buat session dan pindai QR</h4>
                            <ol class="documentation-steps">
                                <li>Buka <code>http://IP-SERVER:21465/manager/</code>.</li>
                                <li>Masukkan <code>SECRET_KEY</code> yang sudah dibuat.</li>
                                <li>Buat session, misalnya <code>netnms</code>, lalu pindai QR melalui WhatsApp → Perangkat tertaut</li>
                                
                            </ol>
                        </section>

                        <section id="waha-token">
                            <p class="section-kicker">Token NET.NMS</p>
                            <h4>Membuat token session dari terminal</h4>
                            <p>Endpoint generator ini merupakan endpoint khusus integrasi NET.NMS. Ganti URL, nama session, dan secret key sesuai server Anda.</p>
                            <div class="documentation-code-block">
                                <div class="documentation-code-heading"><span>Generate token</span><button class="button button-ghost" type="button" data-copy-code><i class="bi bi-copy"></i> <span>Salin</span></button></div>
                                <pre>curl -i -X POST "http://IP-SERVER:21465/api/NAMA_SESSION/SECRET_KEY/generate-token"
</pre>
                            </div>
                            <p>Respons berhasil berisi <code>status</code>, <code>session</code>, <code>token</code>, dan <code>full</code>. Gunakan nilai <code>full</code> pada kolom Token NET.NMS; jangan membagikan secret key atau token ke pihak lain.</p>
                        </section>

                        <section id="waha-test">
                            <p class="section-kicker">Pengujian</p>
                            <h4>Periksa session dan kirim pesan</h4>
                            <p>Pada contoh berikut, nilai <code>token</code> dari respons generator dikirim melalui header <code>Authorization: Bearer</code>. Nomor pribadi memakai format internasional tanpa tanda tambah.</p>
                            <div class="documentation-code-block">
                                <div class="documentation-code-heading"><span>Cek status session</span><button class="button button-ghost" type="button" data-copy-code><i class="bi bi-copy"></i> <span>Salin</span></button></div>
                                <pre><code>curl "https://URL-SERVER/api/NAMA_SESSION/status-session" \
  -H "Authorization: Bearer TOKEN_SESSION" \
  -H "Accept: application/json"</code></pre>
                            </div>
                            <div class="documentation-code-block">
                                <div class="documentation-code-heading"><span>Kirim pesan pribadi</span><button class="button button-ghost" type="button" data-copy-code><i class="bi bi-copy"></i> <span>Salin</span></button></div>
                                <pre><code>curl -X POST "https://URL-SERVER/api/NAMA_SESSION/send-message" \
  -H "Authorization: Bearer TOKEN_SESSION" \
  -H "Content-Type: application/json" \
  -d '{"phone":"6281234567890","message":"Tes WPPConnect dari NET.NMS"}'</code></pre>
                            </div>
                            <div class="documentation-code-block">
                                <div class="documentation-code-heading"><span>Daftar grup</span><button class="button button-ghost" type="button" data-copy-code><i class="bi bi-copy"></i> <span>Salin</span></button></div>
                                <pre><code>curl "https://URL-SERVER/api/NAMA_SESSION/all-groups" \
  -H "Authorization: Bearer TOKEN_SESSION" \
  -H "Accept: application/json"</code></pre>
                            </div>
                            <p class="documentation-note">Pesan grup menggunakan ID grup dari hasil daftar grup, misalnya <code>120363000000000000@g.us</code>. NET.NMS akan mengirimkannya sebagai tujuan WPPConnect dengan penanda grup.</p>
                        </section>

                        <section id="waha-connect">
                            <p class="section-kicker">NET.NMS</p>
                            <h4>Menghubungkan WPPConnect ke aplikasi</h4>
                            <ol class="documentation-steps">
                                <li>Buka halaman <strong>WhatsApp</strong> di NET.NMS, lalu pilih provider <strong>WPPConnect</strong>.</li>
                                <li>Isi <strong>URL Server</strong> tanpa <code>/manager</code>, contohnya <code>https://wa.example.com</code>.</li>
                                <li>Tekan <strong>Buat Token</strong>, lalu isi nama session yang sama dengan session di WPPConnect dan masukkan <code>SECRET_KEY</code>.</li>
                                <li>Setelah token berhasil dibuat, nilai lengkap <code>session:token</code> akan masuk otomatis ke kolom <strong>Token</strong>.</li>
                                <li>Pilih nomor pribadi atau grup, simpan koneksi, lalu jalankan <strong>Kirim Pesan Uji</strong>.</li>
                                <li>Untuk OTP pendaftaran, lakukan konfigurasi yang sama melalui Kontrol Panel → Pengaturan → Gateway OTP.</li>
                            </ol>
                        </section>

                        <section class="documentation-official-links">
                            <p class="section-kicker">Dokumentasi resmi</p>
                            <h4>Referensi WPPConnect</h4>
                            <div class="documentation-link-grid">
                                <a href="https://wppconnect.io/docs/projects/wppserver/introduction/" target="_blank" rel="noopener noreferrer">Pengenalan WPPConnect Server <i class="bi bi-box-arrow-up-right"></i></a>
                                <a href="https://wppconnect.io/docs/projects/wppserver/installation/" target="_blank" rel="noopener noreferrer">Panduan instalasi <i class="bi bi-box-arrow-up-right"></i></a>
                                <a href="https://github.com/wppconnect-team/wppconnect-server" target="_blank" rel="noopener noreferrer">Repositori server <i class="bi bi-box-arrow-up-right"></i></a>
                                <a href="https://github.com/wppconnect-team/wppconnect-manager" target="_blank" rel="noopener noreferrer">WPPConnect Manager <i class="bi bi-box-arrow-up-right"></i></a>
                                <a href="https://wppconnect.io/swagger/wppconnect-server/" target="_blank" rel="noopener noreferrer">Referensi API <i class="bi bi-box-arrow-up-right"></i></a>
                                <a href="https://hub.docker.com/r/wppconnect/wppconnect-server" target="_blank" rel="noopener noreferrer">Image Docker <i class="bi bi-box-arrow-up-right"></i></a>
                            </div>
                        </section>
                    </div>
                </article>
            </section>
        </main>

        <?php require __DIR__ . '/partials/footer.php'; ?>
    </div>
</body>

</html>
