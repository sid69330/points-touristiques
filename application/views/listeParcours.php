<!DOCTYPE html>
<html>
  <head>
	<title>Touristix | Lyon ne sera plus un secret pour vous !</title>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/include_css.php'); ?>
	<script type="text/javascript" src="/assets/js/modernizr.custom.js"></script>
	
		<script type="text/javascript">
		function favorite(id){
			var csrfname = "<?php echo $this->security->get_csrf_token_name(); ?>";
        	var csrftoken = "<?php echo $this->security->get_csrf_hash();?>";
			var xhr = new XMLHttpRequest();
			xhr.open('POST', '/Createfav');
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send('parcours=' + id + '&'+csrfname+'='+ csrftoken);
			xhr.onreadystatechange = function(){
				 if (xhr.readyState === 4 && xhr.status === 200 || xhr.status === 0){
				 	var img='etoile_favori_'+id;
				 	var img_name="img/etoile_"+xhr.responseText+'.png';
				 	document.getElementById(img).src=img_name;
				 }
			}
		}
	</script>


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
					$img=$v->favorite?'jaune':'blanche';
					echo '<img onclick = "favorite(\'' . $v->id . '\');" src="img/etoile_' . $img . '.png" id="etoile_favori_' . $v->id . '" />' . $v->name . '<br/>';
				}
			}
		 ?>
	</div>
	<script type="text/javascript" src="/assets/js/jquery-1-11-2.js"></script>
	<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/assets/js/menu-haut.js"></script>
	<script src="/assets/js/map-style.js"></script>
  </body>
</html>