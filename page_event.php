<?php

require_once("Connexionhdb.php");

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Page event</title>
    </head>
    <body>

        <div class="wrapper">

            <?php // BLOC CATEGORIE (GAUCHE)

            foreach ($h_db->query("SELECT * FROM cal_event WHERE cal_event_title = '$_GET[event]'") as $event) {

                foreach ($h_db->query("SELECT * FROM cal_event_cat WHERE cal_event_cat_id = $event[cal_event_link_cal_event_cat_id]") as $category) {

                    echo '<div class="categoryContainer">';
                        echo '<div class="eventOverlay color_' . $event["cal_event_link_cal_event_cat_id"] . '">';
                            echo $category["cal_event_cat_title"];
                        echo '</div>';
                    echo '</div>';

                }

            }

            // FIN DU BLOC CATEGORIE (GAUCHE) ?>

            <?php // BLOC EVENT (CENTRE)

            foreach ($h_db->query("SELECT * FROM cal_event WHERE cal_event_title = '$_GET[event]'") as $event) {

                foreach ($h_db->query("SELECT * FROM cal_event_cat WHERE cal_event_cat_id = $event[cal_event_link_cal_event_cat_id]") as $category) {

                    $date = date("d F Y", strtotime($event["cal_event_datedeb"]));

                    echo '<div class="eventContainer">';
                        echo '<div class="eventHeaderContainer">';
                            echo '<div class="eventPicture"><img alt="' . $event["cal_event_title"] . '" src="' . $event["cal_event_img"] . '">';
                                echo '<div class="eventTitle"><h1>' . $event["cal_event_title"] . '</h1></div>';
                                echo '<div class="eventDate">' . $date . '</div>';
                                echo '<div class="eventLocation">' . $event["cal_event_link_cal_insee_zipcode"] . '</div>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="eventTextContainer">';
                            echo '<div class="eventPrice"><h2>' . $event["cal_event_price"] . ' €</h2></div>';
                            echo '<div class="eventDescription"><p>' . $event["cal_event_description"] . '</p></div>';
                            echo '<div class="eventLink"><a href="' . $event['cal_event_orglink'] . '">Réserver des places</a></div>';
                        echo '</div>';
                        echo '<div class="eventMap">' . $event["cal_event_map"] . '</div>';
                    echo '</div>';

                }

            }

            // FIN DU BLOC EVENT (CENTRE) ?>

            <?php // BLOC SUGGESTIONS (DROITE)
            
            echo '<div class="suggestContainer">';
                echo '<div id="eventOverlay' . $event["cal_event_id"] . '" class="eventOverlay color_' . $event["cal_event_link_cal_event_cat_id"] . '">';

                foreach ($h_db->query("SELECT * FROM cal_event WHERE cal_event_title = '$_GET[event]'") as $event) {

                    foreach ($h_db->query("SELECT * FROM cal_event WHERE cal_event_link_cal_event_cat_id = $event[cal_event_link_cal_event_cat_id] AND cal_event_id != $event[cal_event_id] ORDER BY cal_event_datedeb LIMIT 5") as $event) {

                        $date = date("d M Y", strtotime($event["cal_event_datedeb"]));

                        echo '<a href="page_event.php?event=' . $event["cal_event_title"] . '"><div id="eventContainer' . $event["cal_event_id"] . '" class="eventContainer">';
                            echo '<div id="eventDate' . $event["cal_event_id"] . '" class="eventDate"><h2 class="eventDateStyle">' . $date . '</h2></div>';
                            echo '<div id="eventTextContainer' . $event["cal_event_id"] . '" class="eventTextContainer">';
                                echo '<div id="eventLocation' . $event["cal_event_id"] . '" class="eventLocation">' . $event["cal_event_link_cal_insee_zipcode"] . '</div>';
                                echo '<div id="eventTitle' . $event["cal_event_id"] . '" class="eventTitle"><h1>' . $event["cal_event_title"] . '</h1></div>';
                            echo '</div>';
                        echo '</div></a>';

                    }

                }

                echo '</div>';
            echo '</div>';

            // FIN DU BLOC SUGGESTIONS (DROITE) ?>

        </div>

    </body>
</html>