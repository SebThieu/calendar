# calendar

Le but de calendar est de creer un réseau social de gestion d'agenda évenementiel.

pour tester :

index.php : pour lancer l'interface principale. 
Les 3 évenements sont cliquable et mènent sur la description de l'événement, seul la description du concert de muse propose des fonctionnalité avancées.

index_user.php : pour lancer la création des utilisateurs.
Phase de tests pour voir tout les scripts:
* index_user.php : Création d'un nouvel utilisateur en cliquant sur le bouton "m'enregistrer".
* cgu.php : accepter les CGU.
* register.php : créer le compte. et valider
* Dans phpmyadmin le compte est crée et les champs active et group de la table membre sont initialisés à 0
* registerok.php : cliquer sur revenir à l'accueil sans valider le compte
* index_user.php : créer un nouveau compte en cliquant sur le bouton "m'enregistrer".
* cgu.php : accepter les CGU.
* register.php : créer le compte. et valider
* Dans phpmyadmin le deuxième compte est crée et les champs active et group de la table membre sont initialisés à 0
* registerok.php : cliquer sur valider mon inscription
* Dans phpmyadmin le deuxième compte est crée et les champs active et group de la table membre sont initialisés à 1
* validation.php : Le compte a été activé, cliquez sur retour à l'accueil.
* index_user.php : tenter de se connecter avec le premier compte, une erreur apparait comme quoi le compte n'est pas activé, cliquez sur "me renvoyer le mail de validation".
* revalidation.php : BETA il faut indiquer le compte à valider. toute entrée erronée dira que le compte est déjà activé.
* après validation du bon nom d'utilisateur redirection vers index_user.php
* index_user.php : se connecter avec un des deux comptes précedement crée
* index_user.php : l'interface a changé, on voit les information de l'utilisateur et 3 boutons. cliquez sur le bouton profil permet à l'utilisateur d'acceder à la page de personnalisation de son profil
* profil.php : cliquez sur revenir à l'accueil
* index_user.php : cliquez sur "mon agenda" 
* privcal.php : agenda privé de l'utilisateur (la gestion des agenda par utilisateur n'est pas gerer pour l'instant). Il faut se rendre sur le mois de decembre pour consulter les 3 evenements des 24 et 25 decembre.




