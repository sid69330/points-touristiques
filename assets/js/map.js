	var markers = []; // Array des points touristiques à afficher sur la map

	function initMap() { // initialisation de la map
		var map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 45.764043, lng: 4.835658999999964}, // Centre le Lyon par défaut
			zoom: 16
		});

		var directionsService = new google.maps.DirectionsService; // Service Google Maps API d'affichage des instructions de direction
		var directionsDisplay = new google.maps.DirectionsRenderer({ // Service Google Maps API d'affichage de l'itineraire sur la map
				draggable: true,
			 	map: map
			});

	directionsDisplay.addListener('directions_changed', function() { // Ecoute un changement d'itineraire pour le changer dynamiquement sur la map
		computeTotalDistance(directionsDisplay.getDirections());
	});


	// Globales de la map
	window['map'] = map;
	window['directionsService'] = directionsService;
	window['directionsDisplay'] = directionsDisplay;

	var center = {lat: 45.764043, lng: 4.835658999999964};

	  // Géolocalisation via HTML5
		if (navigator.geolocation){
			navigator.geolocation.getCurrentPosition(function(position) {
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};

	  			window['center'] = pos; // Position du client géolocalisé

	  			// Customisation du marker correspondant à la position du client sur la map
				var pinColor = "498BFF";
				var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|" + pinColor,
					new google.maps.Size(21, 34),
					new google.maps.Point(0,0),
					new google.maps.Point(10, 34));
				var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
					new google.maps.Size(40, 37),
					new google.maps.Point(0, 0),
					new google.maps.Point(12, 35));

				var marker = new google.maps.Marker({ // Marqueur identifiant le client
					position: pos,
					map: map,
					icon: pinImage,
					labelClass: "myPosition",
					zIndex: 100000
				});

				map.setCenter(pos);
			});
		}else{
			// Erreur le localision ou pas supportée par le navigateur
			handleLocationError(false, infoWindow, map.getCenter());
		}


		get_categorie_mark(); // On récupère les points sur la map (filtrés pas catégories)

		// Evenement changement de filtre de catégorie dans le menu : ajout ou supression des marqueurs sur la map
		$('#_ajax_load_menu').on('click', '._map_point_clicker', function(){
			var type = $(this).data('value');

			$(this).toggleClass('active');

			if($(this).hasClass('active')){
				addMarkers(type);
			}else{
				removeMarkers(type);
			}

		});

		$('._map_point_clicker a').click(function(e){
			e.preventDefault();
		});


		// Fonction d'ajout des marqueurs
		function addMarkers(filterType){
			var temp = window[filterType]; // Filtre des catégories
			
			markers[filterType] = new Array();
			
			for (var i = 0; i < temp.length; i++) {
	
				var phones = temp[i]['phone'].split(";"); // phone number au format 0000000000;1111111111 du point tourisique
					str_phones = '';
				$.each(phones, function(key, elem){ // Liste des num de téléphones - identification des fixes et portables
					if(elem.trim().substr(1, 1) == '6' || elem.trim().substr(1, 1) == '7'){
						str_phones += 'Portable: <a href="tel:'+elem+'">'+elem+'</a><br>';
					}else if(elem.trim().length > 0){
						str_phones += 'Téléphone: <a href="tel:'+elem+'">'+elem+'</a><br>';
					}else{
						str_phones = '';
					}
				});

				if(temp[i]['email'].trim() != ''){ // email du point touristique
					str_email = 'Email: <a href="mailto:'+temp[i]['email'].trim()+'">'+temp[i]['email'].trim()+'</a><br>';
				}else{
					str_email = '';
				}

				if(temp[i]['facebook'].trim() != ''){ // Compte facebook du point touristique
					str_facebook = '<a href="'+temp[i]['facebook'].trim()+'" target="_blanck"><i class="fa fa-facebook-official"></i>&nbsp;&nbsp;Lien Facebook</a><br>';
				}else{
					str_facebook = '';
				}

				if(localStorage.getItem(temp[i]['id'])){ // Bouton d'ajout ou de retrait à la liste itineraire
					var buttonSubmit = "<button data-id='"+temp[i]['id']+"' id='button_"+temp[i]['id']+"' onclick=\"add_point_itineraire('"+temp[i]['id'].trim()+"', false);\" class='_add_to_itineraire remove'>Retirer</button>";
				}else{
					var buttonSubmit = "<button data-id='"+temp[i]['id']+"' id='button_"+temp[i]['id']+"' onclick=\"add_point_itineraire('"+temp[i]['id'].trim()+"', false);\" class='_add_to_itineraire'>Ajouter</button>";
				}

				// chaine de l'infobulle
				var contentString = "<div data-latitude='"+temp[i]['latitude']+"' data-longitude='"+temp[i]['longitude']+"' class='infowindow_content' id='point_"+temp[i]['id']+"'><div class='point_name' style='font-weight:bold;color:#08A12B'>"+temp[i]['name']+"</div><div class='point_detail' style='font-style:italic;'>"+temp[i]['detail'].replace(';', ', ')+"</div><div class='point_adress'>"+temp[i]['adress']+"</div><div class='point_zip_city'>"+temp[i]['zip']+" - "+temp[i]['city']+"</div><div>"+str_phones+"</div><div>"+str_email+"</div><div>"+str_facebook+"</div><div>"+buttonSubmit+"</div></div>";

				// Ajout d'une nouvelle infobulle
				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
				
				// Ajout d'un marqueur
				var marker = new google.maps.Marker({
					map: window['map'], // carte
					info: contentString, // Contenu de l'infobulle stocké en this
					position: temp[i]['mark'] // coordonnées su marqueur
				});
				
				// Affichage de la bonne infobulle sur le bon marqueur au click sur le marqueur
				google.maps.event.addListener(marker, 'click', function(){
					infowindow.setContent(this.info);
					infowindow.open(map, this);
				});

				// Ajout au tableau des marqueurs
				markers[filterType].push(marker);
			}
		}

		// Supression d'un marqueur
		function removeMarkers(filterType) {
			var temp = ''+filterType;
			for (var i = 0; i < markers[filterType].length; i++) {
				markers[filterType][i].setMap(null);
			}
		}

	}

	function handleLocationError(browserHasGeolocation, infoWindow, pos) { // Erreur de localisation du client à l'initalisation de la map
		infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ?
							'Error: The Geolocation service failed.' :
							'Error: Your browser doesn\'t support geolocation.');
	}

	function get_categorie_mark(){ // Récupère les catégories de points touristiques
		return $.ajax({
			url: '/categorie',
			type: 'GET',
			dataType: 'json',
			data: {},
		}).done(function(data){
			window['categorie'] = data;
			get_marks(); // Récupération des marqueurs
		});
	}

	function get_marks(){ // Récupération des marqueurs
		return $.ajax({
			url: '/markers',
			type: 'GET',
			dataType: 'json',
			data: {},
		}).done(function(res){
			window['marker'] = res;
			$.each(window['categorie'], function(cat_key, cat_val){
				window[cat_key] = [];
				

					$.each(window['marker'], function(k, elem){
						
						if(cat_key == elem.type){ // Ajout des marqueurs dans plusieurs tableaux dynamiques suivant la catégorie à laquel ils sont rattachés
							window[cat_key].push({latitude: elem.points.latitude, longitude: elem.points.longitude, 'mark': new google.maps.LatLng(elem.points.latitude, elem.points.longitude), 'name': elem.name, 'adress': elem.adress, 'zip': elem.zip, 'city': elem.city, 'phone': elem.phone, 'detail': elem.detail, 'email': elem.email, 'facebook': elem.facebook, 'id': elem.id});
						}

					});

			});
		});
	}