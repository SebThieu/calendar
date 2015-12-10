<?php

require_once("Connexionbdd.php");

foreach ($db->query("SELECT * FROM events ORDER BY date") as $event) {
    foreach ($db->query("SELECT * FROM categories WHERE id = $event[cat_id]") as $category) {
        $date = date("d M Y", strtotime($event["date"]));
        echo '<a href="page_event.php?event=' . $event["title"] . '"><div id="eventContainer' . $event["id"] . '" class="eventContainer">';
            echo '<div id="eventPicture' . $event["id"] . '" class="eventPicture" style="background-image:url(' . $event["picture"] . ')">';
                echo '<div id="eventOverlay' . $event["id"] . '" class="eventOverlay color_' . $event["cat_id"] . '">';
                    echo '<div id="eventDate' . $event["id"] . '" class="eventDate"><h2 class="eventDateStyle">' . $date . '</h2></div>';
                    echo '<div id="eventTextContainer' . $event["id"] . '" class="eventTextContainer">';
                        // echo '<div id="eventLocation' . $event["id"] . '" class="eventLocation">' . $event["location"] . '</div>';
                        echo '<div id="eventTitle' . $event["id"] . '" class="eventTitle"><h1>' . $event["title"] . '</h1></div>';
                        echo '<div id="eventCategory' . $event["id"] . '" class="eventCategory"><p>' . $category["title"] . '</p></div>';
                        // echo '<div id="eventPrice' . $event["id"] . '" class="eventPrice">' . $event["price"] . '</div>';
                    echo '</div>';
                    echo '<div id="eventDescription' . $event["id"] . '" class="eventDescription"><p>' . $event["description"] . '</p></div>';
                echo '</div>';
            echo '</div>';
        echo '</div></a>';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Events</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

</body>
</html>