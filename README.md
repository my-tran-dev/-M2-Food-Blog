## Participants 
NGUYEN Huu Khang  
TRAN Thi Tra My  

## Compte User pour CRUD
identifiant : admin@blog.com
mdp : 123456

## Site déployé 
https://myfoodrecipeblog.herokuapp.com/

## Commentaires
Nous n'avons pas pu implémenter une illustration pour chaque article quand on charge le site déployé car heroku n'accepte pas les fichiers statiques. Il fallait implémenter le [service tier](https://devcenter.heroku.com/articles/s3) pour que l'on puisse charger les images en ligne. Sinon l'option charger une image est possible en local. Les bundles utilisés pour cet option sont [VichUploaderBundle](https://github.com/dustin10/VichUploaderBundle) et [LiipImagineBundle](https://github.com/liip/LiipImagineBundle).

Nous avons intégré l'api pour récupérer les [6 derniers blogs](https://myfoodrecipeblog.herokuapp.com/api/posts) ainsi qu'[un météo](https://myfoodrecipeblog.herokuapp.com/api/weather) qui utilise [l'api du site météo](https://openweathermap.org/api).

Concernant les blogs, nous avons un [page d'accueil](https://myfoodrecipeblog.herokuapp.com/) qui pourrait afficher tous les 6 articles. Les utilisateurs anonymes peuvent voir la contenue d'[un article](https://myfoodrecipeblog.herokuapp.com/post/boeuf-luc-lac) en cliquant dessus. Le titre de chaque article doit être unique et supérieur à 5 charactères car il serait généré comme un slug pour accéder à l'article. Pour créer, éditer ou supprimer un blog, l'utilisateur doit être connecté. Nous n'avons pas ajouté l'auteur par l'article car il s'agit un blog personnel. Les utilisateurs connectés peuvent créer/éditer/supprimer les articles du site.

## Installer Symfony
https://symfony.com/download

## Installer Composer 
https://getcomposer.org/download/ 
ou
https://getcomposer.org/Composer-Setup.exe


## Configuration de bdd
.env
APP_ENV=dev
DATABASE_URL=mysql://db_user:db_password@host:port/db_name?serverVersion=*.*

## Initialiser projet 
```GIT
git clone 
```

```PHP
composer update
or
composer install 
```

## Générer un controller
```PHP
php bin/console make:controller controllerName
or
symfony console make:controller controllerName
```

## Créer une version de migration
```PHP
php bin/console doctrine:migrations:generate
or
symfony console doctrine:migrations:generate
```

## Créer ou mettre à jour la version de migration
```PHP
php bin/console doctrine:migrations:diff
or
symfony console doctrine:migrations:diff
```

## Supprimer une version de migration
```PHP
php bin/console doctrine:migrations:version --delete $version

exemple : php bin/console doctrine:migrations:version --delete DoctrineMigrations\Version20201229214259  
```


## Appliquer le migration
```PHP
php bin/console doctrine:migrations:migrate
or
symfony console doctrine:migrations:migrate
```

## Démarrer le server
```PHP
symfony serve
or
php bin/console server:start
```
Server démarrer sur 127.0.0.1:8000

## Installer Heroku pour déployer
https://devcenter.heroku.com/articles/heroku-cli

## Tutoriel pour déployer une application symfony vers Heroku
https://devcenter.heroku.com/articles/deploying-symfony4

## Init projet à déployer Déployer projet
```GIT
composer req apache-pack avec option recipe = yes

git init
git add .
git commit -m "init projet"

heroku create
echo 'web: heroku-php-apache2 public/' > Procfile
git add Procfile
git commit -m "Heroku Procfile"
heroku config:set APP_ENV=prod
heroku config:set APP_SECRET=$(php -r 'echo bin2hex(random_bytes(16));')
heroku git:remote -a nom-projet
git push heroku master or git push heroku main
```
##

## Liens vers site déployé
heroku open
https://myfoodrecipeblog.herokuapp.com/
:warning: Site en cours de dévéloppement.

## Base de données utilisé 
Postgresql de Heroku