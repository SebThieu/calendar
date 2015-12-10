<?php
// Bonnes pratique : http://sql.sh/1396-nom-table-colonne
// Template générique de création d'une BDD
// Les valeurs de personnalisation de la BDD se trouvent dans le fichier constants.php
require("constant.php"); 
require("fonction.php"); 

// Le choix des différentes tables à activer : 1=activé autrechose=désactivé

try {
    // connexion à Mysql sans base de données
    $pdo = new PDO('mysql:host='.DB_HOST, DB_USER, DB_PASSWORD);

    // création de la requête sql
    // on teste avant si elle existe ou non (par sécurité)
    $requete = "CREATE DATABASE IF NOT EXISTS `".DB_NAME."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";

    // on prépare et on exécute la requête
    $pdo->prepare($requete)->execute();

    // connexion à la bdd
    $h_db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASSWORD);
    $h_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // mode de gestion d'erreur
    $h_db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // http://php.net/manual/fr/pdo.setattribute.php

    // on vérifie que la connexion est bonne
    if($h_db) {

        //========= DB_TABLE_MEMBERS =========
        // on créer la requête de création de la table des membres
        // Pour info : 
        // _actif = 0 (default), 1 quand compte activé
        // _avatar = ./img/avatars/default.jpg (default), puis le chemin de l'avatar personnalisé
        // _group = 0 (default) voir table membre_group
        $requete = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`".DB_TABLE_MEMBERS."` (
				`".DB_TABLE_MEMBERS."_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`".DB_TABLE_MEMBERS."_nick` VARCHAR( 20 ) NOT NULL,
				`".DB_TABLE_MEMBERS."_email` VARCHAR( 255 ) NOT NULL ,
				`".DB_TABLE_MEMBERS."_password` VARCHAR( 60 ) NOT NULL ,
				`".DB_TABLE_MEMBERS."_lastname` VARCHAR( 60 ) ,
				`".DB_TABLE_MEMBERS."_firstname` VARCHAR( 60 ) ,
				`".DB_TABLE_MEMBERS."_address` VARCHAR( 150 ) NOT NULL ,
				`".DB_TABLE_MEMBERS."_zipcode` INT( 5 ) NOT NULL ,
				`".DB_TABLE_MEMBERS."_city` VARCHAR( 40 ) NOT NULL ,
				`".DB_TABLE_MEMBERS."_avatar` VARCHAR( 60 ) DEFAULT '../img/avatars/default.jpg' NOT NULL ,
				`".DB_TABLE_MEMBERS."_active` INT( 1 ) DEFAULT '0' NOT NULL ,
				`".DB_TABLE_MEMBERS."_registration_date` DATE NOT NULL ,
				`".DB_TABLE_MEMBERS."_token` VARCHAR( 60 ) ,
				`".DB_TABLE_MEMBERS."_group` INT( 1 ) DEFAULT '0' NOT NULL ,
				`".DB_TABLE_MEMBERS."_ip` VARCHAR( 15 ) NOT NULL ,
				`".DB_TABLE_MEMBERS."_gps` VARCHAR( 50 ) NOT NULL
				) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";

        // on prépare et on exécute la requête
        $h_db->prepare($requete)->execute();

        //========= DB_TABLE_MEMBERS_GROUP =========
        // 0=utilisateur non activé (default) 1=utilisateur 2=membre émérite 
        // 7= modérateur 8=admin(bas pouvoir) 9=administrateur(full pouvoir)
        // Couleur à définir pour l'affichage et la distinction des memebres connectés
        $requete = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`".DB_TABLE_MEMBERS_GROUP."` (
				`".DB_TABLE_MEMBERS_GROUP."_id` INT( 11 ) NOT NULL PRIMARY KEY ,
				`".DB_TABLE_MEMBERS_GROUP."_group` VARCHAR( 20 ) NOT NULL ,
                `".DB_TABLE_MEMBERS_GROUP."_color` VARCHAR( 7 ) 
                ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
        $h_db->prepare($requete)->execute();
        // Insertion des données d'appartenance à un group défini
        $stmt = $h_db->prepare("INSERT IGNORE INTO " . DB_TABLE_MEMBERS_GROUP. "(".DB_TABLE_MEMBERS_GROUP."_id, ".DB_TABLE_MEMBERS_GROUP."_group) VALUES (?, ?)");
        $stmt->execute(array('0', 'off')); // noir
        $stmt->execute(array('1', 'utilisateur')); // bleu clair
        $stmt->execute(array('2', 'premium')); // bleu clair bold
        $stmt->execute(array('6', 'organisateur')); // bleu clair bold
        $stmt->execute(array('8', 'administrateur')); // orange bold
        $stmt->execute(array('9', 'SuperAdmin')); // rouge bold

        //========= DB_TABLE_MEMBERS_EVENT =========
        $requete = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`".DB_TABLE_MEMBERS_EVENT."` (
				`".DB_TABLE_MEMBERS_EVENT."_id` INT( 11 ) NOT NULL PRIMARY KEY ,
				`".DB_TABLE_MEMBERS_EVENT.'_link_'.DB_TABLE_MEMBERS."_id` INT( 11 ) NOT NULL ,
				`".DB_TABLE_MEMBERS_EVENT.'_link_'.DB_TABLE_EVENT."_id` INT( 11 ) NOT NULL ,
				`".DB_TABLE_MEMBERS_EVENT."_title` VARCHAR( 100 ) NOT NULL ,
                `".DB_TABLE_MEMBERS_EVENT."_description` VARCHAR( 500 ) NOT NULL ,
                `".DB_TABLE_MEMBERS_EVENT."_deb` DATETIME ,
                `".DB_TABLE_MEMBERS_EVENT."_fin` DATETIME ,
                `".DB_TABLE_MEMBERS_EVENT."_gps` VARCHAR( 50 )
                ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
        $h_db->prepare($requete)->execute();

        //========= DB_TABLE_INSEE ========
        //https://www.data.gouv.fr/s/resources/base-officielle-des-codes-postaux/20151009-153255/base_officielle_codes_postaux_-_09102015.csv
        $requete = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`".DB_TABLE_INSEE."` (
                `".DB_TABLE_INSEE."_insee` INT( 5 ) NOT NULL PRIMARY KEY ,
                `".DB_TABLE_INSEE."_city` VARCHAR( 40 ) NOT NULL ,
				`".DB_TABLE_INSEE."_zipcode` INT( 5 ) NOT NULL 
                ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
        $h_db->prepare($requete)->execute();


        //========= DB_TABLE_EVENT_CAT ========
        $requete = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`".DB_TABLE_EVENT_CAT."` (
                `".DB_TABLE_EVENT_CAT."_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`".DB_TABLE_EVENT_CAT."_title` VARCHAR( 100 ) NOT NULL ,
                `".DB_TABLE_EVENT_CAT."_description` VARCHAR( 500 ) NOT NULL ,
                `".DB_TABLE_EVENT_CAT."_defcolor` VARCHAR( 7 ) NOT NULL ,
                `".DB_TABLE_EVENT_CAT."_defimg` VARCHAR( 30 ) ,
                `".DB_TABLE_EVENT_CAT."_ordre` INT( 2 ) 
                ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
        $h_db->prepare($requete)->execute();
        // Catégories d'évenements

        // On vérifie si les données ont déjà été inscrite
        $stmt = $h_db->query("SELECT * FROM ".DB_TABLE_EVENT_CAT);
            $result = $stmt->fetch();
           // if (!is_array($result)) {

                $stmt = $h_db->prepare("INSERT IGNORE INTO " . DB_TABLE_EVENT_CAT. "(".DB_TABLE_EVENT_CAT."_id, ".DB_TABLE_EVENT_CAT."_title, ".DB_TABLE_EVENT_CAT."_description, ".DB_TABLE_EVENT_CAT."_defcolor, ".DB_TABLE_EVENT_CAT."_defimg) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute(array('4', 'Concert', 'Concerts blabla', 'RED', '')); 
                $stmt->execute(array('1', 'Salon', 'Salons bla bla', 'GREEN', '')); 
                $stmt->execute(array('2', 'Exposition', 'Expositions bla bla', 'BLUE', '')); 
                $stmt->execute(array('3', 'Evenement Public', 'Evenement Public bla bla', 'YELLOW', '')); 

          //  }

        //========= DB_TABLE_EVENT =========
        $requete = "CREATE TABLE IF NOT EXISTS `".DB_NAME."`.`".DB_TABLE_EVENT."` (
				`".DB_TABLE_EVENT."_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
				`".DB_TABLE_EVENT.'_link_'.DB_TABLE_EVENT_CAT."_id` INT( 11 ) NOT NULL ,
				`".DB_TABLE_EVENT."_title` VARCHAR( 100 ) NOT NULL ,
                `".DB_TABLE_EVENT."_description` VARCHAR( 150 ) NOT NULL ,
               `".DB_TABLE_EVENT."_datedeb` DATETIME ,
               `".DB_TABLE_EVENT."_datefin` DATETIME ,
               `".DB_TABLE_EVENT.'_link_'.DB_TABLE_INSEE."_zipcode` INT( 5 ) ,
               `".DB_TABLE_EVENT."_coord_` VARCHAR( 20 ) ,
               `".DB_TABLE_EVENT."_img` VARCHAR( 50 ) NOT NULL , 
               `".DB_TABLE_EVENT."_gps` VARCHAR( 50 ) NOT NULL 
                ) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
        $h_db->prepare($requete)->execute();
    }
} catch(PDOException $ex) {
    _DEBUG($DEBUG, E, $ex, ERR_DB_CO);
}


//`FOREIGN KEY (".DB_TABLE_EVENT.'_link_'.DB_TABLE_EVENT_CAT."_id) REFERENCES ".DB_TABLE_EVENT."(".DB_TABLE_EVENT."_id)
?>