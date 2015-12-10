<!DOCTYPE html>
<html>
<head>
	<title>STYLE EVENT</title>
	<meta charset="utf-8"/>
	<link href='https://fonts.googleapis.com/css?family=Khand:400,700,300,500,600' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="css/style_event.css">
	<link rel="stylesheet" type="text/css" href="css/style_menu.css">
	<link rel="stylesheet" type="text/css" href="css/style_categories.css">

	<script type="text/javascript" src="vendor/components/jquery/jquery.min.js"></script>
	<!--<script type="text/javascript" src="js/event_effects.js"></script>-->


	<!-- <link href='https://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'> -->
	<!-- <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,700,400italic,700italic' rel='stylesheet' type='text/css'> -->


	
</head>
<body>
	<div id="wrapper">

<!-- MENU -->

		<div id="menu">

			<ul>
				<li href="#ACCUEIL">ACCUEIL</li>
				<li href="#INSCRIPTION">INSCRIPTION</li>
				<li href="#PROFIL">PROFIL</li>
				<li href="#ABOUT">ABOUT</li>
				<li href="#FAQ">FAQ</li>
			</ul>

		</div>

		<div id="frise_temps">
			<ul>
				<li href="#janvier" id="jan">JAN</li>
				<li href="#fevrier" id="fev">FEV</li>
				<li href="#mars" id="mar">MAR</li>
				<li href="#avril" id="avr">AVR</li>
				<li href="#mai" id="mai">MAI</li>
				<li href="#juin" id="juin">JUIN</li>
				<li href="#juillet" id="jui">JUI</li>
				<li href="#aout" id="aou">AOU</li>
				<li href="#septembre" id="sep">SEP</li>
				<li href="#octobre" id="oct">OCT</li>
				<li href="#novembre" id="nov">NOV</li>
				<li href="#decembre" id="dec">DEC</li>

			</ul>
		</div>




	<!-- EVENT 1 -->

<?php

require_once("Connexionhdb.php");

   /*     foreach ($h_db->query("SELECT * FROM ".DB_TABLE_EVENT." ORDER BY ".DB_TABLE_EVENT."_datedeb") as $event) {
    echo DB_TABLE_EVENT."_datedeb"; 
	$date = date("d M Y", strtotime($event[DB_TABLE_EVENT."_datedeb"]));
	$mois = date("M", strtotime($event[DB_TABLE_EVENT."_datedeb"]));
	$tm["$mois"] += 1;
	if($tm["$mois"] == "1") {
		echo '<a href="page_event.php?event=' . $event[DB_TABLE_EVENT."_title"] . '"> <div id="eventContainer' . $event[DB_TABLE_EVENT."_id"] . '" class="eventContainer mois_' . $mois . '">';
	} else {
		echo '<a href="page_event.php?event=' . $event[DB_TABLE_EVENT."_title"] . '"> <div id="eventContainer' . $event[DB_TABLE_EVENT."_id"] . '" class="eventContainer">';
	}
	

		echo '<div id="eventPicture' . $event[DB_TABLE_EVENT."_id"] . '" class="eventPicture" style="background-image:url(' . $event[DB_TABLE_EVENT."_img"] . ')">';
			echo '<div id="eventOverlay' . $event[DB_TABLE_EVENT."_id"] . '" class="eventOverlay color_' . $event[DB_TABLE_EVENT."_link_".DB_TABLE_EVENT_CAT."_id"] . '">';
				echo '<div id="eventDate' . $event[DB_TABLE_EVENT."_id"] . '" class="eventDate"><h2 class="eventDateStyle">' . $date . '</h2></div>';
				echo '<div id="eventLocation' . $event[DB_TABLE_EVENT."_id"] . '" class="eventLocation">' . $event[DB_TABLE_EVENT."_link_".DB_TABLE_INSEE."_zipcode"] . '</div>';
				echo '<div id="eventTextContainer' . $event[DB_TABLE_EVENT."_id"] . '" class="eventTextContainer">';
					
					echo '<div id="eventTitle' . $event[DB_TABLE_EVENT."_id"] . '" class="eventTitle"><h1>' . $event[DB_TABLE_EVENT."_title"] . '</h1></div>';
    //SELECT * FROM cal_event WHERE `cal_event_link_cal_event_cat_id` = '4' 
					foreach ($h_db->query("SELECT * FROM ".DB_TABLE_EVENT_CAT." WHERE ".DB_TABLE_EVENT_CAT."_id = $event[cat_id]") as $category) {
						echo '<div id="eventCategory' . $event[DB_TABLE_EVENT."_id"] . '" class="eventCategory"><p>' . $category[DB_TABLE_EVENT_CAT."_title"] . '</p></div>';
					}
					// echo '<div id="eventPrice' . $event["id"] . '" class="eventPrice">' . $event["price"] . '</div>';
				echo '</div>';
				echo '<div id="eventDescription' . $event[DB_TABLE_EVENT."_id"] . '" class="eventDescription"><p>' . $event[DB_TABLE_EVENT."_description"] . '</p></div>';
			echo '</div>';
		echo '</div>';
	echo '</div></a>';
}*/
        
$tm = ["Jan" => 0, "Feb" => 0, "Apr" => 0, "May" => 0, "Jun" => 0, "Jul" => 0, "Aug" => 0, "Sep" => 0, "Oct" => 0, "Nov" => 0, "Dec" => 0];
        
