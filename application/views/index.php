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

	<?php if($this->session->userdata('connexion')['pseudo'] != false)
	{
	?>
	<div id="constructionParcours">
		<p onclick="cacherConstructionParcours()">Parcours actuel <span class="badge">0</span><span class="fleche"><i class="fa fa-angle-up"></i></span></p>
		<ul id="listeConstructionParcours">
			<li>Point 1</li>
			<li>Point 2</li>
			<li>Point 3</li>
		</ul>
	</div>
	<?php
	}
	?>

	<div id="map"></div>
	<script src="/assets/js/map.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABmaswDuz7-HVvHoHgrqYdmunESX84x9s&signed_in=true&callback=initMap" async defer></script>
	<script type="text/javascript" src="/assets/js/jquery-1-11-2.js"></script>
	<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/assets/js/menu-haut.js"></script>
	<script type="text/javascript" src="/assets/js/api.js"></script>
	<script type="text/javascript" src="/assets/js/map-style.js"></script>
  </body>
</html>
