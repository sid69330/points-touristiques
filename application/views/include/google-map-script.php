<script type="text/javascript">
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

		
			<?php foreach($coord as $value): ?>
				
					var marker = new google.maps.Marker({
						position: {lat: <?= $value['points']['latitude'] ?>, lng: <?= $value['points']['longitude'] ?>},
						map: map,
						title: "<?= $value['nom']; ?>"
					});
				
			<?php endforeach; ?>
		

		google.maps.event.addDomListener(window, 'resize', function() {
			map.setCenter(center);
		});
	}

	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		infoWindow.setPosition(pos);
		infoWindow.setContent(browserHasGeolocation ?
							'Error: The Geolocation service failed.' :
							'Error: Your browser doesn\'t support geolocation.');
	}
</script>