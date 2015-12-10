<?php

session_start();

require_once('connexionhdb.php');

$nick = "";
$password = "";
$err = "";
$validation = "";

try { 
    // Si click sur "Me connecter"
    if (isset($_POST["loginbutton"])) {

        // Si les champs loginname et loginpwd ne sont pas vide
        if(!empty($_POST["loginname"]) && !empty($_POST["loginpwd"])){

            // On renseigne les variable $pseudo et $password avec l'échappement des caractères spéciaux
            $nick = htmlentities($_POST["loginname"]); 
            $password = htmlentities($_POST["loginpwd"]);

            // Facultatif : Si ni $psedo ni $password ne sont vide
            if (!empty($nick) && !empty($password)) {

                // query de savoir s'il existe bien dans la bdd un password, un nom et un id correspondant au pseudo entré
                //                $stmt = $h_db->query("SELECT ".DB_TABLE_MEMBERS."_password, ".DB_TABLE_MEMBERS."_nick, ".DB_TABLE_MEMBERS."_id FROM ".DB_TABLE_MEMBERS." WHERE ".DB_TABLE_MEMBERS."_nick LIKE '".$pseudo."'" );
                $stmt = $h_db->query("SELECT * FROM ".DB_TABLE_MEMBERS." WHERE ".DB_TABLE_MEMBERS."_nick LIKE '".$nick."'" );
                $result = $stmt->fetch();
                if ($result[DB_TABLE_MEMBERS.'_active'] === 0 ){
                    $validation .= 'Ce compte n\'est pas activé, consulter votre client mail pour valider votre inscription.<br />'; 
                    $validation .= '<div><a href="pages/revalidation.php"><button type="button">Me renvoyer le mail de validation</button></a></div>';
                } else {
                    // _DEBUG($DEBUG, P, $result); // ====================================== DEBUG
                    //_DEBUG($DEBUG, E, "DEBUG SQL pwd : " . $result[DB_TABLE_MEMBERS.'_password'] ); // ====================================== DEBUG
                    // Si c'est la cas, alors on vérifie que le hash du mot de passe entré correspond bien au hash en bdd
                    // if (password_hash($password, PASSWORD_DEFAULT) === $result[DB_TABLE_MEMBERS.'_password']) { // impossible de verifier les hash
                    if (md5($password) === $result[DB_TABLE_MEMBERS.'_password']) {

                        // On inscrit les infos nécessaire dans le $_SESSION["user"]
                        // Toutes ses infos serviront notemment à pré-remplir les champs en cas d'édition du profil  
                        $_SESSION["user"]['id'] = $result[DB_TABLE_MEMBERS.'_id'];
                        $_SESSION["user"]['nick'] = $result[DB_TABLE_MEMBERS.'_nick'];
                        /*$_SESSION["user"]['nick'] = $result[DB_TABLE_MEMBERS.'_nick'];
                    $_SESSION["user"]['nick'] = $result[DB_TABLE_MEMBERS.'_nick'];
                    $_SESSION["user"]['nick'] = $result[DB_TABLE_MEMBERS.'_nick'];
                    $_SESSION["user"]['nick'] = $result[DB_TABLE_MEMBERS.'_nick'];
                    $_SESSION["user"]['nick'] = $result[DB_TABLE_MEMBERS.'_nick'];
                    $_SESSION["user"]['nick'] = $result[DB_TABLE_MEMBERS.'_nick'];
                    $_SESSION["user"]['nick'] = $result[DB_TABLE_MEMBERS.'_nick'];
                    $_SESSION["user"]['nick'] = $result[DB_TABLE_MEMBERS.'_nick'];*/

                        // Si le mot de passe n'est pas valide
                    } else {
                        $err = "Connexion impossible !";
                    }
                }
            }else{
                $err = "Veuillez remplir tous les champs !";
            }
        }
    }
    //if (isset($_POST["registerbutton"])) { // PAS GOOD

    //}
} catch(PDOException $ex) {
    _DEBUG($DEBUG, E, $ex, ERR); // ====================================== DEBUG
}

// Si l'utilisateur est connecté alors on lui affiche ses infos de connexion
if (isset($_SESSION["user"]['nick'])) {

    echo '<div>' . (isset($_SESSION["user"]['nick']) ? 'Bonjour ' . $_SESSION["user"]['nick'].' !': '').'</div>';
    echo '<div><h1>AVATAR</h1></div>';
    echo '<div>'.$_SESSION["user"]['nick'].'</div>';
    echo '<div>Vous avez x amis connecté</div>';
    echo '<div><a href="pages/logout.php"><button type="button">Me déconnecter</button></a></div>';
    echo '<div><a href="pages/profil.php"><button type="button">Mon profil</button></a></div>';
 echo '<div><a href="pages/privcal.php"><button type="button">Mon agenda</button></a></div>';

    // sinon, on lui propose de se loguer
} else {

    echo '<form method="post">';
    echo '<div><input type="text" name="loginname" placeholder="Pseudo"></div>';
    echo '<div><input type="password" name="loginpwd" placeholder="Mot de passe"></div>';
    echo '<div><a href="./pages/oubli.php">J’ai oublié mon mot de passe</a></div>';
    echo '<div><a href="./pages/cgu.php"><button type="button">M\'enregistrer</button></a></div>';
    echo '<div><input type="submit" name="loginbutton" value="Me connecter"></div>';
    echo '<div><input type="checkbox" name="checkboxcookie">Me connecter automatiquement à chaque visite</div>';
    echo '<div>' . (!empty($err) ? $err : '') .'</div>';
    echo $validation;

}

?>