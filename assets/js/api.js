// Fonctions globales concernant le fonctionnement général de l'appli front


$(document).ready(function(){
	// Fonctions d'initilisation
	get_categ_menu();
	show_hide_cat();
	update_point_list();
	map_height();
	show_err_max_points();
	get_parcours();
	// --

	// Map responsive
	$(window, document).on('resize', function(){
		map_height();
	});
	// --


	// Fonctions comportement menu
	cacherMenuCategorie();
	cacherParcours();
	cacherConstructionParcours(true);
	// --

	// Suppression point itineraire (liste des points)
	$('#constructionParcours ul#listeConstructionParcours').on('click', '.remove_point_lm', function(){
		add_point_itineraire($(this).parent().data('id'), true);
	});
	// --

	// Prévisualisation d'un itineraire sur la map
	$('#btPrevisualiserItineraire').click(function(){
		var points = [];
			start = window['center'];
			idLast = sessionStorage.getItem('lastAdd'); // dernier item ajouté à la map

		$.each(localStorage, function(index, elem){ // parcours des points sur la map stockés sur le client
			var lat = JSON.parse(elem).lat;
				lon = JSON.parse(elem).lon;

			if($.isNumeric(index) && index != idLast){

				points.push({
					location: new google.maps.LatLng(lat, lon),
					stopover: true
				}); //ajout du point de passage à l'itineraire

			}
		});

		window['directionsService'].route({
			origin: window['center'], // point de départ (position du client)
			destination: new google.maps.LatLng(JSON.parse(localStorage.getItem(idLast)).lat, JSON.parse(localStorage.getItem(idLast)).lon), // destination (dernier point ajouté)
			waypoints: points, // liste des points de passage
			optimizeWaypoints: true,
			travelMode: google.maps.TravelMode.DRIVING // mode de déplacement (voiture par défaut)
		}, function(response, status) {
			if (status === google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response); // Affichage du trajet sur la map en cas de success
				
			}else{
			  console.log(response, status);
			}
		});

	});
	// --

	// Affichage d'un itineraire enrigistré (via le menu)
	$('#_ajax_load_parcours').on('click', '._map_point_parcours_update', function(){
		var points = [];
			latLast = '';
			lonLast = '';
			start = window['center'];
			$this = $(this);
			span = $this.children('span'); // Les points sont stockés dans des <span>
		

		var i = 1;
		$(span).each(function(index, elem){
			var lat = $(this).data('latitude');
				lon = $(this).data('longitude');

			if(index+1 != span.length){ // On vérifie si c'est le points d'arrivé ... ou pas

				points.push({
					location: new google.maps.LatLng(lat, lon),
					stopover: true
				});
			}else{
				latLast = $(this).data('latitude');
				lonLast = $(this).data('longitude');
			}

		});

		console.log(latLast);

		window['directionsService'].route({
			origin: window['center'], // position client
			destination: new google.maps.LatLng(latLast, lonLast), // point d'arrivé
			waypoints: points, // points de passages
			optimizeWaypoints: true,
			travelMode: google.maps.TravelMode.DRIVING
		}, function(response, status) {
			if (status === google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response); // retour et affichage
				
			}else{
			  console.log(response, status);
			}
		});
	});
	// --

	// Enregistrement d'un parcours
	$('#formSaveParcours').submit(function(e){
		e.preventDefault();
		var idPoints = [];
		var libelle = $('#nomParcoursSave').val(); // Nom du parcours

		$('#listeConstructionParcours li').each(function(){ // liste des points (id)
			idPoints.push({
				id:$(this).data('id')
			})
		});

		$.ajax({ // envoie de la req ajax
			url: '/SaveParcours',
			type: 'POST',
			dataType: 'json',
			data: {points:JSON.stringify(idPoints), libelle:libelle},
		}).done(function(data){
			if(data == 0)
				document.location.href = '/';
		})
		.fail(function() {
			console.log("error");
		});
	});
	// --

});

// Construction des catégories de lieux dans le menu
function get_categ_menu(){
	$.ajax({
		url: '/categorie',
		type: 'GET',
		dataType: 'json',
		data: {},
	}).done(function(data){
		var menu = $('#_ajax_load_menu');
		$.each(data, function(key, elem){
			menu.append('<li class="_map_point_clicker" data-value="'+key+'" title="Ajouter les marqueurs '+elem+'"><a href="#">'+elem+'</a></li>');
		});
	})
	.fail(function() {
		console.log("error");
	});
}
// --

// Récupération des parcours enregistrés (user loged in)
function get_parcours(){
	$.ajax({
		url: '/LoadParcours',
		type: 'GET',
		dataType: 'json',
		data: {},
	}).done(function(data){
		var menu = $('#_ajax_load_parcours');
		$('#MyParcours .badge').html(data.nbParcours);
		$.each(data.result, function(key, elem){ // foreach sur les parcours enregitrés
			var arr = JSON.parse(elem.parcours);

			menu.append('<li data-name="'+elem.name+'" class="_map_point_parcours_update" id="parcoursList'+elem.id+'" style="display:none;">');

			$.each(arr, function(a, b){ // Ajout d'une span cachée pour conserver les points de passage de l'itineraire dans le DOM
				$('li#parcoursList'+elem.id).append('<span data-id="'+b.id+'" data-latitude="'+b.latitude+'" data-longitude="'+b.longitude+'" style="display:none;"></span>');
			})

			$('li#parcoursList'+elem.id).append('<a href="#" style="color:#59AEE4;">- '+elem.name+'</a></li>');
		});
	})
	.fail(function() {
		console.log("error");
	});
}
// --

