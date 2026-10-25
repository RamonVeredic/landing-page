# NET.NMS landing page — CasaOS

Production uses **one container** and **one Compose file** (`compose.yaml`). The image `ghcr.io/ramonveredic/linms_landingpage:latest` is built from `lscr.io/linuxserver/nginx:latest`, which already includes Nginx and PHP-FPM (including PDO MySQL). No separate PHP image or database container is built.

## Install in CasaOS

Import this repository's `compose.yaml` in CasaOS **Custom Install / Import Compose**. The image must already have been published by the GitHub Actions workflow after merging the changes. If GHCR is private, log in first using credentials that can read the package.

Before starting the container, create the two local secret files **on the CasaOS host**, which are intentionally not committed to Git:

```sh
sudo mkdir -p /DATA/AppData/linms_landingpage/secrets
sudo touch /DATA/AppData/linms_landingpage/secrets/feedback_db_password
openssl rand -hex 32 | sudo tee /DATA/AppData/linms_landingpage/secrets/feedback_ip_hash_key >/dev/null
sudo chown 1000:1000 /DATA/AppData/linms_landingpage/secrets/*
sudo chmod 400 /DATA/AppData/linms_landingpage/secrets/*
```

Write the feedback database account password to `feedback_db_password` only if the form should submit to MySQL. The database user should have only `SELECT` and `INSERT` permissions on the `feedback_messages` table. If database settings or password are missing, web pages still work but submitting feedback fails with an error.

The default app URL is `http://CASAOS-SERVER-IP:8085`. Port 8085 binds all host interfaces so the CasaOS LAN can reach it. Use `LANDING_BIND=127.0.0.1` when a local reverse proxy is handling all access; use HTTPS for public deployment. With a reverse proxy and HTTPS, leave `LANDING_SECURE_COOKIE=1`. For **HTTP-only** LAN testing, set `LANDING_SECURE_COOKIE=0` (do not use that setting on the public internet).

Default values are in `.env.example`; you can provide environment variables in CasaOS as needed: `PUID`, `PGID`, `TZ`, `LANDING_PORT`, `LINMS_SECRETS_DIR`, `LANDING_NMS_BASE_URL`, and the `FEEDBACK_DB_*` variables. The `PUID`/`PGID` must match the account that can read the two secret files. If you use a different secret directory, set `LINMS_SECRETS_DIR` before Compose starts.

## Build and deploy

Publishing is triggered **only by pushing a Git tag matching `v*.*.*`** (for example `v1.2.3`), not by ordinary pushes to `master`. `.github/workflows/build-images.yml` builds and publishes a **single** multi-architecture image tagged both `latest` and the version (for example `v1.2.3`). Pull requests targeting `master` still run build and startup checks but **do not publish** an image. GitHub Actions packages permissions and GHCR package visibility must allow publishing and pulling.

Create a release after merging changes to `master`:

```sh
git checkout master
git pull --ff-only origin master
git tag v1.2.3
git push origin v1.2.3
```

Use a new tag for each release. The GitHub Actions tag filter is a glob, not a strict semantic-version validator.

For a local test:

```sh
docker build -f docker/Dockerfile -t linms_landingpage:local .
```

If using the Git checkout and a .env file, `./docker/deploy.sh` pulls the matching GHCR image after verifying the image revision against the Git commit. CasaOS can instead pull/update the image through its UI. Existing containers are not replaced automatically merely by pushing to GitHub.

App code is baked into `/app/www` in the image, and custom Nginx routes listen on container port 8080. LinuxServer's s6 supervision runs both Nginx and PHP-FPM, with PHP requests sent to `127.0.0.1:9000`. No source mount is needed for production. Only `/asset/` is publicly served as static content; arbitrary PHP and secret files remain blocked by the custom Nginx site configuration.

Health endpoint: `GET /healthz`. Test locally: `curl -I http://127.0.0.1:8085/healthz`.

Secrets in `LINMS_SECRETS_DIR` must be backed up and retained during image upgrades. Do not commit the credentials or key.
