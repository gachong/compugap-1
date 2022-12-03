FROM ubuntu:18.04

WORKDIR /var/www/html

ENV TZ UTC
ENV PHP_VERSION 7.4
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN set -x \
    && echo 'debconf debconf/frontend select Noninteractive' | debconf-set-selections \
    && apt-get update \
    && apt-get install -y gnupg \
    && echo "deb http://ppa.launchpad.net/ondrej/php/ubuntu bionic main" > /etc/apt/sources.list.d/ppa_ondrej_php.list \
    && echo "deb http://ppa.launchpad.net/nginx/development/ubuntu bionic main" > /etc/apt/sources.list.d/ppa_nginx_mainline.list \
    && apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys E5267A6C \
    && apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys C300EE8C \
    && apt-get update \
    && apt-get install -y wget curl zip unzip git vim supervisor sqlite3 openssh-server mysql-client  \
    && apt-get install -y nginx php$PHP_VERSION-common php$PHP_VERSION-fpm php$PHP_VERSION-cli \
       php$PHP_VERSION-pgsql php$PHP_VERSION-sqlite3 php$PHP_VERSION-gd \
       php$PHP_VERSION-curl php$PHP_VERSION-memcached \
       php$PHP_VERSION-imap php$PHP_VERSION-mysql php$PHP_VERSION-mbstring \
       php$PHP_VERSION-xml php$PHP_VERSION-zip php$PHP_VERSION-bcmath php$PHP_VERSION-soap \
       php$PHP_VERSION-intl php$PHP_VERSION-readline php$PHP_VERSION-xdebug \
       php$PHP_VERSION-msgpack php$PHP_VERSION-igbinary php$PHP_VERSION-ldap php$PHP_VERSION-redis\
       php$PHP_VERSION-mysql\
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && mkdir /run/php \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    && echo "daemon off;" >> /etc/nginx/nginx.conf

# Install node
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get install nodejs \
    && node -v \
    && npm -v

# Install Dockerize
ENV DOCKERIZE_VERSION v0.6.1
RUN wget -q https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-linux-amd64-$DOCKERIZE_VERSION.tar.gz

RUN ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log

COPY vhost.conf /etc/nginx/sites-available/default
COPY php-fpm.conf /etc/php/$PHP_VERSION/fpm/php-fpm.conf
COPY php-max-size.conf /etc/php/$PHP_VERSION/fpm/conf.d/99-php-max-size.ini
COPY php.ini /etc/

EXPOSE 80

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY start-container /usr/local/bin/start-container
RUN chmod +x /usr/local/bin/start-container

RUN chown -R 33:33 /var/www/html

ENTRYPOINT ["start-container"]
