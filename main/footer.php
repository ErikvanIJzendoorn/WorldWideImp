<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../main/footer.css">
	<script src='https://api.mapbox.com/mapbox.js/v3.1.1/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v3.1.1/mapbox.css' rel='stylesheet' />
</head>

<div>
	<div class="main-footer">
		<div id="aboutus">
			<h4>About us</h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas, ducimus repellendus ex reprehenderit animi placeat amet. Tempore quibusdam maxime, esse mollitia non ipsa sunt labore nisi optio animi omnis facere!</p>
		</div>
		<div id="contact-info">
			<h4>Contact Info</h4>
		 <p> World Wide Importers</p>
		 <p> Campus 2-6</p>
		 <p> 8017 CA</p>
		 <p> Zwolle</p>
		 <br>
		 <p>Telefoon: 038-123456</p>
		 <p>Email: info@wwi.com</p>
		</div>
		<div id="map"></div>
	</div>
</div>	
<script>
L.mapbox.accessToken = 'pk.eyJ1Ijoic29uamF2cmVkZXZlbGQiLCJhIjoiY2pvaWxncGlkMDloZTNxbWRucjJmcjQwaiJ9.-DD-HiWnV0TOPGGBmDuQIw';
var map = L.mapbox.map('map', 'mapbox.streets')
    .setView([52.500993799999996, 6.0795417	], 15);
    L.mapbox.featureLayer({
    // this feature is in the GeoJSON format: see geojson.org
    // for the full specification
    type: 'Feature',
    geometry: {
        type: 'Point',
        // coordinates here are in longitude, latitude order because
        // x, y is the standard for GeoJSON and many formats
        coordinates: [
          6.0795417 ,
          52.500993799999996
        ]
    },
    properties: {
        title: 'WorldWideImporters',
        description: 'Temporary adress',
        // one can customize markers by adding simplestyle properties
        // https://www.mapbox.com/guides/an-open-platform/#simplestyle
        'marker-size': 'large',
        'marker-color': '#dc3545'
    }
}).addTo(map);
</script>