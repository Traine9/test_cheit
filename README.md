how to install:<br>
cd {projectPath}<br>
cat env.example > .env<br>
echo "127.0.0.1 test-db" > /etc/hosts<br>
php artisan migrate<br>
cd docker<br>
docker-compose up -d --build<br>
