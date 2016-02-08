<!DOCTYPE html>
<html>
  <head>
	<title>Geolocation</title>
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
	
	<div class="barre_menu_haut" id="barre_menu_haut">
		<a href="#" class="bt-menu-trigger"><span>Menu</span></a>
		<div id="titreSite">
			Touristix
		</div>
	</div>
	<div class="container-fluid">
		<nav id="bt-menu" class="bt-menu">
			<ul style="margin:0;padding:0">
				<li ><a href="#"><i class="fa fa-info-circle"></i> Menu 1</a></li>
				<li ><a href="#"><i class="fa fa-pencil-square-o"></i> Menu 2</a></li>
			</ul>
		</nav>
	</div>
	<div id="map"></div>
	<script src="/assets/js/map.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABmaswDuz7-HVvHoHgrqYdmunESX84x9s&signed_in=true&callback=initMap" async defer></script>
	<script type="text/javascript" src="/assets/js/jquery-1-11-2.js"></script>
	<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/assets/js/menu-haut.js"></script>
  </body>
</html>
