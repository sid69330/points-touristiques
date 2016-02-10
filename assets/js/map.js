	var markers = [];

	function initMap() {
	  var map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: 45.764043, lng: 4.835658999999964},
		zoom: 16
	  });

	  var center = {lat: 45.764043, lng: 4.835658999999964};

	  // Try HTML5 geolocation.
		if (navigator.geolocation){
			navigator.geolocation.getCurrentPosition(function(position) {
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};

				var pinColor = "498BFF";
				var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=A|" + pinColor,
					new google.maps.Size(21, 34),
					new google.maps.Point(0,0),
					new google.maps.Point(10, 34));
				var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
					new google.maps.Size(40, 37),
					new google.maps.Point(0, 0),
					new google.maps.Point(12, 35));

				var marker = new google.maps.Marker({
					position: pos,
					map: map,
					icon: pinImage,
					labelClass: "myPosition",
					zIndex: 100000
				});

				map.setCenter(pos);
			});
		}else{
			// Browser doesn't support Geolocation
			handleLocationError(false, infoWindow, map.getCenter());
		}


		var _categories = get_categorie_mark();

		_categories.success(function(categ){

			$.each(categ, function(cat_key, cat_val){
				window[cat_key] = [];
				var _markers = get_marks();

				_markers.success(function(markers){

					$.each(markers, function(k, elem) {
						
						if(cat_key == elem.type){
							window[cat_key].push({'mark': new google.maps.LatLng(elem.points.latitude, elem.points.longitude), 'name': elem.name, 'adress': elem.adress, 'zip': elem.zip, 'city': elem.city, 'phone': elem.phone, 'detail': elem.detail, 'email': elem.email, 'facebook': elem.facebook});
						}

					});

				});

			});

		});

		$('._map_point_clicker').on('click', function(){
			var type = $(this).data('value');

			$(this).toggleClass('active');

			if($(this).hasClass('active')){
				addMarkers(type);
			}else{
				removeMarkers(type);
			}

		});

		function addMarkers(filterType){
			var temp = window[filterType];
			
			markers[filterType] = new Array();
			
			for (var i = 0; i < temp.length; i++) {
	
				var phones = temp[i]['phone'].split(";");
					str_phones = '';
				$.each(phones, function(key, elem){
					if(elem.trim().substr(1, 1) == '6' || elem.trim().substr(1, 1) == '7'){
						str_phones += 'Portable: <a href="tel:'+elem+'">'+elem+'</a><br>';
					}else if(elem.trim().length > 0){
						str_phones += 'Téléphone: <a href="tel:'+elem+'">'+elem+'</a><br>';
					}else{
						str_phones = '';
					}
				});

				if(temp[i]['email'].trim() != ''){
					str_email = 'Email: <a href="mailto:'+temp[i]['email'].trim()+'">'+temp[i]['email'].trim()+'</a><br>';
				}else{
					str_email = '';
				}

				if(temp[i]['facebook'].trim() != ''){
					str_facebook = '<a href="'+temp[i]['facebook'].trim()+'" target="_blanck"><i class="fa fa-facebook-official"></i>&nbsp;&nbsp;Lien Facebook</a><br>';
				}else{
					str_facebook = '';
				}
				var buttonSubmit = "<button class='_add_to_itineraire'>Ajouter</button>";
				var contentString = "<div class='infowindow_content'><div style='font-weight:bold;color:#08A12B'>"+temp[i]['name']+"</div><div style='font-style:italic;'>"+temp[i]['detail'].replace(';', ', ')+"</div><div>"+temp[i]['adress']+"</div><div>"+temp[i]['zip']+" - "+temp[i]['city']+"</div><div>"+str_phones+"</div><div>"+str_email+"</div><div>"+str_facebook+"</div><div>"+buttonSubmit+"</div></div>";

				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
				
				var marker = new google.maps.Marker({
					map: map,
					info: contentString,
					position: temp[i]['mark']
				});
				
				google.maps.event.addListener(marker, 'click', function(){
					infowindow.setContent(this.info);
					infowindow.open(map, this);
				});


				markers[filterType].push(marker);
			}
		}

		function removeMarkers(filterType) {
			var temp = ''+filterType;
			for (var i = 0; i < markers[filterType].length; i++) {
				markers[filterType][i].setMap(null);
			}
		}

	}

	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ?
							'Error: The Geolocation service failed.' :
							'Error: Your browser doesn\'t support geolocation.');
	}

	function get_categorie_mark(){
		return $.ajax({
			url: '/categorie',
			type: 'GET',
			dataType: 'json',
			data: {},
		}).done(function(data){

		});
	}

	function get_marks(){
		return $.ajax({
			url: '/markers',
			type: 'GET',
			dataType: 'json',
			data: {},
		}).done(function(data){
			return data;
		});
	}