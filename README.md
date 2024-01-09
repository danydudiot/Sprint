# Épreuve du Sprint
### 2023-2024 - L2 Informatique Orléans, S3

## Présentation du Projet

Ce dépôt contient le projet développé par Dany Dudiot, Agathe Papineau et Nathan Rissot dans le cadre de l'épreuve du Sprint.

Il s'agit d'une application bancaire développée selon le modèle MVC (Modèle-Vue-Contrôleur), utilisant HTML5, CSS3, PHP et MySQL. L'application fonctionnait avec XAMPP mais a été conteneurisée avec Docker pour faciliter son déploiement et son exécution sur différents environnements.

## Fonctionnalités

L'application permet la gestion bancaire avec les fonctionnalités suivantes :
- Gestion des clients (création, modification, consultation)
- Gestion des comptes et contrats bancaires
- Gestion des opérations bancaires
- Système de rendez-vous entre clients et conseillers
- Différents niveaux d'accès : directeur, conseiller, agent d'accueil

## Structure du Projet

Le projet suit l'architecture MVC :
- **Modèle** : Gestion de la base de données et logique métier
- **Vue** : Interface utilisateur
- **Contrôleur** : Gestion des interactions et coordination

## Installation et Exécution

### Prérequis
- Docker et Docker Compose

### Instructions
1. Cloner le dépôt
2. Naviguer vers le répertoire du projet
3. Exécuter la commande : `docker-compose up --build`
4. Accéder à l'application via un navigateur à l'adresse : `http://localhost:8080`

## Conteneurisation

La mise en place du conteneur Docker a été faite en mai 2024, des correctifs ont été réalisés par IA, comme mettre tous les noms de la base de données et donc dans le code en minuscules, car aucune convention n'était définie. Tout fonctionnait sur XAMPP qui était visiblement plus souple sur la casse que Docker.

Pour retrouver le dépôt avant ces changements, rendez-vous sur ce commit : 2e6c492c6503441c16e86bc6b9e8809687876ca2


## Auteurs
- Dany Dudiot
- Agathe Papineau
- Nathan Rissot
