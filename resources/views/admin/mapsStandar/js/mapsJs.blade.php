@php
    use App\Models\kecamatan;
@endphp

<link rel="stylesheet" href="{{ asset('assets/leflet/js/leaflet-compass-master/src/leaflet-compass.css') }}" />

<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
crossorigin=""></script>

<script src="{{ asset('assets/leflet/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js') }}"></script>
<script src="{{ asset('assets/leflet/js/leaflet.ajax.js') }}"></script>
{{-- <script src=" {{ asset('assets/js/leaflet-compass-master/src/leaflet-compass.js') }}"></script> --}}
{{-- <script src=" {{ asset('assets/js/Leaflet.GoogleMutant.js') }}"></script> --}}
<script src="{{ url('/api/hospot-view-api') }}"></script>


<script type="text/javascript">

    // console.log(kecamatans);

    var map = L.map('map').setView([-4.446407, 114.163619], 5);

    var Layer=L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
 attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
 maxZoom: 18,
 id: 'mapbox.streets',
 accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
});
 map.addLayer(Layer);

 var myStyle2 = {
     "color": "#ffff00",
     "weight": 1,
     "opacity": 0.9
 };

 function popUp(f,l){
     var out = [];
     if (f.properties){
         // for(key in f.properties){
         //   console.log(key);

         // }
         out.push("Provinsi: "+f.properties['PROVINSI']);
         out.push("Kecamatan: "+f.properties['KECAMATAN']);
         l.bindPopup(out.join("<br />"));
     }
 }

 // legend

 function iconByName(name) {
     return '<i class="icon" style="background-color:'+name+';border-radius:50%"></i>';
 }

 function featureToMarker(feature, latlng) {
     return L.marker(latlng, {
         icon: L.divIcon({
             className: 'marker-'+feature.properties.amenity,
             html: iconByName(feature.properties.amenity),
             iconUrl: '../images/markers/'+feature.properties.amenity+'.png',
             iconSize: [25, 41],
             iconAnchor: [12, 41],
             popupAnchor: [1, -34],
             shadowSize: [41, 41]
         })
     });
 }

 var baseLayers = [
     {
         name: "OpenStreetMap",
         layer: Layer
     },
    //  {
    //      name: "OpenCycleMap",
    //      layer: L.tileLayer('http://{s}.tile.opencyclemap.org/cycle/{z}/{x}/{y}.png')
    //  },
    //  {
    //      name: "Outdoors",
    //      layer: L.tileLayer('http://{s}.tile.thunderforest.com/outdoors/{z}/{x}/{y}.png')
    //  }
 ];


 <?php
    //  $arrayKec = 0;
    $kecamatans = kecamatan::get();
    foreach ($kecamatans as $row) {
      ?>

      var myStyle<?=$row->id?> = {
          "color": "<?=$row->warna_kecamatan?>",
          "weight": 1,
          "opacity": 1
      };

      <?php
      $arrayKec[]='{
      name: "'.$row->nama_kecamatan.'",
      icon: iconByName("'.$row->warna_kecamatan.'"),
      layer: new L.GeoJSON.AJAX(["/assets/geojson/'.$row->geojson_kecamatan.'"],{onEachFeature:popUp,style: myStyle'.$row->id.',pointToLayer: featureToMarker }).addTo(map)
      }';
    }
  ?>

  var overLayers = [{
    group: "Layer Kecamatan",
    layers: [
      <?=implode(',', $arrayKec);?>
    ]
  }
  ];



 var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers,{
     collapsibleGroups: true
 });

 map.addControl(panelLayers);



</script>
