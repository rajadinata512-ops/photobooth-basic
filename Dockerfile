FROM richarvey/nginx-php-fpm:3.1.6

COPY . /var/www/html

ENV WEBROOT=/var/www/html/public
ENV SKIP_COMPOSER=0
ENV APP_ENV=production
ENV PHP_ERRORS_STDERR=1
ENV LOG_CHANNEL=stderr
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install --no-dev --optimize-autoloader

CMD ["/start.sh"]
