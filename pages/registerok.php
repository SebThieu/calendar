<?php
session_start();

 if (isset($_POST["quit"])) {
 unset($_SESSION['user']);
     header('Location: ../index_user.php');
 }

echo 'Votre compte a été crée.<br />';
echo '<br />';
echo 'Vous recevrez prochainement un courriel vous permettant de valider votre inscription.<br />';
echo '<div><a href="validation.php?nick='. $_SESSION['user']['nick'].'&token=monsupertoken"><button type="button">/!\BETA/!\ Valider mon inscription</button></a></div>';
//echo '<div><a href="../index_user.php"><button type="button">/!\BETA/!\ Revenir à l\'accueil sans valider mon inscription</button></a></div>';
echo '<form method="post">';
echo '<div><input type="submit" name="quit" value="/!\BETA/!\ Revenir à l\'accueil sans valider mon inscription"></div>';
echo '</form>';
?>