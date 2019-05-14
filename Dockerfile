FROM ubuntu:bionic

WORKDIR /app

COPY . /app

ENV DEBIAN_FRONTEND=noninteractive

RUN apt update && \
  apt install --no-install-recommends -y php php-xml php-zip ca-certificates git && \
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
  php composer-setup.php && \
  rm composer-setup.php && \
  php composer.phar install
