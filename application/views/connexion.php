<!DOCTYPE html>
<html>
  <head>
    <title>Touristix | Connexion</title>
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
        
        <?php echo form_open('/connexion',array('class' => 'form-horizontal')); ?>
            <?php if(isset($erreur) && ($erreur != '')) echo "<p class='alert alert-danger'>".$erreur."</p>"; ?>
            <?php echo form_error('pseudo', '<div class="alert alert-danger">', '</div>'); ?>
            <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label" for="pseudo">Pseudo / Mail</label>  
                <div class="col-sm-6 col-xs-12">
                    <input id="pseudo" name="pseudo" placeholder="Pseudo / Mail" class="form-control input-md" type="text" value="<?php echo set_value('pseudo'); ?>" autocomplete="off">
                </div>
            </div>
            <?php echo form_error('mdp', '<div class="alert alert-danger">', '</div>'); ?>
            <div class="form-group">
                <label class="col-sm-3 col-xs-12 control-label" for="mdp">Mot de passe</label>
                <div class="col-sm-6 col-xs-12">
                    <input id="mdp" name="mdp" placeholder="Mot de passe" class="form-control input-md" type="password" autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-3 col-xs-12">
                    <button id="valider" name="valider" class="btn btn-success btn-block bt-jaune"><i class="fa fa-sign-in"></i> Connexion</button>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="/assets/js/jquery-2.2.0.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/js/menu-haut.js"></script>
  </body>
</html>