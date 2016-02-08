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