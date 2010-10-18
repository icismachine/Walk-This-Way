<html lang="en" manifest="geometer.manifest"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Geo Meter</title>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="format-detection" content="telephone=no" />
<link rel="apple-touch-startup-image" href="splashscreen.png" />
<link rel="stylesheet" href="styles.css" media="screen"/>
<link rel="Shortcut Icon" type="image/ico" href="http://miniapps.co.uk/favicon.ico" />
<link rel="apple-touch-icon" href="iOS-114.png" /> 
<script type="text/javascript" src="main.js"></script>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-6471139-3']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script');
ga.src = ('https:' == document.location.protocol ?
    'https://ssl' : 'http://www') +
    '.google-analytics.com/ga.js';
ga.setAttribute('async', 'true');
document.documentElement.firstChild.appendChild(ga);
})();
</script>
</head>
<body>
<section>

<header>
	<button type="button" id="map">Map</button>
	<button type="button" id="mail">Mail</button>
	<h1>Geo Meter</h1>  
</header> 
    
<ul id="maillist">
    <li class="empty"><a href="" id="maillink">Mail location info</a></li>
</ul>

<ul>
	<li>
		<dl>
			<dt>Latitude:</dt>
			<dd id="latitude">Calculating</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>Longitude:</dt>
			<dd id="longitude">Calculating</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>Accuracy:</dt>
			<dd id="accuracy">Calculating</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>Altitude:</dt>
			<dd id="altitude">Calculating</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>Alt accuracy:</dt>
			<dd id="altitudeAccuracy">Calculating</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>Speed:</dt>
			<dd id="speed">Calculating</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>Heading:</dt>
			<dd id="heading">Calculating</dd>
		</dl>
	</li>
	<li>
		<dl>
			<dt>Timestamp:</dt>
			<dd id="timestamp">Calculating</dd>
		</dl>
	</li>
</ul>
</section>
</body>
</html>

