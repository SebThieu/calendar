<?php
require_once('connexionhdb.php');

//_DEBUG($DEBUG, E, $_SERVER['REMOTE_ADDR']);

$_SESSION['user']['ip'] = $_SERVER['REMOTE_ADDR'];

$err = "";
$nick = "";
$email = "";
$password = "";
$password_confirm = "";
$epicfail = "";

try { 

    if (isset($_POST["post"])) {
        // Si aucune des case n'est vide 
        if(!empty($_POST["nick"]) && !empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["password_confirm"])) {

            // Vérification des infos du pseudo============================================================
            // Si le pseudo correspond az AZ 09 entre 3 et 20 char
            $nick_base = htmlentities($_POST["nick"]);
            if (preg_match("#^[a-zA-Z][a-zA-Z0-9_-]{3,20}$#", $nick_base)) {
                $stmt = $h_db->query("SELECT ".DB_TABLE_MEMBERS."_nick FROM ".DB_TABLE_MEMBERS." WHERE ".DB_TABLE_MEMBERS."_nick LIKE '".$nick_base."'" );
                $result = $stmt->fetch();
                if (is_array($result)) {
                    $err .= 'le pseudo : '.$nick_base.' est déjà utilisé, veuillez en choisir un autre.<br />';
                } else {
                    $dbok_nick = $nick_base;
                }
            } else {
                $err .= "Le pseudo : " . $nick_base . " ne respecte pas les critères de validité.<br /";
            }//===========================================================================================

            // Verification des info de mail_base=========================================================
            // Si le mail passe la validation
            $email_base = htmlentities($_POST["email"]);
            if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email_base)) {
                // VALIDATE EMAIL ?????????????? if (filter_var($mail, FILTER_VALIDATE_EMAIL));
                // Si le résultat est un array c'est que le mail existe en bdd donc on refuse l'inscription
                $stmt = $h_db->query("SELECT ".DB_TABLE_MEMBERS."_email FROM ".DB_TABLE_MEMBERS." WHERE ".DB_TABLE_MEMBERS."_email LIKE '".$email_base."'");
                $result = $stmt->fetch();
                if (is_array($result)) {
                    $err .= 'l\'adresse mail : '.$email_base.' est déjà utilisé, veuillez en choisir une autre.<br /';
                } else {
                    $dbok_email = $email_base;
                }
            } else {
                $err .= "L'adresse " . $email_base . " ne respecte pas les critères de validité.<br /";
            }//===============================================================================================

            // Verification des infos du password=============================================================
            // Si les mot de passe sont différents = erreur
            // Si identiques hachage
            $password_base = htmlentities($_POST["password"]);
            $password_confirm = htmlentities($_POST["password_confirm"]);
            if ($password_base != $password_confirm) {
                $err .= 'Les mots de passe ne correspondent pas, veuillez les ressaisir.<br />';
            } else {
                if (strlen($password_base) < 6) {
                    $err .= 'Le mot de passe est trop court';
                } else {
                    // $dbok_password = password_hash($password_base, PASSWORD_DEFAULT); // Impossible de comparer les hash
               $dbok_password = md5($password_base); 
                }
            }//===============================================================================================
            
            // Création du Token
            $dbok_token = 'monsupertoken';
            
            
        } else {
            $err .= 'Veuillez remplir tous les champs.<br />'; // SUPERFLU !!!!!
        }

        // Enregistrement des infos vérifié en bdd
        if (!empty($dbok_nick) && !empty($dbok_email) && !empty($dbok_password)) {
            $stmt = $h_db->prepare("INSERT INTO ".DB_TABLE_MEMBERS."(".DB_TABLE_MEMBERS."_nick, ".DB_TABLE_MEMBERS."_email, ".DB_TABLE_MEMBERS."_password, ".DB_TABLE_MEMBERS."_registration_date, ".DB_TABLE_MEMBERS."_token, ".DB_TABLE_MEMBERS."_ip) VALUES(?, ?, ?, ?, ?, ?)");
            $stmt->execute(array($dbok_nick, $dbok_email, $dbok_password, date('Y-n-j'),  $dbok_token, $_SESSION['user']['ip']));
            session_start();
            $_SESSION['user']['nick'] = $dbok_nick;
            $_SESSION['user']['ip'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['user']['token'] = $dbok_token;
            header('Location: registerok.php');
        }else{
            if ($err === '') {
                $err .= 'Impossible de créer le compte pour une raison inconnue.<br />';
                // envoyer également les infos relative à l'utilisateur (ip, etc...) A FAIRE !!!!!!!!!!!!!!!!!!!!!
                $epicfail = '<a href="../pages/contact_admin.php"><button type="button">Contacter un administrateur</button></a>';
            }
        }
    }

} catch(PDOException $ex) {
    _DEBUG($DEBUG, E, $ex, ERR); // ====================================== DEBUG
}


// if (!isset($_SESSION["user"])){echo "bonjour !";}else{echo "bonjour ". $_SESSION["user"]['pseudo']. ' !';} 
echo '<div>';
echo '<form method="post">';
echo '<div>Notez que vous devez entrer une adresse e-mail valide pour activer votre compte.<br />Vous recevrez un e-mail à l’adresse indiquée contenant le lien d’activation de votre compte.</div>';
echo '<div id="nick">';
echo '<div>* Votre pseudo : <input type="text" name="nick" value="" required></div>';
echo '<div>Votre pseudo doit contenir de 3 à 20 caractères et uniquement des caractères alpha-numériques.</div>';
echo '</div>';  
echo '<div id="email">';
echo '<div>* Votre courriel : <input type="text" name="email" required></div>';
echo '</div>';
echo '<div id="password">';
echo '<div>* Votre mot de passe : <input type="password" name="password" placeholder="6 caractères minimum" required></div>';
echo '</div>';
echo '<div id="password_confirm">';
echo '<div>* Confirmation de votre mot de passe : <input type="password" name="password_confirm" placeholder="6 caractères minimum" required></div>';
echo '</div>';
echo '<div><input type="submit" name="post" value="Valider"></div>'; 
echo '<div><a href="../index_user.php"><button type="button">Revenir à l\'accueil</button></a></div>';
echo '<div>'.$err.'</div>';
echo '<div>'.$epicfail.'</div>';
?>