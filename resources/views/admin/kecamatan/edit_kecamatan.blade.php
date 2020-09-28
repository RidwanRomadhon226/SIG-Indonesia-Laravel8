@extends('layouts.adminLayout.admin_desing')

@section('app_css')

        <!-- Plugins css -->
        <link href=" {{ asset('/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
        <link href=" {{ asset('/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <link href=" {{ asset('/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Tambah Data  Kecamatan</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('administrator/kecamatan-view') }}">Data  Kecamatan</a></li>
                <li class="breadcrumb-item active">Kecamatan</li>
            </ol>
        </div>
    </div>
    <!-- end row -->
</div>

@include('layouts.adminLayout.admin_messages')



<div class="col-lg-6">
    <div class="card m-b-30">
        <div class="card-body">

            <h4 class="mt-0 header-title mb-4">Lengkapi Data Kecamatan</h4>


            <form method="post" action="{{ url('administrator/kecamatan-edit/'.$kecamatan->id) }}" enctype="multipart/form-data" > @csrf
                <div class="form-group">
                    <label>Kode Kecamatan</label>
                    <input type="text" name="kd_kecamatan" value="{{ $kecamatan->kd_kecamatan }}" class="form-control" required placeholder="Kode Kecamatan"/>
                </div>
                <div class="form-group">
                    <label>Nama Kecamatan</label>
                    <input type="text" name="nama_kecamatan" value="{{ $kecamatan->nama_kecamatan }}"  class="form-control" required placeholder="Nama Kecamatan"/>
                </div>
                <div class="form-group">
                    <label>Geojson Kecamatan</label>
                    <input type="file" name="geojson_kecamatan"  class="form-control" placeholder="Input GroJSON Kecamatan"/>
                    <input type="hidden" name="current_geojson_kecamatan" value="{{ $kecamatan->geojson_kecamatan }}"  class="form-control" required placeholder="Input GroJSON Kecamatan"/>
                    @if (!empty($kecamatan->geojson_kecamatan))
                        <span class="mt-1">{{ $kecamatan->geojson_kecamatan }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Input Warna Poligon</label>
                    <input type="text" name="warna_kecamatan" value="{{ $kecamatan->warna_kecamatan }}"  class="colorpicker-default form-control" required placeholder="Pilih Warna">

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

@endsection

@endsection


