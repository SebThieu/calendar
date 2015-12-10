<?php
//===== _DEBUG =====
// Fonction permettant de rapidement afficher une fenêtre de DEBUG
// Il est nécessaire d'initialiser la variable $DEBUG = 1 en début de page pour activer la fonction
// ensuite de faire chaque debug comme suit :
// _DEBUG($DEBUG, )
define('B','both');
define('C','con');
define('E','ech');
define('P','printr');
define('V','vardump');
function _DEBUG($b_valAll = 0, $s_msgtype = 'both|con|ech|printr|vardump', $s_msg='', $s_default='') {
    if ($b_valAll === 1 && $s_msgtype != '') { 
        if ($s_msgtype === 'both') {
            echo '<br />===DEBUG===<br />' .$s_msg . '<br />===DEBUG===<br />';
            console.log($s_msg) . '<br />';
        } else if ($s_msgtype === 'ech') {
            echo '<br />===DEBUG===<br />' . $s_msg . '<br />===DEBUG===<br />';
        } else if ($s_msgtype === 'con') {
            '<br />===DEBUG===<br />' . console.log($s_msg) . '<br />===DEBUG===<br />';
        } else if ($s_msgtype === 'printr') {
            '<br />===DEBUG===<br />' . print_r($s_msg) . '<br />===DEBUG===<br />';
        } else if ($s_msgtype === 'vardump') {
            '<br />===DEBUG===<br />' . var_dump($s_msg) . '<br />===DEBUG===<br />';
        }
    } else if ($b_valAll === 0 && $s_msgtype != '') {
echo $s_default;
    }
}






















    ?>