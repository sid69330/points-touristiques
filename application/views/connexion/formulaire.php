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
        <h1 class="titrePage">Connexion</h1>
        
        <?php echo form_open('connexion',array('class' => 'form-horizontal')); ?>
            <?php if(isset($erreur) && ($erreur != '')) echo "<p class='alert alert-danger'>".$erreur."</p>"; ?>
            <br/><div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label" for="pseudo">Pseudo / Mail</label>  
                <div class="col-sm-6 col-xs-12">
                    <input id="pseudo" name="pseudo" placeholder="Pseudo / Mail" class="form-control input-md" required="" type="text" value="<?php echo set_value('pseudo'); ?>" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label" for="mdp">Mot de passe</label>
                <div class="col-sm-6 col-xs-12">
                    <input id="mdp" name="mdp" placeholder="Mot de passe" class="form-control input-md" required="" type="password" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3 col-xs-12">
                    <button id="valider" name="valider" class="btn btn-success btn-block"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Connexion</button>
                </div>
            </div>
        </form>
    </div>

    <script src="/assets/js/map.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABmaswDuz7-HVvHoHgrqYdmunESX84x9s&signed_in=true&callback=initMap" async defer></script>
    <script type="text/javascript" src="/assets/js/jquery-1-11-2.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/js/menu-haut.js"></script>
  </body>
</html>