$(document).ready(function(){
	get_categ_menu();
	show_hide_cat();
	update_point_list();
	map_height();
	show_err_max_points();
	get_parcours();

	$(window, document).on('resize', function(){
		map_height();
	});

	cacherMenuCategorie();
	cacherParcours();
	cacherConstructionParcours(true);

	$('#constructionParcours ul#listeConstructionParcours').on('click', '.remove_point_lm', function(){
		add_point_itineraire($(this).parent().data('id'), true);
	});

	$('#btPrevisualiserItineraire').click(function(){
		var points = [];
			start = window['center'];
			idLast = sessionStorage.getItem('lastAdd');

		$.each(localStorage, function(index, elem){
			var lat = JSON.parse(elem).lat;
				lon = JSON.parse(elem).lon;

			if($.isNumeric(index) && index != idLast){

				points.push({
					location: new google.maps.LatLng(lat, lon),
					stopover: true
				});

			}
		});
		console.log(JSON.parse(localStorage.getItem(idLast)).lat);
		console.log(JSON.parse(localStorage.getItem(idLast)).lon);

		window['directionsService'].route({
			origin: window['center'],
			destination: new google.maps.LatLng(JSON.parse(localStorage.getItem(idLast)).lat, JSON.parse(localStorage.getItem(idLast)).lon),
			waypoints: points,
			optimizeWaypoints: true,
			travelMode: google.maps.TravelMode.DRIVING
		}, function(response, status) {
			if (status === google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
				
			}else{
			  console.log(response, status);
			}
		});

	});

	$('#_ajax_load_parcours').on('click', '._map_point_parcours_update', function(){
		var points = [];
			latLast = '';
			lonLast = '';
			start = window['center'];
			$this = $(this);
			span = $this.children('span');
		

		var i = 1;
		$(span).each(function(index, elem){
			var lat = $(this).data('latitude');
				lon = $(this).data('longitude');

			if(index+1 != span.length){

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
			origin: window['center'],
			destination: new google.maps.LatLng(latLast, lonLast),
			waypoints: points,
			optimizeWaypoints: true,
			travelMode: google.maps.TravelMode.DRIVING
		}, function(response, status) {
			if (status === google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
				
			}else{
			  console.log(response, status);
			}
		});
	});

	$('#formSaveParcours').submit(function(e){
		e.preventDefault();
		var idPoints = [];
		var libelle = $('#nomParcoursSave').val();

		$('#listeConstructionParcours li').each(function(){
			idPoints.push({
				id:$(this).data('id')
			})
		});

		$.ajax({
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

});

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

function get_parcours(){
	$.ajax({
		url: '/LoadParcours',
		type: 'GET',
		dataType: 'json',
		data: {},
	}).done(function(data){
		var menu = $('#_ajax_load_parcours');
		$('#MyParcours .badge').html(data.nbParcours);
		$.each(data.result, function(key, elem){
			var arr = JSON.parse(elem.parcours);

			menu.append('<li data-name="'+elem.name+'" class="_map_point_parcours_update" id="parcoursList'+elem.id+'" style="display:none;">');

			$.each(arr, function(a, b){
				$('li#parcoursList'+elem.id).append('<span data-id="'+b.id+'" data-latitude="'+b.latitude+'" data-longitude="'+b.longitude+'" style="display:none;"></span>');
			})

			$('li#parcoursList'+elem.id).append('<a href="#" style="color:#59AEE4;">'+elem.name+'</a></li>');
		});
	})
	.fail(function() {
		console.log("error");
	});
}


function show_hide_cat(){
	if(window.location.pathname != '/'){
		$('#categ_list').css('display', 'none');
	}
}

function add_point_itineraire(id, list){
	var point = $('#point_'+id);
		point_selector = $('#point_'+id+' .point_name');
		name = point_selector.html();
		button = $('#button_'+id);


	if(list){
		localStorage.removeItem(id);
		update_point_list();
		show_err_max_points();
		return;
	}

	if(button.hasClass('remove')){
		localStorage.removeItem(id);
		button.removeClass('remove').html('Ajouter');
		show_err_max_points();
	}else{
		if(localStorage.length == 9){
			$('#MaxPointLabel').css('display', 'block');
			return;
		}else{
			$('#MaxPointLabel').css('display', 'none');
		}
		var arr = JSON.stringify({"name": name, "lat": point.data('latitude'), 'lon': point.data('longitude')});
		localStorage.setItem(id, arr);
		button.addClass('remove').html('Retirer');
		sessionStorage.setItem('lastAdd', id);
		if($( "#blocParcoursSave").is(":hidden")){
			cacherConstructionParcours();
		}
	}

	update_point_list();
}

function update_point_list(){
	var list = $('ul#listeConstructionParcours');
		badge = $('#constructionParcours .badge');

	list.html('');

	$.each(localStorage, function(index, elem){
		if($.isNumeric(index)){
			list.append('<li data-latitude="'+JSON.parse(elem).lat+'" data-longitude="'+JSON.parse(elem).lon+'" data-id="'+index+'">'+JSON.parse(elem).name+'<span class="remove_point_lm"><i class="fa fa-times"></i></span></li>');
		}
	});

	badge.html(localStorage.length);

	if(localStorage.length > 0){
		$('#btPrevisualiserItineraire, #nomParcoursSave, #btSaveParcours').removeAttr('disabled');
	}else{
		$('#btPrevisualiserItineraire, #nomParcoursSave, #btSaveParcours').attr('disabled', 'disabled');
	}
}

function map_height(){
	var WindowHeight = $(window).height();
		MenuHeight = $('#barre_menu_haut').height();
		MapHeight = WindowHeight - MenuHeight;

	$('#map').css({'margin': MenuHeight+'px 0px 0px 0px', 'height': MapHeight+'px'});
}

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

function show_err_max_points(){
	if(localStorage.length == 9){
		$('#MaxPointLabel').css('display', 'block');
	}else{
		$('#MaxPointLabel').css('display', 'none');
	}
}