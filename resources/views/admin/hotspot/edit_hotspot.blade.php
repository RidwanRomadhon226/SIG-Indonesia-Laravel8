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
        <!-- Plugins css -->
        <link href=" {{ asset('/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
        <link href=" {{ asset('/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <link href=" {{ asset('/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Tambah Data  HotSpot</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('administrator/hospot-view') }}">Data  hostpot</a></li>
                <li class="breadcrumb-item active">Add HotSpot</li>
            </ol>
        </div>
    </div>
    <!-- end row -->
</div>

@include('layouts.adminLayout.admin_messages')

<div class="row">

<div class="col-lg-6">
    <div class="card m-b-30">
        <div class="card-body">

            <h4 class="mt-0 header-title mb-4">Lengkapi Data HotSpot</h4>


            <form method="post" action="{{ url('administrator/hospot-edit/'.$hotspot->id) }}" enctype="multipart/form-data" > @csrf
                <div class="form-group">
                    <label>lokasi</label>
                    <input type="text" value="{{ $hotspot->lokasi }}" name="lokasi" class="form-control" required placeholder="Lokasi HotSpot"/>
                </div>
                <div class="form-group ">
                    <label>Pilih Kecamatan</label>
                        <select class="form-control" name="kecamatan" required>
                            <option value="">Select</option>
                            @foreach ($kecamatans as $kecamatan)
                            <option @if ($kecamatan->id == $hotspot->kecamatan_id) selected @endif value="{{ $kecamatan->id }}" >{{ $kecamatan->nama_kecamatan }}</option>
                            @endforeach
                        </select>

                </div>

                <div class="form-group">
                    <label class="col-form-label">Pilih Kecamatan</label>
                    <div class="col-sm-12 row">
                        <input type="text" name="lat" value="{{ $hotspot->lat }}" class=" mr-2 col-sm-5 form-control" required placeholder="lat"/>
                        <input type="text" name="lng" value="{{ $hotspot->lng }}" class=" col-sm-5 form-control" required placeholder="lng"/>
                    </div>
                    <span> Akan terisi Otomatis Ketika Memilih Titik </span>
                </div>
                <div class="form-group">
                    <label>Tanggal</label>
                    <div>
                        <div class="input-group">
                            <input type="text" name="tanggal" value="{{ $hotspot->tanggal }}" class="form-control" required placeholder="yyyy-mm-dd" id="datepicker-autoclose">
                            <div class="input-group-append bg-custom b-0"><span class="input-group-text"><i class="mdi mdi-calendar"></i></span></div>
                        </div><!-- input-group -->
                    </div>
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <div>
                        <textarea required class="form-control" name="keterangan" rows="5">{{ $hotspot->keterangan }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label>Icons Marker</label>
                    <input type="hidden"  name="current_marker" value="{{ $hotspot->marker }}" class="col-sm-5 form-control" placeholder="marker"/> ||
                    <input type="file"  name="marker" class="col-sm-5 form-control"  placeholder="marker"/> ||
                    @if (!empty($hotspot->marker))
                    <img width="30px" src="{{ asset('assets/unggahan/marker/'.$hotspot->marker) }}" alt="">
                    @endif
                </div>

                <div class="form-group">
                    <div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Cancel
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>


</div> <!-- end col -->

<div class="col-lg-6">
    <div class="card m-b-30">
        <div class="card-body">
            <h4 class="mt-0 header-title mb-4">Silahkan Pilih Titik</h4>

            <div id="map" style="height: 500px"></div>
        </div>
    </div>
</div> <!-- end col -->

</div>
@section('app_js')

 <!-- Plugins js -->
 <script src="{{ asset('/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
 <script src="{{ asset('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
 <script src="{{ asset('/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
 <script src="{{ asset('/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>

 <!-- Plugins Init js -->
 <script src=" {{ asset('assets/pages/form-advanced.js') }}"></script>

<!-- Parsley js -->
<script src="{{ asset('/plugins/parsleyjs/parsley.min.js') }}"></script>

 <script>
    $(document).ready(function() {
        $('form').parsley();
    });
</script>

@include('admin.hotspot.js.form_js')

@endsection

@endsection


