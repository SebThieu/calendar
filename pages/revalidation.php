<?php
session_start();
require_once('connexionhdb.php');

$err = "";

if (isset($_POST["nickbutton"])) {
    if (!empty($_POST["nick"])){
 $stmt = $h_db->query("SELECT * FROM ".DB_TABLE_MEMBERS." WHERE ".DB_TABLE_MEMBERS."_nick LIKE '".$_POST["nick"]."'" );
                $result = $stmt->fetch();
        if ($result[DB_TABLE_MEMBERS."_active"] === 0){
            //$db->prepare("UPDATE ma_table SET champsA = :variableA, champsB = :variableB");
            $stmt = $h_db->prepare("UPDATE " . DB_TABLE_MEMBERS. " SET ".DB_TABLE_MEMBERS."_active = 1, ".DB_TABLE_MEMBERS."_group = 1 WHERE ".DB_TABLE_MEMBERS."_nick LIKE '".$_POST["nick"]."'" );
        $stmt->execute();
    header('Location: ../index_user.php');
        } else {
            $err .= 'Ce compte est déjà activé.<br />';
        }
    } else {
        $err .= 'Veuillez remplir le champ obligatoire du pseudo à valider sinon... ben ça marche pas !1!!';
    }
 }

echo 'bonjour !<br />';
echo 'Veuillez entrez votre mail pour recevoir le mail contenant le lien de validation de votre compte.<br />';
echo '<div id="email">';
echo '<div>* Votre courriel : <input type="text" name="email" placeholder="non fonctionnel" required></div>';
echo '</div>';
echo '<form method="post">';
echo '<div>* /!\BETA/!\ le pseudo à activer : <input type="text" name="nick" placeholder="le vrai compte à activer"></div>';
echo '<div><input type="submit" name="nickbutton" value="Activer"></div>';
echo '</form>';
echo '</div>';
echo $err;