@extends('layouts.adminLayout.admin_desing')

@section('app_css')

        <!-- DataTables -->
        <link href="{{ asset('/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="{{ asset('/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="page-title-box">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">Data HosPot</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-right">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                <li class="breadcrumb-item active">Data HosPot</li>
            </ol>
        </div>
    </div>
    <!-- end row -->
</div>

@include('layouts.adminLayout.admin_messages')



<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">

                <div class="col">
                    <h4 class="mt-0 header-title mb-3">Tabel Data HosPot</h4>
                    <a type="button" href="{{ url('administrator/hospot-add') }}" class="btn mb-4 btn-primary waves-effect waves-light">Tambah Data</a>
                    <a type="button" href="{{ url('administrator/hospot-view-maps') }}" class="btn mb-4 btn-primary waves-effect waves-light">Lihat Maps</a>
                </div>

                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>lokasi</th>
                        <th>Nama Kecamatan</th>
                        <th>lat</th>
                        <th>lng</th>
                        <th>tanggal</th>
                        <th>keterangan</th>
                        <th>marker</th>
                        <th>Created By</th>
                        <th>Acction</th>
                    </tr>
                    </thead>


                    <tbody>
                    @if(count($hospots) > 0)
                    @foreach($hospots as $hospot)
                    <tr>
                        <td>{{ $hospot->lokasi }}</td>
                        <td>{{ $hospot->kecamatan->nama_kecamatan }}</td>
                        <td>{{ $hospot->lat }}</td>
                        <td>{{ $hospot->lng }}</td>
                        <td>{{ $hospot->tanggal }}</td>
                        <td>{{ $hospot->keterangan }}</td>
                        <td>
                            <img width="30px" src="{{ asset('assets/unggahan/marker/'.$hospot->marker) }}" alt="">
                        </td>
                        <td>{{ $hospot->user->name }}</td>
                        {{-- <td>{{ $hospot->user->name  }}</td> --}}
                        <td>
                            <a class="btn btn-success" href="{{ url('administrator/hospot-edit/'.$hospot->id) }}" role="button">Ubah</a>
                            <form method="POST" class="d-inline" onsubmit="return confirm('Yakin dihapus?')"
                                action="{{ url('administrator/hospot-del/'.$hospot->id) }}">
                                @csrf
                                <input type="hidden" value="DELETE" name="_method">
                                <input type="submit" value="Hapus" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <span class="badge badge-danger mb-4">Tidak Ada Data</span>
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


@section('app_js')

 <!-- Required datatable js -->
 <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
 <script src="{{ asset('/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
 <!-- Buttons examples -->
 <script src="{{ asset('/plugins/datatables/dataTables.buttons.min.js') }}"></script>
 <script src="{{ asset('/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
 <script src="{{ asset('/plugins/datatables/jszip.min.js') }}"></script>
 <script src="{{ asset('/plugins/datatables/pdfmake.min.js') }}"></script>
 <script src="{{ asset('/plugins/datatables/vfs_fonts.js') }}"></script>
 <script src="{{ asset('/plugins/datatables/buttons.html5.min.js') }}"></script>
 <script src="{{ asset('/plugins/datatables/buttons.print.min.js') }}"></script>
 <script src="{{ asset('/plugins/datatables/buttons.colVis.min.js') }}"></script>
 <!-- Responsive examples -->
 <script src="{{ asset('/plugins/datatables/dataTables.responsive.min.js') }}"></script>
 <script src="{{ asset('/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

 <!-- Datatable init js -->
 <script src="{{ asset('assets/pages/datatables.init.js') }}"></script>

@endsection

@endsection


