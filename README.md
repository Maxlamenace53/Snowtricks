# Projet Snowtricks

### Présentation


Mon projet de fin d'année pour l'obtention du titre pro développeur web / Web mobile est un site communautaire de partage de figures de snowboard. Il permet aux utilisateurs de consulter les figures existantes, de créer un compte, de se connecter, de créer des figures, de les modifier et de les supprimer. Les utilisateurs peuvent également commenter les figures et les vidéos associées. 
J'ai placé dans le dossier [Dossier formation](Dossier%20formation) les dossiers que j'ai rédigés en format pdf pour la formation.
- [Dossier cursus](Dossier%20formation/Dossier%20Cursus%20DWM%202023.pdf) qui contient les informations sur mon parcours.
- [Dossier Snowtricks](Dossier%20formation/Dossier%20Snowtricks%20DWWM%202023.pdf) qui contient les informations sur le projet Snowtricks suivant le cahier des charges.
- [Cahier des charges](Dossier%20formation/Projet_fin_annee.pdf)


## Installation
#### Serveur PHP
```shell
php -S localhost:8000 -t public
```
#### demarré docker et joindre maildev sur le port 1081
```shell bash
docker-compose up -d
```

#### Base de donnée
```dotenv
DATABASE_URL="mysql://max:@127.0.0.1:3306/snowtricks?serverVersion=8&charset=utf8mb4"
```
#### Création de la base de donnée
```shell
php bin/console make:migration
```
#### Mise à jour de la base de donnée
```shell
php bin/console doctrine:migrations:migrate
```
#### Création des fixtures
```shell
php bin/console make:fixture
```
#### Chargement des fixtures
```shell
php bin/console doctrine:fixtures:load
```
#### Installation des dépendances
```shell
```;shell
composer require symfony/webpack-encore-bundle
composer require symfony/ux-vue

```
#### Reinitalisation de ma base de donnée
```;shell
php bin/console doctrine:database:drop --force
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load

```