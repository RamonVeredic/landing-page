# Landing page NET.NMS

Repository Git berada di direktori `landing-page`. Folder `source/` berisi kode dan Dockerfile, sedangkan `state/` menyimpan rahasia lokal dan dikecualikan dari Git. Image web memakai `nginx:stable-alpine` resmi. Halaman PHP dan formulir dijalankan oleh sidecar PHP-FPM dari paket Alpine; Nginx hanya melayani aset publik. Kode aplikasi NMS, file database lama, dan sertifikat lama tidak disalin.

## Struktur

- `source/config/site/`: halaman landing, dokumentasi OID, dan formulir. Semua aset berada di `source/config/site/asset/` dan dilayani lewat URL `/asset/`.
- `source/config/nginx/`: aturan rute dan header keamanan untuk Nginx resmi.
- `source/config/php/`: konfigurasi PHP-FPM khusus landing.
- `source/docker/`: Dockerfile Nginx dan PHP.
- `compose.yaml` dan `compose.dev.yaml`: konfigurasi container untuk image dan pengembangan.
- `state/secrets/`: dua berkas rahasia lokal; dikecualikan dari Git dan tidak masuk image.

Image menyimpan kode pada `/workspace/landing-source`. Symlink Nginx dan PHP-FPM menunjuk ke lokasi tersebut. Pada pengembangan, `compose.dev.yaml` me-mount folder `source` ke lokasi yang sama secara read-only, sehingga perubahan kode tampil tanpa build ulang. Pada image tanpa mount, symlink tetap menunjuk ke kode yang disalin saat build. Konfigurasi Nginx perlu reload jika berubah.

## Konfigurasi dan jalankan

1. Dari direktori `landing-page`, salin `.env.example` menjadi `.env`. Isi `LANDING_NMS_BASE_URL` dengan URL aplikasi NMS yang benar. Nilai `/NMS` hanya cocok bila reverse proxy utama memang merutekan `/NMS` ke aplikasi lain.
2. Formulir masukan memakai tabel `feedback_messages` yang sudah ada. Buat akun database khusus dengan hak `SELECT` dan `INSERT` hanya pada tabel tersebut. Isi `FEEDBACK_DB_NAME` dan `FEEDBACK_DB_USER` di `.env`, lalu tulis kata sandi akun itu ke `state/secrets/feedback_db_password`. Setelah menulis berkas rahasia, jalankan `chown 82:82 state/secrets/*` dan `chmod 400 state/secrets/*` agar PHP non-root dapat membacanya. Tanpa konfigurasi ini, halaman tetap berjalan tetapi formulir menampilkan kegagalan secara jelas.
3. `state/secrets/feedback_ip_hash_key` sudah berisi kunci acak lokal. Jaga tetap privat karena dipakai untuk hash IP pada pembatasan masukan.
4. Build dengan `docker compose build`, lalu jalankan image dengan `docker compose up -d`. Untuk pengembangan source mount, pakai `docker compose -f compose.yaml -f compose.dev.yaml up -d`. Secara bawaan web hanya terikat ke `127.0.0.1:8085`. Hubungkan domain publik lewat reverse proxy HTTPS yang sudah ada; jangan buka port PHP-FPM.
5. Jika pengujian memakai HTTP lokal, set `LANDING_SECURE_COOKIE=0` sementara. Untuk domain HTTPS, gunakan `1`.

Contoh grant database (ganti nama database, user, host, dan kata sandi sesuai instalasi):

```sql
CREATE USER 'landing_feedback'@'alamat_jaringan_docker' IDENTIFIED BY 'kata-sandi-acak-kuat';
GRANT SELECT, INSERT ON nama_database.feedback_messages TO 'landing_feedback'@'alamat_jaringan_docker';
```

Pengecekan lokal: `curl -I http://127.0.0.1:8085/` dan `curl -I http://127.0.0.1:8085/NMS/config/database.php` (rute kedua harus 404).
