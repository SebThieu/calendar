<?php

require_once("Connexionbdd.php");

?>

<!DOCTYPE html>
<html>
<head>
	<title>Page event</title>
</head>
<body>

<?php

foreach ($db->query("SELECT * FROM events WHERE title = '$_GET[event]'") as $event) {
	foreach ($db->query("SELECT * FROM categories WHERE id = $event[cat_id]") as $category) {
        $date = date("d F Y", strtotime($event["date"]));
        echo '<div id="eventContainer' . $event["id"] . '" class="eventContainer">';
        	echo '<div id="eventHeader' . $event["id"] . '" class="eventHeader"><h1>' . $event["title"] . '</h1></div>';
            echo '<div id="eventPicture' . $event["id"] . '" class="eventPicture"><img alt="' . $event["title"] . '" src="' . $event["picture"] . '"></div><br/>';
            echo '<div id="eventPrice' . $event["id"] . '" class="eventPrice"><h2>' . $event["price"] . '</h2></div>';
            echo '<div id="eventDescription' . $event["id"] . '" class="eventDescription"><p>' . $event["description"] . '</p></div><br/>';
            echo '<div id="eventMap' . $event["id"] . '" class="eventMap">' . $event["map"] . '</div>';
            echo '<div id="eventInfos' . $event["id"] . '" class="eventInfos">À <strong>' . $event["location"] . '</strong> le <strong>' . $date . '</strong>';
            	echo '<button type="button"><a href="' . $event["org_link"] . '">Réserver des places</a></button>';
            echo '</div>';
        echo '</div>';
    }
}

?>

</body>
</html>