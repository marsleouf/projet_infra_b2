# Projet infrastructure réseau
*Boileau Marius / Guiheneuc Quentin*

## Sujet : Serveur hardening / contrôle des objets connectés

### 1. Présentation
Ce projet se présente sous la forme suivante : Quentin dispose d'un serveur **Apache** consacré à la gestion des objets connectés de son domicile. Il peut, pour le moment, récolter des données en temps réél telles que, par exemple, la température d'une pièce ou plusieurs pièces.

Le but de ce projet est de sécuriser les accès du serveur, d'avoir un contrôle total sur les connexions des utilisateurs ainsi que sur les objets liés au serveur.

### 2. Techno utilisées
Afin de mener à bien la réalistaion de cette carcasse, par directives personelles, nous migrerons sur un serveur **NGINX**, et nous feront usage des languages suivants :

> Language web : html, css, javascript, php
> 
> Python pour les objets
>> Ainsi que le framework **Flask** pour les objets connectés
> 
> "*Language shell*" pour configurer la sécuritée