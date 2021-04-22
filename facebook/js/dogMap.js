var geocoder;
var map;
function initialize() {
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
    
}
google.maps.event.addDomListener(window, 'load', initialize);

function codeAddress() {
    var address = document.getElementById("via").value;
    var nome = document.getElementById("nome").value;
    var index = document.cani_form.combo.selectedIndex;
    var taglia = document.cani_form.combo.options[index].value;
    geocoder.geocode({ 'address': address }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
			var formatted_address = results[0]['formatted_address'];
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
            var contentString = '<div id="content">' +
            '<div id="siteNotice">' +
            '</div>' +
            '<h1 id="firstHeading" class="firstHeading">'+nome+'</h1>' +
            '<div id="bodyContent">' +
            'cane di taglia '+ taglia +'<br >'+
            'E\' stato perso in '+address+
            '</div>' +
			'<div id="dogImage"><img src="img/dogImage.jpg"></div>'+
            '</div>';
            var infowindow = new google.maps.InfoWindow({
                content: contentString
            });
            google.maps.event.addListener(marker, 'mouseover', function () {
                infowindow.open(map, marker);
            });
			google.maps.event.addListener(marker, 'mouseout', function () {
                infowindow.close(map, marker);
            });
			$.ajax({
				type:'post',
				url:'sendDog.php',
				data:'nome='+nome+'&taglia='+taglia+'&indirizzo='+formatted_address,
				success: function(data){
					$("#result_form").html(data);
					}
				});
        } else {
            alert("Non &egrave; stato possibile ricavare l'indirizzo per la seguente ragione: " + status);
        }
    });
}