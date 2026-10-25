<?php

declare(strict_types=1);

$brandSubtitle = 'Network Management';
$navCurrent = 'beranda';

require_once __DIR__ . '/landing.php';
landing_start_session();

if (
    !isset($_SESSION['landing_feedback_csrf'])
    || !is_string($_SESSION['landing_feedback_csrf'])
) {
    $_SESSION['landing_feedback_csrf'] = bin2hex(random_bytes(32));
}

$feedbackStatus = $_SESSION['landing_feedback_status'] ?? null;

unset($_SESSION['landing_feedback_status']);

$landingCssVersion = (string)(
    @filemtime(
        __DIR__
            . DIRECTORY_SEPARATOR . 'asset/css/styiles.css'
    ) ?: 1
);

$pageTitle = 'NET.NMS · Network Management';
$pageDescription = 'Pantau OLT, ONU, dan perangkat jaringan dalam satu dashboard NET.NMS. Periksa status, telusuri perubahan sinyal, dan kelola jaringan dengan lebih mudah.';

?>

<!doctype html>

<html lang="id">

<?php $cssVersion = $landingCssVersion;
require __DIR__ . '/partials/head.php'; ?>


<body>

    <?php if (is_array($feedbackStatus) && trim((string)($feedbackStatus['message'] ?? '')) !== ''):
        $feedbackToastType = ($feedbackStatus['type'] ?? '') === 'success' ? 'success' : 'error';
        $feedbackToastMeta = $feedbackToastType === 'success'
            ? ['title' => 'Berhasil', 'icon' => 'bi-check-lg', 'timeout' => 3400]
            : ['title' => 'Gagal', 'icon' => 'bi-x-lg', 'timeout' => 6200];
    ?>

        <div
            class="notification-stage"
            data-notification-stage
            aria-live="assertive"
            aria-atomic="false">
            <section
                class="center-notification <?= $feedbackToastType ?>"
                data-notification
                data-timeout="<?= (int)$feedbackToastMeta['timeout'] ?>"
                role="<?= $feedbackToastType === 'error' ? 'alert' : 'status' ?>">
                <button
                    class="notification-close"
                    type="button"
                    data-notification-close
                    aria-label="Tutup notifikasi">
                    <i class="bi bi-x" aria-hidden="true"></i>
                </button>

                <div class="notification-symbol <?= $feedbackToastType ?>" aria-hidden="true">
                    <span class="notification-symbol-ring"></span>
                    <i class="bi <?= $feedbackToastMeta['icon'] ?>"></i>
                </div>

                <strong class="notification-title"><?= htmlspecialchars($feedbackToastMeta['title'], ENT_QUOTES, 'UTF-8') ?></strong>
                <p class="notification-message"><?= htmlspecialchars((string)($feedbackStatus['message'] ?? ''), ENT_QUOTES, 'UTF-8') ?></p>

                <div class="notification-progress" aria-hidden="true">
                    <span></span>
                </div>
            </section>
        </div>

    <?php endif; ?>

    <div class="landing-shell">

        <?php require __DIR__ . '/partials/navbar.php'; ?>


        <main>

            <section
                class="hero"
                aria-labelledby="hero-title">

                <div class="hero-copy">

                    <p class="eyebrow">
                        <span></span>
                        Satu dashboard untuk jaringan Anda
                    </p>

                    <h1 id="hero-title">
                        Pantau lebih mudah.<br>Kelola lebih <em>terarah.</em>
                    </h1>

                    <p class="hero-lead">
                        NET.NMS membantu Anda memantau OLT, ONU, dan perangkat jaringan
                        dari satu tempat. Periksa status perangkat, telusuri perubahan
                        sinyal, dan temukan bagian jaringan yang perlu ditangani.
                    </p>

                    <div class="hero-actions">

                        <a
                            class="button button-primary button-large"
                            href="<?= htmlspecialchars(landing_nms_href('register'), ENT_QUOTES, 'UTF-8') ?>">
                            Mulai dengan NET.NMS
                            <span aria-hidden="true">&rarr;</span>
                        </a>

                        <a
                            class="button button-ghost button-large"
                            href="#fitur">
                            Jelajahi fitur
                        </a>

                    </div>

                </div>


                <div
                    class="network-preview"
                aria-label="Ilustrasi pemantauan jaringan">

                    <div class="preview-glow"></div>

                    <div class="preview-window">

                        <div class="preview-bar">

                            <div
                                class="preview-dots"
                                aria-hidden="true">
                                <i></i>
                                <i></i>
                                <i></i>
                            </div>

                        </div>


                        <div class="preview-body">

                            <div class="metric-row">

                                <article>
                                    <span>OLT</span>
                                    <strong>Aktif</strong>
                                    <small>Perangkat utama</small>
                                </article>

                                <article>
                                    <span>ONU</span>
                                    <strong>Terpantau</strong>
                                    <small>Status dan sinyal</small>
                                </article>

                                <article>
                                    <span>Aktivitas</span>
                                    <strong>Terbaru</strong>
                                    <small>Perubahan jaringan</small>
                                </article>

                            </div>


                            <div class="topology-card">

                                <div class="topology-head">

                                    <div>
                                        <span>Topologi</span>
                                        <strong>Jalur perangkat</strong>
                                    </div>

                                    <small>Ilustrasi jaringan</small>

                                </div>


                                <div
                                    class="network-map"
                                    aria-hidden="true">

                                    <span class="line line-one"></span>
                                    <span class="line line-two"></span>
                                    <span class="line line-three"></span>

                                    <i class="node node-core"></i>
                                    <i class="node node-a"></i>
                                    <i class="node node-b"></i>
                                    <i class="node node-c"></i>
                                    <i class="node node-d"></i>

                                </div>

                            </div>


                            <div class="event-row">

                                <span
                                    class="event-icon"
                                    aria-hidden="true"></span>

                                <div>
                                    <strong>Aktivitas jaringan</strong>
                                    <small>
                                        Telusuri perubahan status perangkat
                                    </small>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </section>


            <section
                class="capabilities"
                id="fitur"
                aria-label="Fitur utama">

                <article>

                    <span class="capability-number">
                        01
                    </span>

                    <div>

                        <h2>Kenali kondisi jaringan</h2>

                        <p>
                            Lihat status OLT dan ONU, kondisi sinyal, serta aktivitas
                            terbaru untuk membantu pemeriksaan harian.
                        </p>

                    </div>

                </article>


                <article>

                    <span class="capability-number">
                        02
                    </span>

                    <div>

                        <h2>Kelola perangkat lebih rapi</h2>

                        <p>
                            Susun data OLT, ONU, ODC, ODP, dan OTB dalam satu aplikasi
                            agar informasi jaringan lebih mudah ditemukan.
                        </p>

                    </div>

                </article>


                <article>

                    <span class="capability-number">
                        03
                    </span>

                    <div>

                        <h2>Tindak lanjuti dari satu tempat</h2>

                        <p>
                            Periksa detail ONU dan jalankan tindakan seperti reboot
                            langsung dari aplikasi pada perangkat yang mendukung.
                        </p>

                    </div>

                </article>

            </section>


            <section class="transparency-section getting-started" id="mulai" aria-labelledby="getting-started-title">
                <div>
                    <p class="eyebrow"><span></span>Mulai menggunakan NET.NMS</p>
                    <h2 id="getting-started-title">Dari perangkat ke pemantauan terpusat</h2>
                    <a class="text-link" href="<?= htmlspecialchars(landing_nms_href('register'), ENT_QUOTES, 'UTF-8') ?>">Buat akun <span aria-hidden="true">&rarr;</span></a>
                </div>
                <div class="transparency-copy">
                    <ol class="getting-started-steps">
                        <li><h3>Siapkan akun Anda</h3><p>Daftar dan masuk ke aplikasi untuk mulai mengelola jaringan.</p></li>
                        <li><h3>Tambahkan perangkat</h3><p>Masukkan perangkat dan atur koneksi sesuai metode yang didukung.</p></li>
                        <li><h3>Pantau kondisi jaringan</h3><p>Setelah data tersinkron, periksa status, sinyal, dan aktivitas perangkat melalui dashboard.</p></li>
                    </ol>
                    <a class="text-link" href="/dokumentasi">Baca panduan penggunaan <span aria-hidden="true">&rarr;</span></a>
                </div>
            </section>

            <section
                class="transparency-section"
                aria-labelledby="transparency-title">

                <div>

                    <p class="eyebrow">
                        <span></span>
                        Tentang proyek
                    </p>

                    <h2 id="transparency-title">
                        Dikembangkan dari kebutuhan di lapangan
                    </h2>

                </div>


                <div class="transparency-copy">

                    <p>
                        NET.NMS tumbuh dari kebutuhan pengelolaan jaringan sehari-hari.
                        Pengembangannya dibantu kecerdasan buatan, dengan arahan manusia
                        dan pengujian bertahap. Pengalaman serta masukan pengguna membantu
                        menentukan perbaikan berikutnya.
                    </p>

                    <a class="text-link" href="/tentang">Baca tentang proyek <span aria-hidden="true">&rarr;</span></a>

                </div>

            </section>


            <section
                class="feedback-section"
                id="masukan"
                aria-labelledby="feedback-title">

                <div class="feedback-intro">

                    <p class="eyebrow">
                        <span></span>
                        Masukan pengguna
                    </p>

                    <h2 id="feedback-title">
                        Bantu kami membuat NET.NMS lebih baik
                    </h2>

                    <p>
                        Punya ide fitur atau menemukan kendala? Ceritakan melalui
                        formulir ini. Masukan Anda akan diterima oleh pengelola
                        dan tidak ditampilkan secara publik.
                    </p>

                </div>


                <form
                    class="feedback-form"
                    method="post"
                    action="/feedback"
                    novalidate>

                    <input
                        type="hidden"
                        name="csrf"
                        value="<?= htmlspecialchars(
                                    (string)$_SESSION['landing_feedback_csrf'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>">


                    <label
                        class="feedback-trap"
                        aria-hidden="true">
                        Website

                        <input
                            name="website"
                            tabindex="-1"
                            autocomplete="off">

                    </label>


                    <div class="feedback-row">

                        <label data-tip="Harap isi bidang ini" data-tip-pos="bottom">

                            <span>Nama</span>

                            <input
                                name="name"
                                maxlength="100"
                                autocomplete="name"
                                required
                                placeholder="Nama Anda">

                        </label>


                        <label data-tip="Email atau WhatsApp" data-tip-pos="bottom">

                            <span>
                                Kontak
                                <small>opsional</small>
                            </span>

                            <input
                                name="contact"
                                maxlength="160"
                                autocomplete="email"
                                placeholder="Email atau WhatsApp">

                        </label>

                    </div>


                    <label data-tip="Harap isi bidang ini" data-tip-pos="bottom">

                        <span>Judul pesan</span>

                        <input
                            name="subject"
                            minlength="3"
                            maxlength="160"
                            required
                            placeholder="Ringkasan saran atau masalah">

                    </label>


                    <label data-tip="Harap isi bidang ini" data-tip-pos="bottom">

                        <span>Isi pesan</span>

                        <textarea
                            name="message"
                            minlength="10"
                            maxlength="5000"
                            rows="6"
                            required
                            placeholder="Jelaskan masalah atau saran Anda"></textarea>

                    </label>


                    <div class="feedback-submit">

                        <button
                            class="button button-primary button-large"
                            type="submit">
                            Kirim masukan
                        </button>

                    </div>

                </form>

            </section>

        </main>


        <?php require __DIR__ . '/partials/footer.php'; ?>
    </div>
    <?php $noticeJsVersion = (string)(@filemtime(__DIR__ . '/asset/js/notice.js') ?: 1); ?>
    <script src="/asset/js/notice.js?v=<?= rawurlencode($noticeJsVersion) ?>" defer></script>
    <script src="/asset/js/feedback.js" defer></script>
</body>

</html>
