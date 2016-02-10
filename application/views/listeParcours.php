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
	<div class="container">
		<h1 class="titrePage">Vos parcours enregistrés</h1>
		<?php 
			if ($tab['erreur'] != ''){
				echo $tab['erreur'];
			}else{
				foreach($tab['result'] as $k => $v)
				{
					//print_r($v);
					echo '<a href="index?' . $k . '">' . $v->name . '</a><br/>';
				}
			}
		 ?>
	</div>
  </body>
</html>