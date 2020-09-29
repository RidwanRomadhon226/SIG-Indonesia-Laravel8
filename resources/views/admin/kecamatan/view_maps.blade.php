@extends('layouts.adminLayout.admin_desing')

@section('app_css')


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>
  <link rel="stylesheet" href="{{ asset('assets/leflet/js/leaflet-panel-layers-master/src/leaflet-panel-layers.css') }}" />
  <style type="text/css">
    #map { height: 100vh; }
    .icon {
  display: inline-block;
  margin: 2px;
  height: 16px;
  width: 16px;
  background-color: #ccc;
  }
  .icon-bar {
    background: url('assets/leflet/js/leaflet-panel-layers-master/examples/images/icons/bar.png') center center no-repeat;
}
</style>

@endsection


@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Maps Kecamatan</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('administrator/kecamatan-view') }}">Data Kecamatan</a></li>
                <li class="breadcrumb-item active">Maps Kecamatan</li>
            </ol>
        </div>
    </div>
    <!-- end row -->
</div>


@include('layouts.adminLayout.admin_messages')


<div class="row">
    <div class="col-xl-12">
        <div class="card m-b-30">
            <div class="card-body">
    <div id="map"></div>

            </div>
        </div>
    </div>
</div>



@endsection



@section('app_js')
@include('admin.mapsStandar.js.mapsJs')

@endsection
