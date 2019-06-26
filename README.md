# Symfony

## Installation

```
composer create-project symfony/skeleton my-project
```
que le squelette
ou

```
composer create-project symfony/website-skeleton my-project
```
twig et divers package en plus du squelette

Activer le plugin Symfony dans PHPStorm pour que l'autocomplétion soit activée.

Pour afficher toutes les commandes Symfony de base : 
php bin/console

obs : en installant l'orm Doctrine nous verrons que des commandes supp apparaîtront.

### Afficher les commandes Symfony

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
dans le dossier racine, fichier .env nous y avons la ligne DATABASE_URL
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

### Création Entity CODE FIRST : 

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

## Création des fixtures (données de test dans la BDD)

installer le bundle suivant :
```shell
composer require --dev orm-fixtures
```

Dans DataFixtures/AppFixtures.php 
=> pas soucis de lisibilité nous le supprimons et le récréons avec maker pour le renommer.
```shell
php bin/console make:fixtures
```
nous créons dons un fichier que nous allons nommer CategoryFixtures.

Dans ce fichier nous ajoutons des données manuellement
> ajouter le use
> ajouter les données

```shell
php bin/console doctrine:fixtures:load
```

OBS : il faut refaire la commande fixtures:load en cas de modification manuelle des fichiers fixtures.

Pour appeler les données d'un fichier fixtures à un autre il faut employer le 
setReference
et le 
getReference

Pour que les données soient chargées dans le bon ordre, il faut implémenter une méthode dans la class :
implements DependentFixtureInterface

## ROUTEUR - CONTROLEUR - VUE

> Créer un contrôleur avec le make
```shell
php bin/console make:controller
```
ensuite avec /default dans l'url cela affiche le message du controller.

Si sur serveur Apache il faut au préalable installer le pack suivant :
```shell
composer require symfony/apache-pack
```

> Installer TWIG Template
```shell
 composer req twig
```

OBS : pour pouvoir faire fonctionner les @Param converter, il faut installer
```shell
composer req annotations
```

## PROFILER PACK
installe la barre de debug qui apparait dans le navigateur en bas
```shell
composer req profiler --dev
```


---

**OBS :** un include appelle seulement un template mais pas la base de donnée.
On utilise donc une méthode spécifique RENDER(CONTROLLER :
{{render(controller('cheminducontrolleurrouteur'))}}

exemple avec le footer. 

---

## WEBPACK ENCORE & NPM RUN WATCH // SCSS
permet de compiler les fichiers scss dans symfony

installation Webpack Encore :
```shell
composer req encore
```

installation NPM :
```shell
npm install
```

> dans dossier racine fichier webpack.config.js on doit décommenter les lignes que l'on souhaite pour les activer
exemple ici ligne 57 pour autoriser l'utilisation du compilateur sass

du coup il faut installer sass loader 
```shell
npm install sass-loader@^7.0.1 node-sass --save-dev
```

> dans assets/css on renomme fichier app.css en scss
> dans assets/js dans le fichier app.js on renomme .css en scss dans le require ligne 9

puis pour la compilation des fichiers :
```shell
npm run watch
```

---
obs : code Ajax, c'est le javascript qui appelle le serveur

## Images statiques versus Images Dynamique

### Images Statiques :
il convient pour ces dernières de procéder de façon automatique. Dans webpack.config.js on ajoute une méthode copyFiles afin de copier les images de asset à images dans public/build, qui sera généré automatique et se mettre à jour automatiquement grâce au npm run watch.

### Images Dynamique
images de la bdd.

nous créons dossier uploads dans lequel nous copions les images "dynamiques".

Exemple dans templates/article/show.html.twig

---
obs : fonction dump, ex dump($articles); permet d'afficher sur le nav le contenu de la variable.


## FORMULAIRES

obs :
```shell
composer req form
composer req validator
```

objet formbuilder