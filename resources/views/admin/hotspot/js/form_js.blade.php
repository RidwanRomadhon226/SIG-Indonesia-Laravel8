@php
    use App\Models\kecamatan;
@endphp

{{-- <link rel="stylesheet" href="{{ asset('assets/leflet/js/leaflet-compass-master/src/leaflet-compass.css') }}" />


 --}}

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
crossorigin=""></script>



 <!-- Load Esri Leaflet from CDN -->
 <script src="https://unpkg.com/esri-leaflet@2.5.0/dist/esri-leaflet.js"
 integrity="sha512-ucw7Grpc+iEQZa711gcjgMBnmd9qju1CICsRaryvX7HJklK0pGl/prxKvtHwpgm5ZHdvAil7YPxI1oWPOWK3UQ=="
 crossorigin=""></script>

 <!-- Load Esri Leaflet Geocoder from CDN -->
 <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.css"
 integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
 crossorigin="">
<script src="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.js"
 integrity="sha512-HrFUyCEtIpxZloTgEKKMq4RFYhxjJkCiF5sDxuAokklOeZ68U2NPfh4MFtyIVWlsKtVbK5GD2/JzFyAfvT5ejA=="
 crossorigin=""></script>

{{-- <script src="{{ asset('assets/leflet/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/leflet/js/leaflet.ajax.js') }}"></script> --}}
{{-- <script src=" {{ asset('assets/js/leaflet-compass-master/src/leaflet-compass.js') }}"></script> --}}
{{-- <script src=" {{ asset('assets/js/Leaflet.GoogleMutant.js') }}"></script> --}}


<script type="text/javascript">

    var latinput = document.querySelector("[name=lat]");
    var lnginput = document.querySelector("[name=lng]");
    var lokasiinput = document.querySelector("[name=lokasi]");
    var kecamataninput = document.querySelector("[name=kecamatan]");

    var marker;


    var map = L.map('map').setView([-1.401666, 113.443656], 7);
    var geocodeService = L.esri.Geocoding.geocodeService();

    var Layer=L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
 attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
 maxZoom: 18,
 id: 'mapbox.streets',
 accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
});
 map.addLayer(Layer);


 map.on("click", function(e){
     var lat=e.latlng.lat;
     var lng=e.latlng.lng;

     if (!marker) {
        marker = L.marker(e.latlng).addTo(map);
     } else {
        marker.setLatLng(e.latlng);
     }


     latinput.value = lat;
     lnginput.value = lng;


     $.ajax({
         url:"https://nominatim.openstreetmap.org/reverse",
         data: "lat="+lat+
                "&lon="+lng+
                "&format=json",
        dataType: "JSON",
        success:function(data){
            // console.log(data);
            lokasiinput.value = data.display_name;
        }
     })


     geocodeService.reverse().latlng(e.latlng).run(function (error, result) {
      if (error) {
        return;
      }
    //   console.log(result);

      var district = result.address.District;
      kecamataninput.selectedIndex = 0;
      for(i=0;i<kecamataninput.options.length;i++) {
        //   console.log(kecamataninput.options[i].text);
        if (kecamataninput.options[i].text == district) {
            kecamataninput.selectedIndex = i;
            break;
        }
      }


    });
 });


</script>
