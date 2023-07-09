# Titre
Concessionnaire automobile

## Description
Un concessionnaire automobile a récemment créé son entreprise, mais pour accroître sa visibilité, il vous a demandé de créer une application pour afficher les voitures qu'il vend. La version de PHP doit être 7 ou 8, Symfony
version 5 ou 6.

Il souhaite que l'application soit aussi simple que possible afin d'en réduire le coût. Il veut une page où il peut rechercher les voitures par nom dans un champ de saisie, et avoir la possibilité de filtrer les voitures par catégorie.S'il y a plus de 20 voitures dans la base de données, il veut pouvoir utiliser un système de pagination.
pouvoir utiliser une pagination afin d'éviter d'avoir tous les résultats sur une seule page. (en utilisant https://github.com/KnpLabs/KnpPaginatorBundle).

Les images des voitures ne sont pas nécessaires. L'utilisation de Bootstrap pour l'interface est obligatoire.

Une page d'administration est également nécessaire pour mettre à jour, créer, lire et supprimer des voitures. L'inscription n'est pas nécessaire ici.

L'une des exigences est que l'application doit être remplie de données à l'aide de fixtures (fausses données pour alimenter la base de données https://symfonycasts.com/screencast/symfony-doctrine/fixtures et
https://fakerphp.github.io/ )

Notre client souhaite que la météo soit affichée sur la page principale, en utilisant une API publique qu'il a trouvée sur le site d'un de ses concurrents: https://open-meteo.com/en/docs#api_form
Toutes les heures, la température doit changer sur la page.

## Informations complémentaires pour le projet
liste de command line pour le projet:
  - symfony server:start  => pour lancer le projet sur son port
  - php bin/console doctrine:fixtures:load => pour générer de fausses données dans la bdd
  - composer install dans tools/php-cs-fixer => sert à suivre les normes de Php (ici version 8)


