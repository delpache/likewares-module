# Likewares CRM Module Generator

## 1. Introduction

Likewares CRM Module Generator créera un exemple de module pour vous avec une seule commande

Il comprend de nombreuses fonctionnalités exigeantes qui permettent à votre entreprise d'évoluer en un rien de temps :

* Créer un module avec une seule commande.

## 2. Requirements

* **Likewares CRM**: v1.0.x

## 3. Installation

### Installation avec composer

Allez dans le dossier racine de **Likewares CRM** et exécutez la commande suivante

~~~php
composer require likewares/likewares-module
~~~

> C'est tout, il ne reste plus qu'à exécuter le projet sur le domaine spécifié.

## 4. Résumé

Après l'installation, vous verrez qu'il existe une liste de commandes de modules qui vous aideront à faciliter la création de vos paquets.

Voici la liste des commandes. Si aucun argument n'est fourni, le module demandera l'argument requis.

| S. No. | Commandes                    | Info                                                                                                        | Required Arguments                | Optional Arguments  |
| :----- |:-----------------------------|:------------------------------------------------------------------------------------------------------------|:----------------------------------| :------------------ |
| 01.    | module:make                 | [Créer un nouveau module.](#1-créer-un-nouveau-module)                                                      | module-name                       | --force, --plain    |
| 02.    | module:make-controller      | [Créer un nouveau controller.](#2-créer-un-nouveau-controller)                                              | controller-name, module-name     | --force             |
| 03.    | module:make-route           | [Créer un nouveau fichier de routes.](#3-créer-un-nouveau-fichier-de-routes)                                | module-name                      | --force             |
| 04.    | module:make-model           | [Créer une nouvelle classe model.](#4-créer-une-nouvelle-classe-model)                                      | model-name, module-name          | --force             |
| 05.    | module:make-model-proxy     | [Créer une nouvelle classe de model proxy.](#5-créer-une-nouvelle-classe-de-model-proxy)                    | model-proxy-name, module-name    | --force             |
| 06.    | module:make-model-contract  | [Créer un nouveau model de contrat.](#6-créer-un-nouveau-model-de-contrat)                                  | model-contract-name, module-name | --force             |
| 07.    | module:make-migration       | [Créer une nouvelle classe de migration.](#7-créer-une-nouvelle-classe-de-migration)                        | migration-name, module-name      |                     |
| 08.    | module:make-seeder          | [Créer une nouvelle classe seeder.](#08-créer-une-nouvelle-classe-seeder)                                   | seeder-name, module-name         | --force             |
| 09.    | module:make-request         | [Créer une nouvelle classe request.](#09-créer-une-nouvelle-classe-request)                                 | request-name, module-name        | --force             |
| 10.    | module:make-middleware      | [Créer une nouvelle classe middleware.](#10-créer-une-nouvelle-classe-middleware)                           | middleware-name, module-name     | --force             |
| 11.    | module:make-datagrid        | [Créer une nouvelle classe de datagrid.](#11-créer-une-nouvelle-classe-de-datagrid)                         | datagrid-name, module-name       | --force             |
| 12.    | module:make-repository      | [Créer une nouvelle classe repository.](#12-créer-une-nouvelle-classe-repository)                           | repository-name, module-name     | --force             |
| 13.    | module:make-provider        | [Créer une nouvelle classe service provider.](#13-créer-une-nouvelle-classe-service-provider)               | provider-name, module-name       | --force             |
| 14.    | module:make-event           | [Créer une nouvelle classe event.](#14-créer-une-nouvelle-classe-event)                                     | event-name, module-name          | --force             |
| 15.    | module:make-listener        | [Créer une nouvelle classe listener.](#15-créer-une-nouvelle-classe-listener)                               | listener-name, module-name       | --force             |
| 16.    | module:make-notification    | [Créer une nouvelle classe notification.](#16-créer-une-nouvelle-classe-de-notification)                    | notification-name, module-name   | --force             |
| 17.    | module:make-mail            | [Créer une nouvelle classe mail.](#17-créer-une-nouvelle-classe-mail)                                       | mail-name, module-name           | --force             |
| 18.    | module:make-command         | [Créer une nouvelle classe command.](#18-créer-une-nouvelle-classe-command)                                 | command-name, module-name        | --force             |
| 19.    | module:make-module-provider | [Créer une nouvelle classe module service provider.](#19-créer-une-nouvelle-classe-module-service-provider) | provider-name, module-name       | --force             |


**--force** : Pour écraser les fichiers

**--plain** : Lorsque vous n'avez besoin que d'un modèle de structure de répertoire, les fichiers ne sont pas inclus lorsque cet argument est passé

## 5. Utilisation

### Commençons avec notre première commande

#### 01. Créer un nouveau module

Cette commande génère tous les fichiers nécessaires que vous avez précédemment créés manuellement pour votre paquet.

~~~php
php artisan module:make ACME/TestModule
~~~

Par exemple, si vous souhaitez créer un module nommé '**TestModule**', vous devez utiliser la commande suivante,

~~~php
php artisan module:make ACME/TestModule
~~~

Cela créera automatiquement toute la structure du répertoire pour que vous n'ayez pas à faire manuellement l'enregistrement des itinéraires, des vues, etc.

##### New module with just directory structure

Si vous voulez faire les choses manuellement et n'avoir besoin que de structures de dossiers, il y a un argument optionnel connu sous le nom de '**plain**'. Voici un exemple,

~~~php
php artisan module:make ACME/TestModule --plain
~~~

##### Nouveau module avec commande force

Si un dossier ou un module est déjà présent, la commande simple ne fonctionnera pas. Pour résoudre ce problème, il faut donc utiliser la commande force.

~~~php
php artisan module:make ACME/TestModule --force
~~~

#### 02. Créer un nouveau controller

Cette commande génère un nouveau controller.

~~~php
php artisan module:make-controller TestController ACME/TestModule
~~~

##### Créer un nouveau controller avec la command force

Si le controller est déjà présent, vous devez utiliser la commande force.

~~~php
php artisan module:make-controller TestController ACME/TestModule --force
~~~

#### 03. Créer un nouveau fichier de routes

Si vous souhaitez créer une route, vous devez utiliser cette commande et enregistrer votre fichier de routes dans le fournisseur de services, c'est-à-dire '**ACME\TestModule\Providers\TestModuleServiceProvider**'.

~~~php
php artisan module:make-route ACME/TestModule
~~~

##### Créer un nouveau fichier de routes avec la command force

Si le fichier des routes est déjà présent et que vous souhaitez l'ignorer, vous devez utiliser la commande force.

~~~php
php artisan module:make-route ACME/TestModule --force
~~~

#### 04. Créer une nouvelle classe de model

Cette commande créera les fichiers suivants,

* Nouvelle classe model dans le repertoire '**modules/ACME/TestModule/src/Models**'.
* Nouvelle classe model proxy dans le repertoire '**modules/ACME/TestModule/src/Models**'.
* Nouveau model contract dans le repertoire '**modules/ACME/TestModule/src/Contracts**'.

~~~php
php artisan module:make-model TestModel ACME/TestModule
~~~

##### Créer une nouvelle classe de model avec la command force

Cette commande écrasera les trois fichiers.

~~~php
php artisan module:make-model TestModel ACME/TestModule --force
~~~

#### 05. Créer une nouvelle classe de model proxy

Cette commande créera une nouvelle classe model proxy dans le répertoire '**modules/ACME/TestModule/src/Models**'.

~~~php
php artisan module:make-model-proxy TestModelProxy ACME/TestModule
~~~

##### Créer une nouvelle classe de model proxy avec la command force

Si la classe proxy du modèle est déjà présente, vous pouvez utiliser la commande force pour l'écraser.

~~~php
php artisan module:make-model-proxy TestModelProxy ACME/TestModule --force
~~~

#### 06. Créer un nouveau model de contrat

Cette commande crée un nouveau model de contrat le répertoire '**modules/ACME/TestModule/src/Contracts**'.

~~~php
php artisan module:make-model-contract TestContract ACME/TestModule
~~~

##### Créer un nouveau model de contrat avec la command force

Si le model de contrat est déjà présent, vous pouvez utiliser la commande force pour l'écraser.

~~~php
php artisan module:make-model-contract TestDataGrid ACME/TestModule --force
~~~

#### 07. Créer une nouvelle classe de migration

Cette commande créera une nouvelle classe de migration dans le répertoire '**modules/ACME/TestModule/src/Database/Migrations**'.

~~~php
php artisan module:make-migration TestMigration ACME/TestModule
~~~

#### 08. Créer une nouvelle classe seeder

Cette commande créera une nouvelle classe seeder dans le répertoire '**modules/ACME/TestModule/src/Database/Seeders**'.

~~~php
php artisan module:make-seeder TestSeeder ACME/TestModule
~~~

##### Créer une nouvelle classe seeder avec la command force

Si la classe seeder existe déjà, vous pouvez utiliser la commande force pour l'écraser.

~~~php
php artisan module:make-seeder TestSeeder ACME/TestModule --force
~~~

#### 09. Créer une nouvelle classe request

Cette commande créera une nouvelle classe request dans le répertoire '**modules/ACME/TestModule/src/Http/Requests**'.

~~~php
php artisan module:make-request TestRequest ACME/TestModule
~~~

##### Créer une nouvelle classe request avec la command force

Si la classe request existe déjà, vous pouvez utiliser la commande force pour l'écraser.

~~~php
php artisan module:make-request TestRequest ACME/TestModule --force
~~~

#### 10. Créer une nouvelle classe middleware

Cette commande va créer une nouvelle classe middleware dans le répertoire '**modules/ACME/TestModule/src/Http/Middleware**'.

~~~php
php artisan module:make-middleware TestMiddleware ACME/TestModule
~~~

##### Créer une nouvelle classe middleware avec la command force

Si la classe middleware existe déjà, vous pouvez utiliser la commande force pour l'écraser.

~~~php
php artisan module:make-middleware TestMiddleware ACME/TestModule --force
~~~

#### 11. Créer une nouvelle classe data grid

Cette commande crée une nouvelle classe data grid dans le répertoire '**modules/ACME/TestModule/src/Datagrids**'.

~~~php
php artisan module:make-datagrid TestDataGrid ACME/TestModule
~~~

##### Créer une nouvelle classe data grid avec la command force

Si la classe data grid existe déjà, vous pouvez utiliser la commande force pour l'écraser.

~~~php
php artisan module:make-datagrid TestDataGrid ACME/TestModule --force
~~~

#### 12. Créer une nouvelle classe repository

Cette commande créera une nouvelle classe repository dans le répertoire '**modules/ACME/TestModule/src/Repositories**'.

~~~php
php artisan module:make-repository TestRepository ACME/TestModule
~~~

##### Créer une nouvelle classe repository avec la command force

Si la classe repository existe déjà, vous pouvez utiliser la commande force pour l'écraser.

~~~php
php artisan module:make-repository TestRepository ACME/TestModule --force
~~~

#### 13. Créer une nouvelle classe service provider

Cette commande créera une nouvelle classe service provider dans le répertoire '**modules/ACME/TestModule/src/Providers**'.

~~~php
php artisan module:make-provider TestServiceProvider ACME/TestModule
~~~

##### Créer une nouvelle classe service provider avec la command force

Si la classe service provider existe déjà, vous pouvez utiliser la commande force pour l'écraser.

~~~php
php artisan module:make-provider TestServiceProvider ACME/TestModule --force
~~~

#### 14. Créer une nouvelle classe event

Cette commande crée une nouvelle classe event dans le répertoire '**modules/ACME/TestModule/src/Events**'.

~~~php
php artisan module:make-event TestEvent ACME/TestModule
~~~

##### Créer une nouvelle classe event avec la command force

Si la classe event existe déjà, vous pouvez utiliser la commande force pour l'écraser.

~~~php
php artisan module:make-event TestEvent ACME/TestModule --force
~~~

#### 15. Créer une nouvelle classe listener

Cette commande crée une nouvelle classe listener dans le répertoire '**modules/ACME/TestModule/src/Listeners**'.

~~~php
php artisan module:make-listener TestListener ACME/TestModule
~~~

##### Créer une nouvelle classe listener avec la command force

Si la classe listener existe déjà, vous pouvez utiliser la commande force pour l'écraser.

~~~php
php artisan module:make-listener TestListener ACME/TestModule --force
~~~

#### 16. Créer une nouvelle classe notification

Cette commande crée une nouvelle classe notification dans le répertoire '**modules/ACME/TestModule/src/Notifications**'.

~~~php
php artisan module:make-notification TestNotification ACME/TestModule
~~~

##### Créer une nouvelle classe notification avec la command force

Si la classe notification existe déjà, vous pouvez utiliser la commande force pour l'écraser.

~~~php
php artisan module:make-notification TestNotification ACME/TestModule --force
~~~

#### 17. Créer une nouvelle classe mail

Cette commande crée une nouvelle classe mail dans le répertoire '**modules/ACME/TestModule/src/Mail**'.

~~~php
php artisan module:make-mail TestMail ACME/TestModule
~~~

##### Créer une nouvelle classe mail avec la command force

Si la classe mail existe déjà, vous pouvez utiliser la commande force pour l'écraser.

~~~php
php artisan module:make-mail TestMail ACME/TestModule --force
~~~

#### 18. Créer une nouvelle classe commande

Cette commande crée une nouvelle classe commande dans le répertoire '**modules/ACME/TestModule/src/Console/Commands**'.

~~~php
php artisan module:make-command TestCommand ACME/TestModule
~~~

##### Créer une nouvelle classe commande avec la command force

Si la classe commande existe déjà, vous pouvez utiliser la commande force pour l'écraser.

~~~php
php artisan module:make-command TestCommand ACME/TestModule --force
~~~

#### 19. Créer une nouvelle classe service provider

Cette commande crée une nouvelle classe service provider dans le répertoire '**modules/ACME/TestModule/src/Providers**'.

~~~php
php artisan module:make-module-provider TestServiceProvider ACME/TestModule
~~~

##### Créer une nouvelle classe service provider avec la command force

Si la classe service provider existe déjà, vous pouvez utiliser la commande force pour l'écraser.

~~~php
php artisan module:make-module-provider TestServiceProvider ACME/TestModule --force
~~~
