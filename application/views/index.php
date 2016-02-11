<!DOCTYPE html>
<html>
  <head>
	<title>Touristix | Lyon ne sera plus un secret pour vous !</title>
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
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/menu-haut.php'); ?>

	<?php if($this->session->userdata('connexion')['pseudo'] != false)
	{
	?>
	<div id="constructionParcours">
		<p id="MaxPointLabel"><i class="fa fa-exclamation-triangle"></i>&nbsp;&nbsp;&nbsp;Nombre Max de points atteint</p>
		<p onclick="cacherConstructionParcours()">Parcours actuel <span class="badge">0</span><span class="fleche"><i class="fa fa-angle-up"></i></span></p>
		<div id="blocParcoursSave">
			<ul id="listeConstructionParcours">
			</ul>
			<button class="btn btn-block btn-info btn-xs" disabled="disabled" id="btPrevisualiserItineraire">Prévisualiser l'itinéraire</button>
			<form id="formSaveParcours" style="width:100%">
				<div class="col-xs-9" style="margin:0;padding:0">
					<input type="text" id="nomParcoursSave" name="nomParcoursSave" placeholder="Nom du parcours" style="width:100%;height:25px" disabled="disabled"/>
				</div>
				<div class="col-xs-3" style="margin:0;padding:0">
					<button type="submit" id="btSaveParcours" class="btn btn-xs bt-jaune" style="width:100%;height:25px" disabled="disabled">Enregistrer</button>
				</div>
			</form>
		</div>
	</div>
	<?php
	}
	?>
	<div id="map"></div>
	<script type="text/javascript" src="/assets/js/jquery-2.2.0.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABmaswDuz7-HVvHoHgrqYdmunESX84x9s&signed_in=true&callback=initMap" async defer></script>
	<script type="text/javascript" src="/assets/js/map.js" async></script>
	<script type="text/javascript" src="/assets/js/modernizr.custom.js"></script>
	<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/assets/js/menu-haut.js"></script>
	<script type="text/javascript" src="/assets/js/api.js"></script>
  </body>
</html>