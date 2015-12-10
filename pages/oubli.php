<?php
session_start();

require_once('connexionhdb.php');

$mail = '';

try { 
    if (isset($_POST["submit"])) {
        //echo 'bouton de login appuyé';
        if(!empty($_POST["mail"])) {
           
            $mail = $_POST["mail"];
             $stmt = $h_db->query("SELECT * FROM ".DB_TABLE_MEMBERS." WHERE ".DB_TABLE_MEMBERS."_mail LIKE '". $mail. "'" );
                $result = $stmt->fetch();
                _DEBUG($DEBUG, P, $result); //=================================================================DEBUG
                echo "DEBUG SQL mail : " . $result[DB_TABLE_MEMBERS.'_mail'] . '<br />';
            if (!empty($result[DB_TABLE_MEMBERS.'_mail'])) {
               // $token = md5($result['mail'].$result['pseudo']); // -secure
               $token = utf8_encode(md5(uniqid(rand()), true)); // +secure
                    echo $token;
                
                mail($mail,'Changez votre mot de passe', 'http://localhost/KLS_forum/_seb/Validation.php?token='.$token); 
                $_POST[""];
            }
        }
    }

} catch(PDOException $ex) {
    echo $ex->getMessage();
}

echo '<form method="post">';
echo '<div>Entrez votre e-mail : <input type="text" name="mail" placeholder="Votre e-mail" required></div>';
echo '<div><input type="submit" name="submit" value="Envoyer"></div>';
echo '</form>';



?>