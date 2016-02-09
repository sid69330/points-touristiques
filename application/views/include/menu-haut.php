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
			<li>
				<select id="cat_menu">
					<option value="none">Catégorie</option>
					<?php foreach($categ as $key => $value): ?>
						<option class="_map_point_clicker" value="<?= $key ?>"><?= $value ?></option>
					<?php endforeach; ?>
				</select>
			</li>
		</ul>
	</nav>
</div>
