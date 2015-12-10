<?php
session_start();
require_once('connexionhdb.php');

//validation.php?nick='. $_SESSION['user']['nick'].'&token=monsupertoken
$nick = $_GET["nick"];
$token = $_GET["token"];
$stmt = $h_db->query("SELECT * FROM ".DB_TABLE_MEMBERS." WHERE ".DB_TABLE_MEMBERS."_nick LIKE '".$_GET["nick"]."'" );
                $result = $stmt->fetch();
        if ($result[DB_TABLE_MEMBERS."_active"] === 0 && $result[DB_TABLE_MEMBERS."_token"] === $token){
        $stmt = $h_db->prepare("UPDATE " . DB_TABLE_MEMBERS. " SET ".DB_TABLE_MEMBERS."_active = 1, ".DB_TABLE_MEMBERS."_group = 1 WHERE ".DB_TABLE_MEMBERS."_nick LIKE '".$nick."'" );
        $stmt->execute();
        }
echo 'bonjour '.$_SESSION['user']['nick'].' !<br />';
echo 'Votre compte a bien été crée.<br />';
//Passage du compte en active=1 en bdd et group=1 (utilisateur)';
unset($_SESSION['user']);
echo '<div><a href="../index_user.php"><button type="button">Retour à l\'accueil</button></a></div>';
?>