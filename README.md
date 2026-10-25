# NET.NMS — Landing page & documentation

Landing page NET.NMS untuk pemantauan perangkat jaringan, dibuat dengan **HTML/CSS/JavaScript** untuk frontend dan **PHP** untuk templating serta katalog dokumentasi. Tidak ada form feedback, penyimpanan database, autentikasi, maupun API eksternal pada landing page ini.

## Struktur situs

- `/` — beranda dengan visual ilustrasi dashboard, fitur, alur kerja, dan kartu dokumentasi.
- `/tentang` — latar belakang proyek NET.NMS.
- `/dokumentasi` — panduan aplikasi, referensi SNMP/OID, dan panduan integrasi WPPConnect.
- `/healthz` — endpoint health check untuk web server.

Tombol **Daftar** dan **Masuk** sengaja belum aktif karena URL aplikasi belum ditentukan. Untuk mengaktifkannya, ganti elemen button di `source/config/site/partials/navbar.php` dan `source/config/site/index.php` dengan tautan valid.

## Menambahkan dokumentasi aplikasi

File `source/config/site/docs-guides.php` merupakan katalog panduan berbasis array PHP. Tambahkan ID unik, `title`, `summary`, `icon` (Bootstrap Icons), serta `sections` yang berisi `title`, `description`, dan opsional `bullets`. Halaman `/dokumentasi` otomatis membuat kartu dan detail panduan baru. Tidak perlu database.

Referensi OID lama tetap ada di `source/config/site/oid-reference.php`. Panduan WPPConnect tetap tersedia di `source/config/site/dokumentasi.php`. Hindari memasukkan password, token, kunci API, dan data sensitif ke dokumentasi publik.

## Instalasi CasaOS

Gunakan `compose.yaml` sebagai satu file Compose dengan satu layanan web. Image `ghcr.io/ramonveredic/linms_landingpage:latest` memakai `lscr.io/linuxserver/nginx:latest` yang sudah memiliki Nginx dan PHP-FPM.

1. Pastikan image versi yang diinginkan telah diterbitkan oleh GitHub Actions.
2. Di CasaOS buka **Custom Install / Import Compose** lalu tempel isi `compose.yaml`.
3. Akses di `http://IP-CASAOS:8085` secara bawaan. Gunakan reverse proxy HTTPS untuk akses publik.
4. Jika paket GHCR privat, autentikasi agar CasaOS dapat melakukan pull.

Tidak perlu membuat database, file secret, atau password feedback. Contoh variabel opsional berada di `.env.example`: `PUID`, `PGID`, `TZ`, `LANDING_BIND`, dan `LANDING_PORT`.

## Release image

GitHub Actions hanya memublikasikan image ketika Git tag cocok dengan `v*.*.*` (misalnya `v1.2.3`). Pull request hanya menjalankan pengujian build dan startup tanpa menerbitkan image.

```sh
git checkout master
git pull --ff-only origin master
git tag v1.2.3
git push origin v1.2.3
```

Tag rilis tersebut menghasilkan `ghcr.io/ramonveredic/linms_landingpage:v1.2.3` dan `ghcr.io/ramonveredic/linms_landingpage:latest`. Gunakan tag baru untuk rilis selanjutnya. Filter tag GitHub merupakan glob, bukan validator SemVer numerik.

Build lokal:

```sh
docker build -f docker/Dockerfile -t linms_landingpage:local .
```

Jika menggunakan checkout Git, `./docker/deploy.sh` menarik image dan mencocokkan label commit. PHP hanya merender halaman; tidak ada operasi database atau penyimpanan form.

## Pengembangan

- Halaman utama: `source/config/site/index.php`
- Header dan footer: `source/config/site/partials/`
- Desain responsif: `source/config/site/asset/css/styiles.css`
- Navigasi dan pencarian dokumentasi: `source/config/site/asset/js/script.js`
- Konfigurasi route: `source/config/nginx/default.conf`

Route PHP hanya dieksekusi secara eksplisit oleh Nginx; URL file PHP langsung tidak dapat diakses. Pertahankan proteksi ini saat menambahkan halaman baru.
