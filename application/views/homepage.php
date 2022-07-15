<!-- Proses -->
<!-- 1. Google map memanggil function initialize
2. Di dalam function initialize manggil dengan ajax home/loadkoordinat yang berada di dalam file application/controllers/home.php 
3. setelah dapat data jembatan, koordinat jembatan dan jalan
4. kemudian buat marker jembatan
5. kemudian buat polyline jalan -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJGxbuldQVV1qodn-Ge3uSqoe7rWRg8vk&callback=initialize"
    async defer></script>
<script>
	var poly;
	var map;
	var markers = [];
	function initialize() {
		var mapOptions = {
		zoom: 14,
		// Center di kantor kecamatan jekulo
		center: new google.maps.LatLng(-6.806428778495534, 110.84213197231293)
		};

		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

		infowindow = new google.maps.InfoWindow();
		// Mengambil data jembatan, koordinat jembatan, dan data jalan
		$.ajax({
		  	url : '<?php echo site_url("home/loadkoordinat") ?>',
		  	// data : datakoordinat,
		  	dataType : 'json',
		  	type : 'POST',
		  	success : function(data,status){
		  		if (data.status!='error') {
					//buat marker
					$.each(data.content.itemkoordinatjembatan, function(k,v){
						$.each(data.content.itemdatajembatan, function(p,r) {
							if (r['id_jembatan'] == v['id_jembatan']) {
								var myLatLng = {lat: parseFloat(v["latitude"]), lng: parseFloat(v["longitude"])};
								addMarker(r['namajembatan'], r['keterangan'],myLatLng);
								console.log('bikin marker');
							}
						})
					})
					//buat marker end
					//buat polyline jalan
					$.each(data.content.itemdatajalan, function(k,v) {
						addpolylinedatajalan(v['id_jalan'], v['namajalan'], v['keterangan']);
					})
					//buat polyline jalan end
		  		}else{
					console.log(data.msg);
		  		}
		  	}
		})
		// Mengambil data jembatan, koordinat jembatan, dan data jalan
	}

	function addMarker(nama, keterangan,location) {
		var marker = new google.maps.Marker({
			position: location,
			map: map,
			title : nama
		});
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<h4 id="firstHeading" class="firstHeading">'+nama+'</h4>'+
			'<div id="bodyContent">'+
			'<p>'+keterangan+'</p>'+
			'</div>'+
			'</div>';

		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		marker.addListener('click', function() {
			infowindow.open(map, marker);
		})
		markers.push(marker);
	}

	function addpolylinedatajalan(id, nama, keterangan){
		var datakoordinat = {'id':id};
		var listkoordinat = [];
		$.ajax({
			url : '<?php echo site_url("home/loadkoordinatjalan") ?>',
			data : datakoordinat,
			dataType : 'json',
			type : 'POST',
			success : function(data,status){
				if (data.status!='error') {
					//load polyline
					$.each(data.content.itemkoordinatjalan, function(k,v) {
						listkoordinat.push(new google.maps.LatLng(parseFloat(v['latitude']), parseFloat(v['longitude'])));
					})
					var pathKoordinat = new google.maps.Polyline({
						path: listkoordinat,
						geodesic: true,
						strokeOpacity: 1.0,
					});

					pathKoordinat.setMap(map);
					//info window polyline
					createInfoWindowPolyline(pathKoordinat, nama, keterangan);
					//end load polyline
				}else{
					alert(data.msg);
				}
			}
		})	
	}

	function createInfoWindowPolyline(poly, nama, keterangan) {
    
		google.maps.event.addListener(poly, 'click', function(event) {
			//infowindow
			var contentString = '<div id="content">'+
				'<div id="siteNotice">'+
				'</div>'+
				'<h4 id="firstHeading" class="firstHeading">'+nama+'</h4>'+
				'<div id="bodyContent">'+
				'<p>'+keterangan+'</p>'+
				'</div>'+
				'</div>';
			infowindow.setContent(contentString);
			infowindow.setPosition(event.latLng);
			infowindow.open(map);
		});
	}

	// google.maps.event.addDomListener(window, 'load', initialize);
</script>
<!--end script google map-->
<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="panel panel-primary">
				<div class="panel-heading"><span class="glyphicon glyphicon-globe"></span> Peta</div>
				<div class="panel-body" style="height:400px;" id="map-canvas">					
				</div>
			</div>
		</div>
	</div>
</div>