function show_hide_cat(){
	if(window.location.pathname != '/'){
		$('#categ_list').css('display', 'none');
	}
}

// Ajoute ou supprime un point à l'itineraire
function add_point_itineraire(id, list){
	var point = $('#point_'+id);
		point_selector = $('#point_'+id+' .point_name');
		name = point_selector.html();
		button = $('#button_'+id);

	// Si la fonction est appelée depuis la liste des points, on est forcément face à une suppression de points
	if(list){
		localStorage.removeItem(id);
		update_point_list();
		show_err_max_points(); // Mise à jour de la map
		return;
	}

	if(button.hasClass('remove')){ // Appel depuis la map de suppression de point
		localStorage.removeItem(id);
		button.removeClass('remove').html('Ajouter');
		show_err_max_points();
	}else{
		if(localStorage.length == 9){ // Max de point d'un itineraire fixé à 10 points (donc 9 max avec le point de départ) à cause des restrictions de la Google Maps API
			$('#MaxPointLabel').css('display', 'block'); //Si le nombre est dépassé : affichage de l'erreur
			return; // Aucun point n'est ajouté au parcours
		}else{
			$('#MaxPointLabel').css('display', 'none'); // Sinon aucune erreur ne s'affiche
		}
		var arr = JSON.stringify({"name": name, "lat": point.data('latitude'), 'lon': point.data('longitude')}); // Le point est enregistré en local au format JSON avec name, latitude, longitude du point
		localStorage.setItem(id, arr);
		button.addClass('remove').html('Retirer');
		sessionStorage.setItem('lastAdd', id); // Ce nouveau point devient le dernier point ajouté à la liste et par défaut le point d'arrivé
		if($( "#blocParcoursSave").is(":hidden")){
			cacherConstructionParcours(); // On affiche la liste des points après un ajout, si celle-ci est fermée
		}
	}

	update_point_list(); // Mise à jour de la liste des points
}
// --

// Fonction de mise à jour de la liste des points
function update_point_list(){
	var list = $('ul#listeConstructionParcours');
		badge = $('#constructionParcours .badge');

	list.html('');

	$.each(localStorage, function(index, elem){
		if($.isNumeric(index)){
			list.append('<li data-latitude="'+JSON.parse(elem).lat+'" data-longitude="'+JSON.parse(elem).lon+'" data-id="'+index+'">'+JSON.parse(elem).name+'<span class="remove_point_lm"><i class="fa fa-times"></i></span></li>');
		}
	});

	badge.html(localStorage.length); // -- Nombre de points stockés

	if(localStorage.length > 0){ // Si aucuin point n'est séléctionné, on empêche le client de prévisualiser ou de sauvegarder un itineraire
		$('#btPrevisualiserItineraire, #nomParcoursSave, #btSaveParcours').removeAttr('disabled');
	}else{
		$('#btPrevisualiserItineraire, #nomParcoursSave, #btSaveParcours').attr('disabled', 'disabled');
	}
}
// --

// Responsive de la map et adaptation au menu
function map_height(){
	var WindowHeight = $(window).height();
		MenuHeight = $('#barre_menu_haut').height();
		MapHeight = WindowHeight - MenuHeight;

	$('#map').css({'margin': MenuHeight+'px 0px 0px 0px', 'height': MapHeight+'px'});
}
// --

// Afficher / cacher onglet catégorie du menu
function cacherMenuCategorie()
{
	if($('._map_point_clicker').css('display') != 'none')
	{
		$('._map_point_clicker').css({'display':'none'});
		$('#flecheCatMenu').html('<i class="fa fa-angle-down fa-2x"></i>');
	}
	else
	{
		$('._map_point_clicker').css({'display':'block'});
		$('#flecheCatMenu').html('<i class="fa fa-angle-up fa-2x"></i>');
	}
}
// --

// Afficher / cacher onglet parcours du menu
function cacherParcours()
{
	if($('._map_point_parcours_update').css('display') != 'none')
	{
		$('._map_point_parcours_update').css({'display':'none'});
		$('#flecheCatParcours').html('<i class="fa fa-angle-down fa-2x"></i>');
	}
	else
	{
		$('._map_point_parcours_update').css({'display':'block'});
		$('#flecheCatParcours').html('<i class="fa fa-angle-up fa-2x"></i>');
	}
}
// --

// Afficher / cacher liste des points du parcours actuel
function cacherConstructionParcours(premierChargement)
{
	if(premierChargement)
	{
		$("#blocParcoursSave").hide();
		$('#constructionParcours p span.fleche').html('<i class="fa fa-angle-up"></i>');
	}
	else
	{
		if($( "#blocParcoursSave").is(":hidden"))
		{
			$("#blocParcoursSave").slideDown("slow");
			$('#constructionParcours p span.fleche').html('<i class="fa fa-angle-down"></i>');
		}
		else
		{
			$("#blocParcoursSave").slideUp("slow");
			$('#constructionParcours p span.fleche').html('<i class="fa fa-angle-up"></i>');
		}
	}
}
// --

// Affichage de l'erreur si le nombre map de points (9) est atteint
function show_err_max_points(){
	if(localStorage.length == 9){
		$('#MaxPointLabel').css('display', 'block');
	}else{
		$('#MaxPointLabel').css('display', 'none');
	}
}
// --