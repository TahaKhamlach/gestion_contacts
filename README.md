# Gestionnaire de Contacts

## Description
Ce projet est une application web de gestion de contacts développée en **PHP**, **MySQL**, **Bootstrap** et **JavaScript (AJAX)** dans le cadre du module de **Développement Web**.

L’application permet de :
- afficher la liste des contacts
- ajouter un contact
- modifier un contact
- supprimer un contact
- rechercher un contact en temps réel avec AJAX
- exporter les contacts au format CSV

---

## Technologies utilisées
- PHP
- MySQL
- HTML / CSS
- Bootstrap 5
- JavaScript
- AJAX
- XAMPP

---

## Prérequis
Avant d’exécuter le projet, il faut installer :
- **XAMPP**
- un navigateur web

---

## Installation et exécution

### 1. Copier le projet
Copier le dossier `gestion_contacts` dans le répertoire :

```text
C:\xampp\htdocs\
```

### 2. Démarrer XAMPP
Ouvrir **XAMPP Control Panel** puis démarrer :
- **Apache**
- **MySQL**

### 3. Importer la base de données
1. Ouvrir le navigateur
2. Aller à l’adresse :

```text
http://localhost/phpmyadmin
```

3. Créer une base de données nommée :

```text
gestion_contacts
```

4. Importer le fichier :

```text
gestion_contacts.sql
```

### 4. Lancer le projet
Ouvrir le navigateur puis accéder à :

```text
http://localhost/gestion_contacts/index.php
```

---

## Configuration de la base de données
Le fichier de connexion se trouve dans :

```text
config/database.php
```

Configuration utilisée :
- Hôte : `localhost`
- Base de données : `gestion_contacts`
- Utilisateur : `root`
- Mot de passe : vide

---

## Fonctionnalités réalisées

### 1. Accueil (`index.php`)
- affichage de tous les contacts dans un tableau Bootstrap responsive
- pagination de 10 contacts par page
- tri par nom, prénom et date d’ajout
- actions : voir, modifier, supprimer
- export de la sélection au format CSV

### 2. Ajout (`ajouter.php`)
- formulaire Bootstrap
- validation côté client
- validation côté serveur
- vérification de l’unicité de l’email
- message de succès ou d’erreur

### 3. Modification (`modifier.php`)
- formulaire pré-rempli
- modification des informations d’un contact
- conservation de l’email si non modifié
- mise à jour automatique de `date_modification`

### 4. Recherche (`rechercher.php`)
- recherche en temps réel avec AJAX
- recherche par nom, prénom, email ou téléphone
- affichage sans rechargement de la page

### 5. Export CSV (`exporter.php`)
- export de tous les contacts
- export de la sélection
- téléchargement automatique du fichier CSV

### 6. Consultation (`voir.php`)
- affichage détaillé d’un contact

### 7. Suppression (`supprimer.php`)
- suppression d’un contact avec confirmation

---

## Structure du projet

```text
gestion_contacts/
│
├── ajax/
│   └── search.php
│
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── app.js
│
├── config/
│   └── database.php
│
├── includes/
│   ├── footer.php
│   ├── header.php
│   └── init.php
│
├── ajouter.php
├── exporter.php
├── index.php
├── modifier.php
├── rechercher.php
├── supprimer.php
├── voir.php
├── gestion_contacts.sql
└── README.md
```

---

## Base de données
La base de données utilisée est :

```text
gestion_contacts
```

Elle contient la table :

```text
contacts
```

### Champs principaux
- `id`
- `nom`
- `prenom`
- `email`
- `telephone`
- `adresse`
- `date_naissance`
- `notes`
- `date_creation`
- `date_modification`

---

## Remarques
- L’email doit être unique.
- Les champs **nom** et **prénom** sont obligatoires.
- Le projet fonctionne en local avec **XAMPP**.
- Le fichier SQL contient la structure de la base ainsi que des données de test.

---

## Auteurs
Projet réalisé par :
- Taha Khamlach
- Salma Sadfi
- Tamai Ahmed
- Abdelhak Nabil
- Zakaria Amara

---

## Module
Projet universitaire réalisé dans le cadre du module de **Développement Web**.
