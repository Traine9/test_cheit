FROM php:7.2-apache

RUN mkdir -p /var/www/keys
RUN cat /etc/apache2/sites-available/000-default.conf
RUN echo '<VirtualHost *:80>\n\
\n\
\n\
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

RUN apt-get update && apt-get install -y mc libpq-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev libmcrypt-dev \
    && apt-get install -y libz-dev libxml2-dev libmemcached-dev memcached

RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd

RUN for i in $(seq 1 3); do pecl install -o igbinary && s=0 && break || s=$? && sleep 1; done; (exit $s) \
    && docker-php-ext-enable igbinary \
    \
# Install memcached (manualy build in order to be able to enable igbinary)
    && for i in $(seq 1 3); do echo no | pecl install -o --nobuild memcached && s=0 && break || s=$? && sleep 1; done; (exit $s) \
    && cd "$(pecl config-get temp_dir)/memcached" \
    && phpize \
    && ./configure --enable-memcached-igbinary \
    && make \
    && make install \
    && docker-php-ext-enable memcached
RUN docker-php-ext-install xmlrpc

EXPOSE 80
