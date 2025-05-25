FROM ubuntu:22.04

ARG PROJECT_NAME
ARG WWWGROUP
ARG NODE_VERSION=20
ARG MYSQL_CLIENT="mysql-client"
ARG POSTGRES_VERSION=15

WORKDIR /var/www/html/$PROJECT_NAME

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=UTC

RUN echo 'umask 000' >> /etc/bash.bashrc

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y apache2 libapache2-mod-fcgid gnupg gosu curl ca-certificates zip unzip git supervisor sqlite3 libcap2-bin libpng-dev python2 dnsutils librsvg2-bin fswatch ffmpeg nano \
    && curl -sS 'https://keyserver.ubuntu.com/pks/lookup?op=get&search=0x14aa40ec0831756756d7f66c4f4ea0aae5267a6c' | gpg --dearmor | tee /etc/apt/keyrings/ppa_ondrej_php.gpg > /dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/ppa_ondrej_php.gpg] https://ppa.launchpadcontent.net/ondrej/php/ubuntu jammy main" > /etc/apt/sources.list.d/ppa_ondrej_php.list

RUN apt-get update \
    && apt-get install -y php8.3 php8.3-fpm php8.3-cli php8.3-dev \
       php8.3-pgsql php8.3-sqlite3 php8.3-gd \
       php8.3-curl php8.3-imap php8.3-mysql php8.3-mbstring \
       php8.3-xml php8.3-zip php8.3-bcmath php8.3-soap \
       php8.3-intl php8.3-readline php8.3-ldap php8.3-msgpack php8.3-igbinary \
       php8.3-redis php8.3-swoole php8.3-memcached php8.3-pcov php8.3-imagick \
       php8.3-xdebug \
    && curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer \
    && curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg \
    && echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_VERSION.x nodistro main" > /etc/apt/sources.list.d/nodesource.list
    
RUN apt-get update \
    && apt-get install -y nodejs \
    && npm install -g npm \
    && npm install -g pnpm \
    && npm install -g bun \
    && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | gpg --dearmor | tee /etc/apt/keyrings/yarn.gpg >/dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/yarn.gpg] https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list \
    && curl -sS https://www.postgresql.org/media/keys/ACCC4CF8.asc | gpg --dearmor | tee /etc/apt/keyrings/pgdg.gpg >/dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/pgdg.gpg] http://apt.postgresql.org/pub/repos/apt jammy-pgdg main" > /etc/apt/sources.list.d/pgdg.list

RUN apt-get update \
    && apt-get install -y yarn \
    && apt-get install -y $MYSQL_CLIENT \
    && apt-get install -y postgresql-client-$POSTGRES_VERSION \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN a2enmod rewrite proxy_fcgi setenvif \
    && a2enconf php8.3-fpm

# MongoDB
RUN apt-get update && apt-get install libtool

RUN pecl channel-update pecl.php.net \
    && echo "no" | pecl install mongodb \
    && echo "extension=mongodb.so" > /etc/php/8.3/mods-available/mongodb.ini \
    && phpenmod mongodb
# check install success php -m | grep mongodb

RUN chown -R www-data:www-data /var/www/html && chmod -R 775 /var/www/html

# Configurar umask para que los archivos creados tengan permisos de escritura
# Permitir lectura/escritura para usuario, grupo, y otros
# RUN echo "umask 000" >> /etc/profile

COPY . /var/www/html/$PROJECT_NAME/

RUN echo '<VirtualHost *:80> \n\
    ServerAdmin webmaster@localhost \n\
    DocumentRoot /var/www/html/'$PROJECT_NAME'/public \n\
    <Directory /var/www/html/'$PROJECT_NAME'/public> \n\
        Options Indexes FollowSymLinks \n\
        AllowOverride All \n\
        Require all granted \n\
    </Directory> \n\
    ErrorLog ${APACHE_LOG_DIR}/error.log \n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined \n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

RUN echo 'memory_limit = 256M \n\
upload_max_filesize = 64M \n\
post_max_size = 64M \n\
max_execution_time = 300 \n\
max_input_vars = 1500' > /etc/php/8.3/cli/conf.d/99-custom.ini

RUN setcap "cap_net_bind_service=+ep" /usr/bin/php8.3

#RUN composer install
#RUN yarn install

EXPOSE 80/tcp 5176

CMD ["sh", "-c", "service php8.3-fpm start && apache2ctl -D FOREGROUND"]
# CMD ["tail", "-f", "/dev/null"]

