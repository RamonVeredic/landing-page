#!/bin/sh
set -eu

cd "$(dirname "$0")/.."

if [ -n "$(git status --porcelain)" ]; then
    echo 'Perubahan kode lokal belum disimpan di Git; deployment dibatalkan.' >&2
    exit 1
fi

for secret in feedback_db_password feedback_ip_hash_key; do
    if [ ! -f "../landing-page-state/secrets/$secret" ]; then
        echo "Berkas ../landing-page-state/secrets/$secret belum ada; siapkan state sebelum deploy." >&2
        exit 1
    fi
done

git pull --ff-only origin master
revision=$(git rev-parse HEAD)

docker compose pull

for service in nginx php; do
    image="ghcr.io/ramonveredic/landing-page-$service:latest"
    image_revision=$(docker image inspect "$image" --format '{{ index .Config.Labels "org.opencontainers.image.revision" }}')
    if [ "$image_revision" != "$revision" ]; then
        echo "Revisi image $service tidak sama dengan source Git; deployment dibatalkan." >&2
        exit 1
    fi
done

docker compose up -d --no-build
