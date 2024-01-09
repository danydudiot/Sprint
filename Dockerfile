# Utilise une image officielle Apache avec PHP
FROM php:8.2-apache

# Active les extensions nécessaires (pdo_mysql et mysqli pour MySQL)
RUN docker-php-ext-install pdo_mysql mysqli && docker-php-ext-enable pdo_mysql mysqli

# Copie le code source dans le dossier du serveur web
COPY ./src/ /var/www/html/

# Copie le script d'init de la base
COPY ./src/init-db.sh /docker-entrypoint-initdb.d/init-db.sh
RUN chmod +x /docker-entrypoint-initdb.d/init-db.sh

# Donne les droits appropriés
RUN chown -R www-data:www-data /var/www/html

# Active le module de réécriture d'URL d'Apache
RUN a2enmod rewrite

# Expose le port 80
EXPOSE 80
