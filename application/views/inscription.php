<!DOCTYPE html>
<html>
  <head>
	<title>Touristix | Inscription</title>
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	<meta charset="utf-8">
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/include_css.php'); ?>
	<script type="text/javascript" src="/assets/js/modernizr.custom.js"></script>
  </head>
  <body>
	<?php include_once($_SERVER['DOCUMENT_ROOT'].'/application/views/include/menu-haut.php'); ?>
	
	<?php if(isset($erreur) && ($erreur != '')) echo '<div class="alert alert-danger">'.$erreur.'</div>'; ?>

	<div class="container">
		<h1 class="titrePage">Inscription</h1>

		<?php echo form_open('/inscription', array('class'=>'form-horizontal')); ?>
			<?php echo form_error('pseudo', '<div class="alert alert-danger">', '</div>'); ?>
			<div class="form-group">
			  	<label class="col-md-3 control-label" for="pseudo">Pseudo</label>  
			  	<div class="col-md-6">
			  		<input id="pseudo" name="pseudo" type="text" placeholder="pseudo" class="form-control input-md" value="<?php echo set_value('pseudo'); ?>" >
			 	</div>
			</div>
			<?php echo form_error('email', '<div class="alert alert-danger">', '</div>'); ?>
			<div class="form-group">
		  		<label class="col-md-3 control-label" for="email">Email</label>  
		  		<div class="col-md-6">
		  			<input id="email" name="email" type="text" placeholder="email" class="form-control input-md" value="<?php echo set_value('email'); ?>">
		  		</div>
			</div>
			<?php echo form_error('mdp', '<div class="alert alert-danger">', '</div>'); ?>
			<div class="form-group">
		  		<label class="col-md-3 control-label" for="mdp">Mot de passe</label>
		  		<div class="col-md-6">
		    			<input id="mdp" name="mdp" type="password" placeholder="mot de passe" class="form-control input-md">
		  		</div>
			</div>
			<?php echo form_error('mdp2', '<div class="alert alert-danger">', '</div>'); ?>
			<div class="form-group">
		  		<label class="col-md-3 control-label" for="mdp2">Ressaisir</label>
		  		<div class="col-md-6">
		    			<input id="mdp2" name="mdp2" type="password" placeholder="mot de passe" class="form-control input-md">
		  		</div>
			</div>

			<div class="form-group">
		  		<div class="col-md-6 col-md-offset-3">
		    			<button class="btn btn-warning btn-block bt-jaune">Inscription</button>
		  		</div>
			</div>
		<?php echo form_close(); ?>
	</div>

	<script src="/assets/js/map.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABmaswDuz7-HVvHoHgrqYdmunESX84x9s&signed_in=true&callback=initMap" async defer></script>
	<script type="text/javascript" src="/assets/js/jquery-1-11-2.js"></script>
	<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/assets/js/menu-haut.js"></script>
  </body>
</html>
