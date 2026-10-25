# Landing page NET.NMS

Satu repository Git berisi `source/` (halaman dan konfigurasi), `docker/` (Dockerfile dan skrip deploy), serta Compose. Data dan rahasia berada di folder saudara `../landing-page-state/`, di luar repository. `.env` lokal diabaikan Git; `.env.example` hanya berisi nama variabel dan contoh nilai, tanpa kata sandi.

## Hubungan Git, image, dan container

Push ke branch `master` membangun dua image GHCR, Nginx dan PHP, lalu menerbitkan tag `latest` seperti pola image staging. `docker/deploy.sh` menjalankan `git pull --ff-only`, menarik kedua image `latest`, lalu memeriksa label revisi Git di dalamnya. Label itu hanya pemeriksaan kecocokan source dengan image, bukan tag image yang perlu diatur pengguna. Jika salah satu image belum tersedia atau revisinya berbeda, container tidak diganti. Push Git saja tidak otomatis mengubah container berjalan.

Di dalam kedua image, kode berada pada `/workspace/landing-source`. Symlink Nginx dan PHP menunjuk ke sana. Mode pengembangan memasang `source/` read-only pada path yang sama; mode produksi memakai kode yang disalin saat build. Perubahan di `source/` baru masuk image produksi setelah push, build GitHub Actions selesai, dan deploy dijalankan.

## Susunan direktori

```text
landing-page/                 # repository Git
  .env.example               # template aman untuk Git
  .gitignore
  .dockerignore
  compose.yaml               # tarik image GHCR
  compose.dev.yaml           # konfigurasi dev mandiri: build lokal + source mount
  docker/
  source/
landing-page-state/           # di luar repository Git
  secrets/
    feedback_db_password
    feedback_ip_hash_key
```

Image hanya menyalin `source/config/nginx`, `source/config/php`, dan `source/config/site` yang diperlukan. `.dockerignore` mengecualikan Git, rahasia, log, dan berkas runtime dari build context. Nginx hanya melayani aset di `/asset/` dan rute halaman yang ditentukan; folder source dan secret tidak disajikan sebagai file publik.

## Persiapan awal

1. Salin `.env.example` menjadi `.env` di akar repository. Isi `LANDING_NMS_BASE_URL` dengan URL NMS yang benar. `/NMS` hanya cocok jika reverse proxy memang merutekannya ke NMS.
2. Buat `../landing-page-state/secrets/`. Isi `feedback_ip_hash_key` dengan kunci acak, misalnya `openssl rand -hex 32 > ../landing-page-state/secrets/feedback_ip_hash_key`.
3. Jika formulir masukan dipakai, buat akun database khusus dengan hak `SELECT` dan `INSERT` pada tabel `feedback_messages`, isi `FEEDBACK_DB_NAME` dan `FEEDBACK_DB_USER` di `.env`, lalu simpan kata sandi di `../landing-page-state/secrets/feedback_db_password`. Bila belum dikonfigurasi, buat berkas kata sandi kosong agar container bisa mulai; formulir akan menampilkan kegagalan secara jelas.
4. Pada host Linux, berikan akses baca hanya ke user PHP: `chown 82:82 ../landing-page-state/secrets/*` dan `chmod 400 ../landing-page-state/secrets/*`. Jika paket GHCR privat, login ke `ghcr.io` sebelum deploy.

Jalankan `./docker/deploy.sh` dari checkout Git yang bersih setelah build GitHub Actions untuk push `master` selesai. Jika GitHub Actions masih membangun, ulangi perintah setelah selesai. Web secara bawaan terikat pada `127.0.0.1:8085`; pasang reverse proxy HTTPS untuk akses publik. Jangan buka port PHP-FPM.

Untuk pengembangan lokal, jalankan `docker compose -f compose.dev.yaml up -d --build`. File dev ini lengkap dan dapat dijalankan sendiri, memakai project Compose terpisah serta port `127.0.0.1:8086`. Perubahan halaman pada `source/` langsung terbaca melalui mount; perubahan konfigurasi Nginx perlu reload. Mode ini memakai rahasia di folder state yang sama, jadi gunakan database pengembangan jika menguji formulir. Hentikan dengan `docker compose -f compose.dev.yaml down`.

Pengecekan lokal: `curl -I http://127.0.0.1:8085/` harus memberi 200, sedangkan `curl -I http://127.0.0.1:8085/state/secrets/feedback_ip_hash_key` harus memberi 404.
