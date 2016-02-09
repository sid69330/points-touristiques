<div class="barre_menu_haut" id="barre_menu_haut">
	<a href="#" class="bt-menu-trigger"><span>Menu</span></a>
	<div id="titreSite">
		Touristix
	</div>
</div>
<div class="container-fluid">
	<nav id="bt-menu" class="bt-menu">
		<ul style="margin:0;padding:0">
			<li ><a href="/"><i class="fa fa-home"></i> Accueil</a></li>
			<?php if($this->session->userdata('connexion')['pseudo'] == false)
				  {
			?>
					<li ><a href="/connexion"><i class="fa fa-sign-in"></i> Connexion</a></li>
					<li ><a href="/inscription"><i class="fa fa-pencil-square-o"></i> Inscription</a></li>
			<?php
				  } else {
			?>
					<li ><a href="/"><i class="fa fa-sign-in"></i> Déconnexion</a></li>
			<?php
				  }
			?>
			
			<?php 
				if(isset($categ))
				{
					?><li class="titreCatMenu">Catégories</li><?php
					foreach($categ as $key => $value): ?>
					<li class="_map_point_clicker" data-value="<?= $key ?>"><a href="#"><?= $value ?></a></li>
					<?php endforeach; 
				} 	?>
		</ul>
	</nav>
</div>