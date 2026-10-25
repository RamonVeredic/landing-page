# NET.NMS — Landing Page dan Dokumentasi

Landing page NET.NMS menggunakan HTML, CSS, JavaScript, dan PHP untuk rendering halaman serta dokumentasi. Tidak memakai database atau formulir feedback. Tombol **Daftar** dan **Masuk** masih dinonaktifkan sampai tautan aplikasi tersedia.

## Menjalankan lewat CasaOS

Deployment hanya memakai **satu container** dari image:

```text
ghcr.io/ramonveredic/linms_landingpage:latest
```

File **`compose.yaml`** sudah disiapkan untuk CasaOS, termasuk ikon, judul, dan tombol pembuka Web UI. Tidak memerlukan `deploy.sh`, database, secret, maupun volume.

1. Pastikan image telah diterbitkan oleh GitHub Actions untuk Git tag rilis.
2. Di CasaOS, pilih **App Store → Custom Install → Import** dan tempel isi `compose.yaml`.
3. Install aplikasi, lalu buka melalui `http://IP-CASAOS:8085`.
4. Untuk mengubah port `8085`, sesuaikan **dua** tempat dalam YAML: `services.web.ports` (port host) dan `x-casaos.port_map`. Pastikan port tidak digunakan aplikasi lain.
5. Untuk deployment publik, gunakan reverse proxy HTTPS. Port `8085` secara bawaan terbuka pada seluruh antarmuka host; batasi akses dengan firewall jika hanya digunakan di jaringan lokal.

Image menggunakan `lscr.io/linuxserver/nginx` yang sudah menyediakan Nginx dan PHP-FPM, sehingga tidak memerlukan container PHP terpisah. Jika perlu, sesuaikan `PUID`, `PGID`, dan `TZ` langsung dalam `compose.yaml`.

**Memperbarui aplikasi:** setelah Git tag baru dipush dan GitHub Actions berhasil memublikasikan image, lakukan pull/update image dan recreate container lewat CasaOS. Push kode saja **tidak** otomatis memperbarui container yang sedang berjalan.

## Situs dan dokumentasi

- `/` — halaman utama dengan ilustrasi dashboard, fitur, dan navigasi ke dokumentasi.
- `/tentang` — informasi proyek NET.NMS.
- `/dokumentasi` — panduan penggunaan, katalog OID/SNMP, dan integrasi WPPConnect.
- `/healthz` — pemeriksaan kesehatan web server.

Untuk menambah dokumentasi, tambahkan entri dengan ID unik ke `source/config/site/docs-guides.php`. Isi `title`, `summary`, `icon`, dan daftar `sections`. Halaman `dokumentasi.php` membentuk katalog otomatis. Referensi OID tersedia di `source/config/site/oid-reference.php`. Jangan memasukkan kata sandi atau token produksi ke panduan publik.

## Membangun image (GitHub Actions)

Workflow `.github/workflows/build-images.yml` **hanya berjalan ketika Git tag baru cocok dengan `v*.*.*`**, misalnya `v1.2.3`. Push ke `master` dan aktivitas pull request **tidak memicu GitHub Actions**. Pada satu run tag tersebut, workflow memvalidasi Compose, menguji startup Nginx/PHP, kemudian memublikasikan image ke GHCR sebagai tag versi dan `latest`:

```sh
git checkout master
git pull --ff-only origin master
git tag v1.2.3
git push origin v1.2.3
```

Gunakan nomor tag yang belum pernah dibuat. Rilis akan menghasilkan:

- `ghcr.io/ramonveredic/linms_landingpage:v1.2.3`
- `ghcr.io/ramonveredic/linms_landingpage:latest`

Git tag `v*.*.*` adalah pola glob GitHub, bukan validator SemVer yang ketat.

Untuk build pengujian lokal:

```sh
docker build -f docker/Dockerfile -t linms_landingpage:local .
```

## Lokasi berkas

- `compose.yaml` — satu-satunya konfigurasi runtime CasaOS.
- `docker/Dockerfile` — membangun image untuk GHCR.
- `source/config/site/index.php` — landing page.
- `source/config/site/partials/` — header dan footer.
- `source/config/site/docs-guides.php` — katalog panduan yang dapat diperluas.
- `source/config/site/asset/css/styiles.css` — tampilan responsif.
- `source/config/site/asset/js/script.js` — menu dan interaksi dokumentasi.
- `source/config/nginx/default.conf` — pemetaan route PHP yang diizinkan.

Halaman PHP hanya dieksekusi melalui route Nginx yang telah ditentukan; akses file PHP langsung melalui URL diblokir.
