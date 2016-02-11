<div class="barre_menu_haut" id="barre_menu_haut">
	<a href="#" class="bt-menu-trigger"><span>Menu</span></a>
	<div id="titreSite">
		Touristix
	</div>
	<?php if($this->session->userdata('connexion')['id'] != false)
	{
	?>
		<div id="pseudoConnecte" class="visible-lg visible-md visible-sm">
			Connecté en tant que <?php echo $this->session->userdata('connexion')['pseudo']; ?>
		</div>
	<?php
	}
	?>
</div>
<div class="container-fluid">
	<nav id="bt-menu" class="bt-menu">
		<ul style="margin:0;padding:0">
			<?php if($this->session->userdata('connexion')['id'] != false)
			{
			?>
				<li id="pseudoConnecteMenuGauche">
					<i class="fa fa-user"></i> Connecté en tant que <?php echo $this->session->userdata('connexion')['pseudo']; ?>
				</li>
			<?php
			}
			?>
			<li><a href="/"><i class="fa fa-home"></i> Accueil</a></li>
			<?php if($this->session->userdata('connexion')['id'] == false)
			{
			?>
				<li ><a href="/connexion"><i class="fa fa-sign-in"></i> Connexion</a></li>
				<li ><a href="/inscription"><i class="fa fa-pencil-square-o"></i> Inscription</a></li>
			<?php
			} ?>

				<li id="categ_list" class="" onclick="cacherMenuCategorie()"><a href="#"><i class="fa fa-folder-open"></i> Catégories <span id="flecheCatMenu" style="float:right;margin-top:5px"></span></a></li>
				<span id="_ajax_load_menu"></span>

			<?php if($this->session->userdata('connexion')['id'] != false)
			{
			?>
				<li><a href="/listeParcours"><i class="fa fa-map-marker"></i> Mes parcours <span class="badge"><?php if(isset($nbParcours)) echo $nbParcours; ?></span></a></li>
				<?php if(uri_string() == '') { ?>
					<li id="parcours_favori" class=""><a href="#"><i class="fa fa-star"></i> Favoris <span class="badge"><?php echo $nbParcoursFavori; ?></span></a></li>
				<?php } ?>
				<li ><a href="#" data-toggle="modal" data-target="#modalDeconnexion"><i class="fa fa-sign-out"></i> Déconnexion</a></li>
			<?php
			}
			?>
		</ul>
	</nav>
</div>

<!-- Modal -->
<div class="modal fade" id="modalDeconnexion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content" style="background-color:#444444;color:white">
      		<div class="modal-header" style="border-color:#555555">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel">Déconnexion</h4>
      		</div>
      		<div class="modal-body">
        		Êtes-vous sûr de vouloir vous déconnecter ?
      		</div>
     		 <div class="modal-footer" style="border-color:#555555">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        		<a href="/deconnexion" class="btn btn-danger">Se déconnecter</a>
      		</div>
    	</div>
  	</div>
</div>