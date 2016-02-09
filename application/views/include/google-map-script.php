<script type="text/javascript">
var markers = [];

	function initMap() {
	  var map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: 45.764043, lng: 4.835658999999964},
		zoom: 12
	  });
	  var infoWindow = new google.maps.InfoWindow({map: map});
	  var center = {lat: 45.764043, lng: 4.835658999999964};

	  // Try HTML5 geolocation.
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};

				infoWindow.setPosition(pos);
				infoWindow.setContent("<div id='hereyouare'>Je suis ici</div>");
				map.setCenter(pos);
			}, function() {
				handleLocationError(true, infoWindow, map.getCenter());
			});
		}else{
			// Browser doesn't support Geolocation
			handleLocationError(false, infoWindow, map.getCenter());
		}

		<?php foreach($categ as $catkey => $catval): ?>
	
			var <?= $catkey ?> = [
				<?php foreach($coord as $value): ?>
					<?php if($catkey === $value['type']): ?>
						new google.maps.LatLng(<?= $value['points']['latitude'] ?>, <?= $value['points']['longitude'] ?>),
					<?php endif; ?>
				<?php endforeach; ?>
			];
		<?php endforeach; ?>

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
    		if(filterType === 'COMMERCE_ET_SERVICE'){
		    	var temp = COMMERCE_ET_SERVICE;
    		}else if(filterType === 'DEGUSTATION'){
    			var temp = DEGUSTATION;
    		}else if(filterType === 'EQUIPEMENT'){
    			var temp = EQUIPEMENT;
    		}else if(filterType === 'HEBERGEMENT_COLLECTIF'){
    			var temp = HEBERGEMENT_COLLECTIF;
    		}else if(filterType === 'HEBERGEMENT_LOCATIF'){
    			var temp = HEBERGEMENT_LOCATIF;
    		}else if(filterType === 'HOTELLERIE'){
    			var temp = HOTELLERIE;
    		}else if(filterType === 'HOTELLERIE_PLEIN_AIR'){
    			var temp = HOTELLERIE_PLEIN_AIR;
    		}else if(filterType === 'PATRIMOINE_CULTUREL'){
    			var temp = PATRIMOINE_CULTUREL;
    		}else if(filterType === 'PATRIMOINE_NATUREL'){
    			var temp = PATRIMOINE_NATUREL;
    		}else if(filterType === 'RESTAURATION'){
    			var temp = RESTAURATION;
    		}
		    
		    markers[filterType] = new Array();
		    
		    for (var i = 0; i < temp.length; i++) {
		        
		        var marker = new google.maps.Marker({
		            map: map,
		            position: temp[i]
		        });
		        
		        markers[filterType].push(marker);
		    }
		    console.log(markers);
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
</script>