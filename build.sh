sudo chmod a+rwx -R ./
docker-compose down
docker run --rm -v $(pwd):/app composer install --ignore-platform-reqs
sudo chown -R $USER:$USER ./
if [ ! -e "./.env" ]; then
  echo "### Copying .env.example to .env"
  cp .env.example .env
  echo
fi

mkdir storage/logs
mkdir -p storage/framework/{sessions,views,cache}
chmod -R 775 storage/framework
sudo chown -R $USER:$USER ./
sudo chmod -R 777 storage
rm -rf bootstrap/cache
mkdir bootstrap/cache
sudo chmod -R 777 bootstrap/cache
chmod a+rwx -R ./
docker-compose build
docker-compose up -d
docker-compose exec muscatmizzi php artisan key:generate
docker-compose exec muscatmizzi php artisan config:cache
docker-compose exec muscatmizzi npm install
docker-compose exec muscatmizzi npm run production
echo "build success, please fill the .env with db info and run ./clearcache.sh"
