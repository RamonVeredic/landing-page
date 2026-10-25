#!/bin/sh
set -eu

cd "$(dirname "$0")/.."

if [ -n "$(git status --porcelain)" ]; then
    echo 'Perubahan kode lokal belum disimpan di Git; deployment dibatalkan.' >&2
    exit 1
fi

secret_dir=${LINMS_SECRETS_DIR:-/DATA/AppData/linms_landingpage/secrets}
for secret in feedback_db_password feedback_ip_hash_key; do
    if [ ! -f "$secret_dir/$secret" ]; then
        echo "Berkas $secret_dir/$secret belum ada; siapkan secrets sebelum deploy." >&2
        exit 1
    fi
done

git pull --ff-only origin master
revision=$(git rev-parse HEAD)

docker compose pull

image="ghcr.io/ramonveredic/linms_landingpage:latest"
image_revision=$(docker image inspect "$image" --format '{{ index .Config.Labels "org.opencontainers.image.revision" }}')
if [ "$image_revision" != "$revision" ]; then
    echo 'Revisi image tidak sama dengan source Git; deployment dibatalkan.' >&2
    exit 1
fi

docker compose up -d --no-build
