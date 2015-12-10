<!DOCTYPE html>
<html>
<head>
	<title>STYLE EVENT</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="css/style_event_ref.css">
	<link rel="stylesheet" type="text/css" href="css/style_menu.css">

	<script type="text/javascript" src="vendor/components/jquery/jquery.min.js"></script>
	<!--<script type="text/javascript" src="js/event_effects.js"></script>-->


	<!-- <link href='https://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'> -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300italic,300,700,400italic,700italic' rel='stylesheet' type='text/css'>

	
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
		</div>




	<!-- EVENT 1 -->

		<div id="eventContainer" class="eventContainer">
			<div id ="eventBg" class="eventBg">
				<div id="eventOverlay">

					<div id="eventDate" class="dateEvent">
						<h2 class="eventDateStyle">
						20<br/>
						DECEMBRE<br/>
						2015</h2>			
					</div>
		
					<div id="eventText" class="resumeEvent">

						<div id="ville">
						</div>

						<div id="eventTitle" class="titleEvent">
							<h1>TITRE EVENEMENT</h1>
						</div>

						<div id="eventCat" class="catEvent">
						<p>Description de l'évènement</p>
						</div> 

					</div>

					<div id="eventDescribe" class="describeEvent">
					Sed interdum nisi at porttitor commodo. Curabitur nec bibendum massa. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam suscipit laoreet diam vitae convallis. Sed congue diam eget rhoncus sagittis. Sed id mi dui. Pellentesque et semper mi. Vestibulum pellentesque nisl vehicula orci cursus, vitae ultricies enim placerat. Aliquam eu ornare tellus. Integer porttitor leo quis orci commodo aliquet.
					</div> 

				</div>
			</div>	
		</div>	


		
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



</body>
</html>