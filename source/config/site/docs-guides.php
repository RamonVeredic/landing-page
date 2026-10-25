<?php
declare(strict_types=1);

/**
 * NET.NMS application documentation catalog.
 *
 * Add another entry to this array to publish a new guide in /dokumentasi.
 * Each key is the URL fragment (#your-guide-id); keep it unique.
 * Each section has a title, description and optional bullet points.
 * All content is escaped in dokumentasi.php before rendering.
 *
 * This catalog is maintained in PHP intentionally: no database required.
 */
return [
    'panduan-mulai' => [
        'icon' => 'bi-compass',
        'category' => 'Panduan aplikasi',
        'title' => 'Mulai menggunakan NET.NMS',
        'summary' => 'Pengenalan alur penggunaan sebelum memantau jaringan.',
        'sections' => [
            [
                'title' => 'Pahami lingkungan jaringan',
                'description' => 'Catat jenis perangkat, alamat manajemen, serta hak akses yang diperlukan. Pastikan Anda memahami batasan jaringan dan mekanisme komunikasi yang didukung perangkat.',
                'bullets' => [
                    'Inventaris perangkat seperti OLT, ONU, dan perangkat pendukung.',
                    'Siapkan data koneksi sesuai prosedur operasional setempat.',
                    'Gunakan kredensial dengan hak akses minimal yang dibutuhkan.',
                ],
            ],
            [
                'title' => 'Mulai dari data perangkat',
                'description' => 'Setelah aplikasi tersedia, periksa fitur penambahan perangkat dan kelengkapan informasi yang diperlukan. Nama menu dan langkah spesifik bisa berbeda mengikuti versi NET.NMS.',
                'bullets' => [
                    'Cocokkan identitas perangkat sebelum disimpan.',
                    'Pastikan perangkat dapat dijangkau dari server aplikasi.',
                    'Periksa apakah perangkat menggunakan protokol dan OID yang didukung.',
                ],
            ],
            [
                'title' => 'Buat kebiasaan pemantauan',
                'description' => 'Gunakan ringkasan status dan informasi sinyal sebagai petunjuk awal, lalu verifikasi langsung pada perangkat sebelum menjalankan tindakan yang berisiko.',
                'bullets' => [
                    'Tinjau status dan sinyal secara berkala.',
                    'Bandingkan temuan dengan kondisi lapangan.',
                    'Catat tindakan operasional pada sistem pencatatan yang Anda gunakan.',
                ],
            ],
        ],
    ],
    'panduan-perangkat' => [
        'icon' => 'bi-hdd-network',
        'category' => 'Panduan aplikasi',
        'title' => 'Mengenali perangkat & sinyal',
        'summary' => 'Cara membaca konteks pemantauan OLT, ONU, dan data SNMP.',
        'sections' => [
            [
                'title' => 'OLT dan ONU',
                'description' => 'OLT adalah perangkat akses optik pusat, sementara ONU berada di sisi pelanggan atau titik layanan. Informasi dari keduanya saling melengkapi untuk penelusuran gangguan.',
                'bullets' => [
                    'Pahami identitas port PON dan ONU sebelum membandingkan data.',
                    'Pastikan indeks perangkat sesuai pemetaan yang digunakan.',
                    'Jangan menyimpulkan gangguan hanya dari satu indikator.',
                ],
            ],
            [
                'title' => 'Sinyal dan kondisi operasional',
                'description' => 'Nilai RX optik, status port dan alarm—bila tersedia—perlu dibaca dengan satuan serta konteks perangkat yang benar. Ambang batas dapat berbeda antarvendor atau model.',
                'bullets' => [
                    'Perhatikan satuan dBm, nilai mentah, dan metode pembacaan.',
                    'Bandingkan tren dengan kondisi link dan dokumentasi perangkat.',
                    'Lakukan verifikasi sebelum tindakan yang memutus layanan.',
                ],
            ],
            [
                'title' => 'Referensi OID',
                'description' => 'Katalog OID di halaman ini menyertakan kegunaan, metode akses, serta indeks yang relevan. OID spesifik vendor tidak selalu berlaku untuk seluruh model atau versi firmware.',
                'bullets' => [
                    'Mulai dari kategori OLT, MikroTik, atau switch yang sesuai.',
                    'Periksa penandaan GET dan SET sebelum mengakses perangkat.',
                    'Lakukan pengujian di lingkungan aman untuk operasi SET.',
                ],
            ],
        ],
    ],
    'panduan-operasional' => [
        'icon' => 'bi-sliders2',
        'category' => 'Panduan aplikasi',
        'title' => 'Praktik operasional dasar',
        'summary' => 'Alur pemeriksaan, pencatatan, dan tindak lanjut jaringan.',
        'sections' => [
            [
                'title' => 'Urutkan pemeriksaan',
                'description' => 'Mulai dari gejala yang terlihat, tentukan perangkat dan jalur terkait, lalu periksa data yang tersedia. Hindari melakukan perubahan konfigurasi sebelum penyebab cukup jelas.',
                'bullets' => [
                    'Tentukan area dan waktu kejadian.',
                    'Periksa konektivitas dan kondisi perangkat yang relevan.',
                    'Bandingkan dengan informasi sebelumnya atau hasil pemeriksaan lapangan.',
                ],
            ],
            [
                'title' => 'Tindakan dengan kontrol',
                'description' => 'Aksi seperti reboot atau perubahan parameter harus dilakukan hanya bila fitur didukung, sesuai prosedur dan Anda memahami dampaknya terhadap layanan.',
                'bullets' => [
                    'Periksa dampak ke pelanggan dan perangkat lain.',
                    'Gunakan hak akses sesuai kewenangan.',
                    'Verifikasi status sesudah tindakan dilakukan.',
                ],
            ],
            [
                'title' => 'Tambahkan panduan baru',
                'description' => 'Pusat dokumentasi ini dapat diperluas lewat file docs-guides.php. Tambahkan ID, judul, ringkasan, ikon, dan bagian panduan baru; entri akan tampil sebagai kartu otomatis.',
                'bullets' => [
                    'Tuliskan langkah yang benar-benar sudah diverifikasi.',
                    'Sertakan nama model dan versi saat membahas OID khusus vendor.',
                    'Jangan memasukkan kata sandi, token atau rahasia produksi ke dokumentasi.',
                ],
            ],
        ],
    ],
];
