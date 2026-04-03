#!/bin/bash
# Run this in Hostinger Terminal after uploading files
# cd ~/public_html/New-electric && bash hostinger-setup.sh

echo "=== Copying .env ==="
cp .env.production .env

echo "=== Generating app key ==="
php8.3 artisan key:generate

echo "=== Running migrations ==="
php8.3 artisan migrate --force

echo "=== Linking storage ==="
php8.3 artisan storage:link

echo "=== Caching config/routes/views ==="
php8.3 artisan config:cache
php8.3 artisan route:cache
php8.3 artisan view:cache

echo "=== Setting permissions ==="
chmod -R 775 storage
chmod -R 775 bootstrap/cache

echo "=== Done! Visit https://new-electric.aiwebandus.com ==="
