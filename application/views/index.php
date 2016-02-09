<!DOCTYPE html>
<html>
  <head>
	<title>Touristix | Lyon ne sera plus un secret pour vous !</title>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/include_css.php'); ?>
	<script type="text/javascript" src="/assets/js/modernizr.custom.js"></script>
	<style>
	  html, body {
		height: 100%;
		margin: 0;
		padding: 0;
	  }
	  #map {
		height: 100%;
	  }
	</style>
  </head>
  <body>
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/menu-haut.php'); ?>
	<div id="map"></div>
	<!--<script src="/assets/js/map.js"></script>-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABmaswDuz7-HVvHoHgrqYdmunESX84x9s&signed_in=true&callback=initMap" async defer></script>
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/google-map-script.php'); ?>
	<script type="text/javascript" src="/assets/js/jquery-1-11-2.js"></script>
	<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/assets/js/menu-haut.js"></script>
	<script src="/assets/js/map-style.js"></script>
  </body>
</html>
