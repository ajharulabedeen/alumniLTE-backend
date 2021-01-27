# FROM php:7.4

# FROM node:14.15.4-slim

# WORKDIR /usr/src/app

# COPY ./package*.json ./

# RUN npm install

# COPY . .

# CMD ["npm", "start"]
FROM php:7.3-apache

WORKDIR /app

COPY . .

RUN chown -R www-data:www-data /app && a2enmod rewrite

FROM composer:latest

RUN composer install
RUN php artisan key:generate

EXPOSE 8081

RUN php artisan serve