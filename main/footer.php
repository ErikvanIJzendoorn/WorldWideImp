<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../main/footer.css">
	<script src='https://api.mapbox.com/mapbox.js/v3.1.1/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v3.1.1/mapbox.css' rel='stylesheet' />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<div>
	<div class="main-footer">
		<div id="aboutus">
			<h4>About us</h4>
			<p>We are WWI. We are proud of our products and believe in the quality of it. In every house our products will feel like home. Despite our size, customers see us as small-scale and
concerned. Personal customer contact is our top priority.</p>
                <h4>Follow us on</h4>
                <ul class="social-icons">
                    <li><a href="https://nl-nl.facebook.com/login/" target="_blank" class="social-icon"> <i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://twitter.com/login?lang=nl" target="_blank" class="social-icon"> <i class="fa fa-twitter"></i></a></li>
                    <li><a href="https://accounts.google.com/ServiceLogin/identifier?hl=nl&passive=true&continue=https%3A%2F%2Fwww.google.nl%2Fsearch%3Fq%3Dyoutube%26rlz%3D1C1EJFA_enNL788NL795%26oq%3Dyoutub%26aqs%3Dchrome.0.0j69i60l2j69i57j69i60l2.2576j1j9%26sourceid%3Dchrome%26ie%3DUTF-8&flowName=GlifWebSignIn&flowEntry=AddSession" target="_blank" class="social-icon"> <i class="fa fa-youtube"></i></a></li>
                    <li><a href="https://www.linkedin.com/uas/login" target="_blank" class="social-icon"> <i class="fa fa-linkedin"></i></a></li>
                    <li><a href="https://accounts.google.com/ServiceLogin/identifier?elo=1&flowName=GlifWebSignIn&flowEntry=AddSession" target="_blank" class="social-icon"> <i class="fa fa-google-plus"></i></a></li>
                </ul>
            </div>
		<div id="contact-info">
			<h4>Contact Info</h4>
		 <p> Wide World Importers</p>
		 <p> Campus 2-6</p>
		 <p> 8017 CA</p>
		 <p> Zwolle</p>
		 <br>
		 <p>Phone: 038-123456</p>
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
        title: 'WideWorldImporters',
        description: 'Temporary adress',
        // one can customize markers by adding simplestyle properties
        // https://www.mapbox.com/guides/an-open-platform/#simplestyle
        'marker-size': 'large',
        'marker-color': '#dc3545'
    }
}).addTo(map);
</script>