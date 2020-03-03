# !!!!!!!!!!!!!!! DON'T EDIT THIS FILE. !!!!!!!!!!!!!!!!!
# GOTO ../web

FROM php:7.2-apache

RUN mkdir -p /var/www/keys
RUN cat /etc/apache2/sites-available/000-default.conf
RUN echo '<VirtualHost *:80>\n\
\n\
\n\
        ServerName pb-api \n\
        ServerAdmin webmaster@localhost \n\
        DocumentRoot /var/www/html/public \n\
        ErrorLog ${APACHE_LOG_DIR}/error.log \n\
        CustomLog ${APACHE_LOG_DIR}/access.log combined \n\
        \n\
        <Directory /var/www/html/public> \n\
            DirectoryIndex index.html index.php \n\
            Options Indexes FollowSymLinks \n\
            AllowOverride All \n\
            Require all granted \n\
        </Directory> \n\
        \n\
</VirtualHost> \n\
 \n\
 ' > /etc/apache2/sites-available/000-default.conf

RUN cat /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

EXPOSE 80

# !!!!!!!!!!!!!!! DON'T EDIT THIS FILE. !!!!!!!!!!!!!!!!!
# GOTO ../web
