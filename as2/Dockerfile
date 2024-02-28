FROM php:8.1-apache
COPY cars/ /var/www/html/
RUN echo "ServerName localhost" >> /etc/apache2/apache2.confs
RUN docker-php-ext-install pdo pdo_mysql
EXPOSE 80