<!DOCTYPE html>
<html>
  	<head>
		<title>Touristix | Lyon ne sera plus un secret pour vous !</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/include_css.php'); ?>
		<script type="text/javascript" src="/assets/js/modernizr.custom.js"></script>
  	</head>
  	<body>

		<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/menu-haut.php'); ?>
		<div class="container">
			<h1 class="titrePage">Vos parcours enregistrés</h1>
			<?php 
				if(count($result) > 0)
				{
					echo '<p class="text-center" style="font-size:12px;font-style:italic">'.count($result); ?> parcours enregistré(s) sur votre compte.</p><?php
					foreach($result as $fav)
					{
						if($fav->favorite == 1)
							$img = 'jaune';
						else
							$img = 'blanche';
						?>
						<div class="panel panel-default">
  							<div class="panel-heading">
					    		<h3 class="panel-title"><?php echo $fav->name; ?></h3>
					  		</div>
					  		<div class="panel-body">
					    		Contenu
					  		</div>
					  		<div class="panel-footer">
					  			<?php 
					  			if($fav->favorite == 1)
					  				echo '<span style="cursor:pointer" id="reponseAjax_'.$fav->id.'" onclick="favorite('.$fav->id.');">Retirer des favoris <img src="/assets/images/jaune.png"/></span>';
					  			else
					  				echo '<span style="cursor:pointer" id="reponseAjax_'.$fav->id.'" onclick="favorite('.$fav->id.');">Ajouter aux favoris <img src="/assets/images/blanche.png"/></span>';
					  			?>
					  		</div>
						</div>
						<?php
					}
				}
				else
				{
					echo '<div class="alert alert-danger">Aucun parcours enregistré pour votre compte.</div>';
				}
			 ?>
		</div>
		<script type="text/javascript" src="/assets/js/jquery-2.2.0.min.js"></script>
		<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="/assets/js/menu-haut.js"></script>
		<script type="text/javascript">
		function favorite(id)
		{
			var csrfname = "<?php echo $this->security->get_csrf_token_name(); ?>";
	    	var csrftoken = "<?php echo $this->security->get_csrf_hash();?>";
			var xhr = new XMLHttpRequest();
			xhr.open('POST', '/Createfav');
			xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr.send('parcours=' + id + '&'+csrfname+'='+ csrftoken);
			xhr.onreadystatechange = function()
			{
				 if (xhr.readyState === 4 && xhr.status === 200 || xhr.status === 0)
				 {
				 	if(xhr.responseText == 'jaune')
				 		document.getElementById("reponseAjax_"+id).innerHTML='Retirer des favoris <img src="/assets/images/'+xhr.responseText+'.png"/>';
				 	else
				 		document.getElementById("reponseAjax_"+id).innerHTML='Ajouter aux favoris <img src="/assets/images/'+xhr.responseText+'.png"/>';
				 }
			}
		}
		</script>
  	</body>
</html>