# Mofa

Mofa est un site de commerce de montre en Symfony / Vuejs.

## Installation

Cloner le dossier du projet :
```bash
git clone https://github.com/fabienlpt/mofa.git
```
Installer les dépendances du projet:
```bash
composer install
npm install
```
Création de la base de donnée:
```bash
symfony console d:m:m
# ou php bin/console d:m:m
 
symfony console d:f:l --no-interaction
# ou php bin/console d:f:l --no-interaction
```
Exécuter le projet
```bash
npm run dev
symfony serve
```
