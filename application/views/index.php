<!DOCTYPE html>
<html>
  <head>
	<title>Geolocation</title>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/include_css.php'); ?>
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
	<div id="map"></div>
	<script src="/assets/js/map.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABmaswDuz7-HVvHoHgrqYdmunESX84x9s&signed_in=true&callback=initMap" async defer></script>
  </body>
</html>