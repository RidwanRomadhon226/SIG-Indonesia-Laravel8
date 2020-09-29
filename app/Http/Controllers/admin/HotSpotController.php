<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Hotspot;
use App\Models\kecamatan;
use Illuminate\Http\Request;

class HotSpotController extends Controller
{
    public function viewHotspot()
    {
        $hospots = Hotspot::get();

        return view('admin.hotspot.view_hotspot')->with(compact('hospots'));
    }

    public function addHotspot(Request $request)
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
                'lokasi' => 'required',
                'kecamatan' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'tanggal' => 'required|date',
                'keterangan' => 'required',
                'marker' => 'required|image|max:999|mimes:png,svg,icon',
            ]);

            $hospot = new Hotspot;
            $hospot->lokasi = $data['lokasi'];
            $hospot->kecamatan_id = $data['kecamatan'];
            $hospot->lat = $data['lat'];
            $hospot->lng = $data['lng'];
            $hospot->keterangan = $data['keterangan'];
            $hospot->tanggal = $data['tanggal'];
            $hospot->user_id = auth()->user()->id;

            if ($request->hasFile('marker')) {
                $file_tmp = $request->file('marker');
                $destinationPath = 'assets/unggahan/marker/'; // upload path
                $profilefile = date('YmdHis') . "-" . $file_tmp->getClientOriginalName();
                $file_tmp->move($destinationPath, $profilefile);
                $hospot->marker = $profilefile;
            }


            $hospot->save();
            return redirect('administrator/hospot-view')->with('flash_message_success', 'Berhasi Input Data HotPot');
        }


        $kecamatans = kecamatan::get();

        return view('admin.hotspot.add_hospot')->with(compact('kecamatans'));
    }


    public function editHotspot(Request $request, $id = null)
    {
        $hotspot = Hotspot::find($id);

        if (auth()->user()->id != $hotspot->user_id) {
            return redirect()->back()->with('flash_message_error', 'Anda Tidak Bisa Mengedit Data ini');
        }


        if ($request->isMethod('post')) {
            $data = $request->all();


            $this->validate($request, [
                'lokasi' => 'required',
                'kecamatan' => 'required',
                'lat' => 'required',
                'lng' => 'required',
                'tanggal' => 'required|date',
                'keterangan' => 'required',
                'current_marker' => 'required',
            ]);



            if ($request->hasFile('marker')) {
                $file_tmp = $request->file('marker');
                $destinationPath = 'assets/unggahan/marker/'; // upload path
                $profilefile = date('YmdHis') . "-" . $file_tmp->getClientOriginalName();
                $file_tmp->move($destinationPath, $profilefile);
                $hotspot->marker = $profilefile;
            } else {
                $profilefile = $data['current_marker'];
            }

            Hotspot::where(['id' => $id])->update([
                'lokasi' => $data['lokasi'],
                'kecamatan_id' => $data['kecamatan'],
                'lat' => $data['lat'],
                'lng' => $data['lng'],
                'tanggal' => $data['tanggal'],
                'keterangan' => $data['keterangan'],
                'marker' => $profilefile,
            ]);
            return redirect('administrator/hospot-view')->with('flash_message_success', 'Berhasi Edit Data HotSpot');
        }


        $kecamatans = kecamatan::get();
        return view('admin.hotspot.edit_hotspot')->with(compact('hotspot', 'kecamatans'));
    }



    public function delHotspot($id)
    {
        $hotspot = Hotspot::findOrFail($id);
        $hotspot->delete();
        return redirect('administrator/hospot-view')->with('flash_message_success', 'Berhasi Hapus Data HosPot');
    }
}
