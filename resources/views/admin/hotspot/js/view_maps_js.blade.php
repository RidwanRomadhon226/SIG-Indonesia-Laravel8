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
<script src="{{ url('/api/hospot-point-api') }}"></script>

<script type="text/javascript">

    // console.log(kecamatans);

    var map = L.map('map').setView([-4.446407, 114.163619], 5);
    var layersKecamatan=[];
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
 function getColorKecamatan(KODE){
    for(i=0;i<dataKecamatan.length;i++){
      var data=dataKecamatan[i];
      if(data.kd_kecamatan==KODE){
        return data.warna_kecamatan;
      }
    }
  }


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

 ];


 for(i=0;i<dataKecamatan.length;i++){
    var data=dataKecamatan[i];
    //  console.log(data);
     layer = {
      name: data.nama_kecamatan,
      icon: iconByName(data.warna_kecamatan),
      layer: new L.GeoJSON.AJAX(["/assets/geojson/"+data.geojson_kecamatan],
      {
          onEachFeature:popUp,
          style: function(feature){
            var KODE=feature.properties.KODE;
            return {
              "color": getColorKecamatan(KODE),
                "weight": 1,
                "opacity": 1
            }

          },}).addTo(map)
      }
      layersKecamatan.push(layer);
    }

    //HotSpot
    var layersHotspotPoint = L.geoJSON(geojsonPoint, {
      pointToLayer: function (feature, latlng) {
        console.log(feature)
          return L.marker(latlng, {
            icon : new L.icon({iconUrl: feature.properties.icon,
            iconSize: [38,45],
            })
          });
      },
      onEachFeature: function(feature,layer){
         if (feature.properties && feature.properties.name) {
            layer.bindPopup(feature.properties.popUp);
        }
      }
  }).addTo(map);


    var overLayers = [{
    group: "Layer Kecamatan",
    layers: layersKecamatan
  },
  {
    group: "Titik Hostpot",
    layers: [{
      name: "Semua Titik",
      icon: iconByName("#009"),
      layer: layersHotspotPoint
      }]
  }
  ];


 var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers,{
     collapsibleGroups: true
 });

 map.addControl(panelLayers);



</script>
