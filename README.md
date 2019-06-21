# Symfony

## Installation

```
composer create-project symfony/skeleton my-project
```

ou

```
composer create-project symfony/website-skeleton my-project
```

Activer le plugin Symfony dans PHPStorm pour que l'autocomplétion soit activée.

Pour afficher toutes les commandes Symfony de base : 
php bin/console

obs : en installant l'orm Doctrine nous verrons que des commandes supp apparaîtront.

### Afficher les commandes Symfoni

```shell
php bin/console
```

### Vérifier les pré-requis
```shell
composer require requirements-checker
```
ensuite dans le navigateur localhost/public/(rajouter à la main)check.php
afin de voir les conseils de symfony.
Une fois les mise à jour et corrections apportées on peut désinstaller composer.
```shell
composer remove requirements-checker
```

### Installer le serveur interne de Php
```shell
composer require symfony/web-server-bundle --dev
```

```shell
php bin/console server:run
```
ctrl+c pour couper le serveur et rendre le terminal disponible

ou

```shell
php bin/console server:start
php bin/console server:stop
```

### Installer Maker Bundel
```shell
composer require maker --dev
```

nous voyons que des commandes "make" supp ont été installées. Avec php bin/console list make nous pouvons les afficher.

obs : la bibliotheque config/packages/bundles.php s'incrémente automatiquement

INSTALLATION TERMINEE

## Doctrine

```shell
composer req orm
```

```shell
composer require orm
```

**Appeler la BDD :**
dans le dossier vendor/.env nous avons la ligne DATABASE_URL
il ne faut pas modifier ce fichier donc nous créons un nouveau fichier .env.local dans lequel nous copions la ligne DATABASE et on met à jour la ligne qui fait appel à la BDD
.env : 
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
.env.local :
DATABASE_URL=mysql://root:@127.0.0.1:3306/symfony

obs : les commandes intègrent dorénavant celle de Doctrine : php bin/console list doctrine

## Création

Créer la base de données (vide) :

```shell
php bin/console doctrine:database:create
```

Pour la supprimer :

```shell
php bin/console doctrine:database:drop --force
```

### Création CODE FIRST : 

**Créer les fichiers Entity avec Maker**
exemple : fichier category
```shell
php bin/console make:entity Category
```
puis on ajoute les colonnes de la table.

puis on créé le fichier de migration
```shell
php bin/console make:migration
```
puis on procède à la migration du/des fichiers
```shell
php bin/console doctrine:migrations:migrate
```
