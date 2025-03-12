FROM php:8.2-fpm-alpine

# Installation des dépendances nécessaires pour pdo_pgsql
RUN apk add --no-cache \
    postgresql-dev \
    && docker-php-ext-install pdo_pgsql