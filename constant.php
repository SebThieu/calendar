<?php

// Activation des messages d'erreur
// NE SURTOUT METTRE EN PROD  EN DEBUG ACTIVE !!! 1 = actif, 0 = inactif
$DEBUG = 1;
global $DEBUG;
// Variables personnalisables :

// Variables générales :
$ip_host = 'localhost'; // ex : 'localhost'
$s_root = 'root'; // ex : 'root'
$s_root_password = ''; // ex : ''
$s_nom_du_projet = 'calendar'; // minuscule
$s_abbreviation_nom_du_projet = 'cal'; // minuscule

// Variables constantes BDD, NE PAS MODIFIER !!!
define('DB_USER', $s_root);
define('DB_PASSWORD', $s_root_password);
define('DB_NAME', $s_nom_du_projet);
define('DB_NAME_ABBREV', $s_abbreviation_nom_du_projet);
define('DB_HOST', $ip_host);
define('DB_TABLE_MEMBERS', DB_NAME_ABBREV.'_membres');
define('DB_TABLE_MEMBERS_GROUP', DB_TABLE_MEMBERS.'_group');
define('DB_TABLE_MEMBERS_EVENT', DB_TABLE_MEMBERS.'_event');
define('DB_TABLE_INSEE', DB_NAME_ABBREV.'_insee');
define('DB_TABLE_EVENT', DB_NAME_ABBREV.'_event');
define('DB_TABLE_EVENT_CAT', DB_TABLE_EVENT.'_cat');

// Constantes Gestion des erreurs
define('ERR_IS_CO','Vous ne pouvez pas accéder à cette page si vous n\'êtes pas connecté');
define('ERR_DB_CO','Erreur de connexion à la base de données');
define('ERR','Erreur...');

?>