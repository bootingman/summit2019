FROM romeoz/docker-nginx-php:7.3

WORKDIR /app/

COPY . .

RUN apt update && \
  apt install --no-install-recommends -y php-xml php-zip ca-certificates git && \
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
  php composer-setup.php && \
  rm composer-setup.php && \
  php composer.phar install && \
  chown -R www-data:www-data . && \
  rm -rf /var/www/app && \
  ln -s /app/web /var/www/app

EXPOSE 80 443

CMD ["/usr/bin/supervisord"]
