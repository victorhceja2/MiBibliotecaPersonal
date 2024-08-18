FROM php:8.1-apache

# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Copiar el código de la aplicación al contenedor
COPY . /var/www/html/

# Exponer el puerto 80
EXPOSE 8001