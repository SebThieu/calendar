<?php 
session_start();

unset($_SESSION["user"]);
require_once('connexionhdb.php');

echo 'Vous êtes maintenant déconnecté.';
echo '<div><a href="../index_user.php"><button type="button">Retour à l\'accueil</button></a></div>';
?>