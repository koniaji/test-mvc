FROM zvinger/docker-fpm:latest

RUN mkdir -p /tmp/app-cache/vendor

COPY src/composer.json src/composer.lock* /tmp/app-cache/

RUN cd /tmp/app-cache && composer install --no-ansi --no-dev --no-interaction --no-progress --no-scripts --optimize-autoloader && ln -s /tmp/app-cache/vendor /var/www/vendor

ADD ./src /var/www
ADD ./scripts /scripts
RUN chmod +x /scripts/init/start_app.sh

CMD /scripts/init/start_app.sh
