<?php
session_start();
_DEBUG($DEBUG,P,$_SESSION); // Affiche toutes les informations dans la session courante
$_SESSION["user"]['id'] = 1; // A CHANGER UNE FOIS LES AAJOUT FAIT !!!!!!!!!!!!!!!!!!
require_once('connexionhdb.php');

class Date {
    var $days       = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi','Dimanche');
    var $months     = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');

    function getEvents($year){
        global $h_db;
        global $DEBUG;
        $req = $h_db->query('SELECT '.DB_TABLE_MEMBERS_EVENT.'_id,'.DB_TABLE_MEMBERS_EVENT.'_title,'.DB_TABLE_MEMBERS_EVENT.'_description,'.DB_TABLE_MEMBERS_EVENT.'_deb FROM '.DB_TABLE_MEMBERS_EVENT.' WHERE '.DB_TABLE_MEMBERS_EVENT.'_link_'.DB_TABLE_MEMBERS.'_id = '.$_SESSION["user"]['id'].' && YEAR('.DB_TABLE_MEMBERS_EVENT.'_deb)='.$year);
        $r = array();
        /**
         * Ce que je veux $r[TIMESTAMP][id] = title
         */       
        while($d = $req->fetch(PDO::FETCH_ASSOC)){
            $r[strtotime($d[DB_TABLE_MEMBERS_EVENT.'_deb'])][$d[DB_TABLE_MEMBERS_EVENT.'_id']] = $d[DB_TABLE_MEMBERS_EVENT.'_title'].' : '.$d[DB_TABLE_MEMBERS_EVENT.'_description'];
            // $r[strtotime($d->date)][$d->id] = $d->title;
        }
        // print_r($r);

        _DEBUG(0, P, $r);


        return $r;

    }

    function getAll($year){
        $r = array();
        /**
         * Boucle version procédurale
         *
        $date = strtotime($year.'-01-01');
        while(date('Y',$date) <= $year){
            // Ce que je veux => $r[ANEEE][MOIS][JOUR] = JOUR DE LA SEMAINE
            $y = date('Y',$date);
            $m = date('n',$date);
            $d = date('j',$date);
            $w = str_replace('0','7',date('w',$date));
            $r[$y][$m][$d] = $w;
            $date = strtotime(date('Y-m-d',$date).' +1 DAY');
        }
        *
         *
         */
        // $month = date('n');
        // $day = date('j');
        $date = new DateTime($year.'-01-01');
        //$date = new DateTime($year.'-'.$month.'-01');
        while($date->format('Y') <= $year){
            // Ce que je veux => $r[ANEEE][MOIS][JOUR] = JOUR DE LA SEMAINE
            $y = $date->format('Y');
            $m = $date->format('n');
            $d = $date->format('j');
            $w = str_replace('0','7',$date->format('w'));
            $r[$y][$m][$d] = $w;
            $date->add(new DateInterval('P1D'));
        }
        _DEBUG(0, P, $r);
        return $r; 
    }

}