foreach ($h_db->query("SELECT * FROM ".DB_TABLE_EVENT." ORDER BY ".DB_TABLE_EVENT."_datedeb") as $event) {
    
	$date = date("d M Y", strtotime($event["cal_event_datedeb"]));
	$mois = date("M", strtotime($event["cal_event_datedeb"]));
    
	$tm["$mois"] += 1;
    
	if ($tm["$mois"] == "1") {
        
		echo '<a href="page_event.php?event=' . $event["cal_event_title"] . '"><div id="eventContainer' . $event["cal_event_id"] . '" class="eventContainer mois_' . $mois . '">';
        
	} else {
        
		echo '<a href="page_event.php?event=' . $event["cal_event_title"] . '"><div id="eventContainer' . $event["cal_event_id"] . '" class="eventContainer">';
        
	}
	
		echo '<div id="eventPicture' . $event["cal_event_id"] . '" class="eventPicture" style="background-image:url(' . $event["cal_event_img"] . ')">';
			echo '<div id="eventOverlay' . $event["cal_event_id"] . '" class="eventOverlay color_' . $event["cal_event_link_cal_event_cat_id"] . '">';
				echo '<div id="eventDate' . $event["cal_event_id"] . '" class="eventDate"><h2 class="eventDateStyle">' . $date . '</h2></div>';
				echo '<div id="eventLocation' . $event["cal_event_id"] . '" class="eventLocation">' . $event["cal_event_link_cal_insee_zipcode"] . '</div>';
				echo '<div id="eventTextContainer' . $event["cal_event_id"] . '" class="eventTextContainer">';
					echo '<div id="eventTitle' . $event["cal_event_id"] . '" class="eventTitle"><h1>' . $event["cal_event_title"] . '</h1></div>';
					foreach ($h_db->query("SELECT * FROM ".DB_TABLE_EVENT_CAT." WHERE ".DB_TABLE_EVENT_CAT."_id = $event[cal_event_id]") as $category) {
						echo '<div id="eventCategory' . $event["cal_event_id"] . '" class="eventCategory"><p>' . $category["cal_event_cat_title"] . '</p></div>';
					}
					// echo '<div id="eventPrice' . $event["id"] . '" class="eventPrice">' . $event["price"] . '</div>';
				echo '</div>';
				echo '<div id="eventDescription' . $event["cal_event_id"] . '" class="eventDescription"><p>' . $event["cal_event_description"] . '</p></div>';
			echo '</div>';
		echo '</div>';
	echo '</div></a>';
    
}

?>

		
	<footer>
		<h2>Tous droits résérvés 2015 ©</h2>
	</footer>

	</div>

<!-- ANIMATION TITRES -->

<!--
<script> 
$("#eventTitle").on("mouseover", function() {

	$(this).fadeOut(
	"slow", function () {
	duration : 200}).hide();
	$(".describeEvent").fadeIn(
	"slow", function () {
	duration : 200}).show();


}) 

$(".describeEvent").on("mouseout", function() {

	$(this).fadeOut(
	"slow", function () {
	duration : 200}).hide();
	$("#eventTitle").fadeIn(
	"slow", function () {
	duration : 200}).show();


}) 
</script> -->

<!-- ANIMATION DESCRIPTIONS -->
<script>

	/* JANVIER */

		$("#jan").click(function() {
    	$('html, body').animate({
        	scrollTop: $(".mois_Jan").offset().top }, 1000);
});

	/* FEVRIER */

		$("#fev").click(function() {
    	$('html, body').animate({
        	scrollTop: $(".mois_Feb").offset().top }, 1000);
});

	/* MARS */

		$("#mar").click(function() {
    	$('html, body').animate({
        	scrollTop: $(".mois_Mar").offset().top }, 1000);
});

	/* AVRIL */

		$("#avr").click(function() {
    	$('html, body').animate({
        	scrollTop: $(".mois_Apr").offset().top }, 1000);
});


	/* MAI */

		$("#mai").click(function() {
    	$('html, body').animate({
        	scrollTop: $(".mois_May").offset().top }, 1000);
});

	/* JUIN */

		$("#juin").click(function() {
    	$('html, body').animate({
        	scrollTop: $(".mois_Jun").offset().top }, 1000);
});

	/* JUILLET */

		$("#jui").click(function() {
    	$('html, body').animate({
        	scrollTop: $(".mois_Jul").offset().top }, 1000);
});

	/* AOUT */

		$("#aou").click(function() {
    	$('html, body').animate({
        	scrollTop: $(".mois_Aug").offset().top }, 1000);
});

	/* SEPTEMBRE */

		$("#sep").click(function() {
    	$('html, body').animate({
        	scrollTop: $(".mois_Sep").offset().top }, 1000);
});

	/* OCTOBRE */

		$("#oct").click(function() {
    	$('html, body').animate({
        	scrollTop: $(".mois_Oct").offset().top }, 1000);
});

	/* NOVEMBRE */

		$("#nov").click(function() {
    	$('html, body').animate({
        	scrollTop: $(".mois_Nov").offset().top }, 1000);
});

	/* DECEMBRE */

		$("#dec").click(function() {
    	$('html, body').animate({
        	scrollTop: $(".mois_Dec").offset().top }, 1000);
});

</script>


</body>
</html>