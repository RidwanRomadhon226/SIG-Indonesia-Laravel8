<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KecamatanController extends Controller
{
    public function viewKecamatan()
    {
        $kecamatans = kecamatan::cursor();
        return view('admin.kecamatan.view_kecamatan')->with(compact('kecamatans'));
    }
    public function addKecamatan(Request $request)
    {

        $data = $request->all();
        if ($request->isMethod('post')) {
            // dd($data);
            // if (empty($data['status'])) {
            //   $status = 0;
            // } else {
            //     $status = 1;
            // }

            $this->validate($request, [
                'kd_kecamatan' => 'required|unique:kecamatans|max:255',
                'nama_kecamatan' => 'required',
                'warna_kecamatan' => 'required|unique:kecamatans|max:255',
                'geojson_kecamatan' => 'required|file|mimes:json',
            ]);

            $kecamatan = new kecamatan;
            $kecamatan->kd_kecamatan = $data['kd_kecamatan'];
            $kecamatan->nama_kecamatan = $data['nama_kecamatan'];
            $kecamatan->warna_kecamatan = $data['warna_kecamatan'];
            $kecamatan->user_id = auth()->user()->id;

            if ($request->hasFile('geojson_kecamatan')) {
                // $fileName = time() . '_' . $file_tmp->getClientOriginalName();
                // $path_save = 'assets/geojson/' . $fileName;
                // $kecamatan->move($path_save, $file_tmp->getClientOriginalName());
                // $kecamatan->geojson_kecamatan = $fileName;

                $file_tmp = $request->file('geojson_kecamatan');
                $destinationPath = 'assets/geojson/'; // upload path
                $profilefile = date('YmdHis') . "-" . $file_tmp->getClientOriginalName();
                $file_tmp->move($destinationPath, $profilefile);
                $kecamatan->geojson_kecamatan = $profilefile;
            }


            $kecamatan->save();
            return redirect('administrator/kecamatan-view')->with('flash_message_success', 'Berhasi Input Data GeoJson');
        }

        return view('admin.kecamatan.add_kecamatan');
    }

    public function editKecamatan(Request $request, $id = null)
    {

        $kecamatan = kecamatan::find($id);

        if (auth()->user()->id != $kecamatan->user_id) {
            return redirect('administrator/kecamatan-view')->with('flash_message_error', 'Anda Tidak Bisa Mengedit Data ini');
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            // $this->validate($request, [
            //     'kd_kecamatan' => ['required', 'unique:kecamatans,kd_kecamatan', 'max:255' . $id],
            //     'nama_kecamatan' => ['required'],
            //     'warna_kecamatan' => 'required|unique:kecamatans|max:255',
            // ]);

            $this->validate($request, [
                "kd_kecamatan" => 'required|unique:kecamatans,kd_kecamatan,' . $id,
                'nama_kecamatan' => ['required'],
                'warna_kecamatan' => 'required|unique:kecamatans,warna_kecamatan,' . $id,
            ]);

            // $kecamatanCount = kecamatan::where('kd_kecamatan', $data['kd_kecamatan'])->('kecamatan' )->count();
            // if ($kecamatanCount > 0) {
            //     return redirect()->back()->with('flash_message_error', 'Email Telah Terdaftar - Coba Dengan Email Lain');
            // }

            if ($request->hasFile('geojson_kecamatan')) {
                $file_tmp = $request->file('geojson_kecamatan');
                $destinationPath = 'assets/geojson/'; // upload path
                $profilefile = date('YmdHis') . "-" . $file_tmp->getClientOriginalName();
                $file_tmp->move($destinationPath, $profilefile);
                $kecamatan->geojson_kecamatan = $profilefile;
            } else {
                $profilefile = $data['current_geojson_kecamatan'];
            }

            kecamatan::where(['id' => $id])->update([
                'kd_kecamatan' => $data['kd_kecamatan'],
                'nama_kecamatan' => $data['nama_kecamatan'],
                'warna_kecamatan' => $data['warna_kecamatan'],
                'geojson_kecamatan' => $profilefile
            ]);
            return redirect('administrator/kecamatan-view')->with('flash_message_success', 'Berhasi Edit Data GeoJson');
        }

        return view('admin.kecamatan.edit_kecamatan')->with(compact('kecamatan'));
    }

    public function delKecamatan($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kecamatan->delete();
        return redirect('administrator/kecamatan-view')->with('flash_message_success', 'Berhasi Hapus Data GeoJson');
    }

    public function viewMapsKecamatan()
    {
        $kecamatans = kecamatan::query()->get();
        // $kecamatans = DB::ObjectBuilder()->get('kecamatans');
        return view('admin.kecamatan.view_maps')->with(compact('kecamatans'));
    }
}
