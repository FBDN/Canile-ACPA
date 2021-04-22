<!doctype html>
<head>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
</head>
<body>
<div class="dogContainerWrapper" id="map_canvas" style="width:1024px;height:768px;margin:0px auto">

</div>

<script>
function initialize2() {
	var bounds = new google.maps.LatLngBounds();
    geocoder = new google.maps.Geocoder();
    var mapOptions = {
        zoom: 12,
        center: new google.maps.LatLng(44.139841, 12.245881),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('map_canvas'),
        mapOptions);
    //var circleOptions = {
    //    strokeColor: '#0000FF',
    //    strokeOpacity: 0.8,
    //    strokeWeight: 2,
    //    fillColor: '#0000FF',
    //    fillOpacity: 0.35,
    //    map: map,
    //    center: mapOptions.center,
    //    radius:10000
    //};
    //Circle = new google.maps.Circle(circleOptions);
<?php
include '../facebook/config.php';

	$query = "SELECT * FROM cani";
	$res = mysql_query($query);
	while($perso = mysql_fetch_object($res)){
?>
	var address = "<?= $perso->indirizzo?>";
    var nome = "<?= $perso->nome?>";
    var taglia = "<?= $perso->taglia?>";
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
           /* map.setCenter(results[0].geometry.location);*/
		   var position = results[0].geometry.location;
		   bounds.extend(position);
            var marker = new google.maps.Marker({
                map: map,
                position: position
            });
			
            var contentString = '<div id="content">' +
            '<div id="siteNotice">' +
            '</div>' +
            '<h1 id="firstHeading" class="firstHeading"><?= $perso->nome?></h1>' +
            '<div id="bodyContent">' +
            'cane di taglia <?= $perso->taglia?><br >'+
            'E\' stato perso in <?= mysql_real_escape_string($perso->indirizzo)?>'+
            '</div>' +
			'<div id="dogImage"><img src="img/dogImage.jpg"><a href="/canipersi.php" target="_blank">Vai alla Pagina dei Cani Smarriti</a></div>'+
            '</div>';
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            google.maps.event.addListener(marker, 'mouseover', function () {
                infowindow.open(map, marker);
            });
			map.fitBounds(bounds);
        } 
    });
   <?php } ?>
}
google.maps.event.addDomListener(window, 'load', initialize2);

 

</script>
</body>
</html>