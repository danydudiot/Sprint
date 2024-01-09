#!/bin/bash
# Script d'initialisation de la base de données MySQL pour le projet Sprint

# Attendre que MySQL soit prêt
until mysqladmin ping -h db --silent; do
    echo "En attente de la base de données..."
    sleep 2
done

# Exécuter les scripts SQL
mysql -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" < /var/www/html/Modele/SPRINT.SQL
mysql -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE" < /var/www/html/Modele/INSERT.SQL

echo "Base de données initialisée."
