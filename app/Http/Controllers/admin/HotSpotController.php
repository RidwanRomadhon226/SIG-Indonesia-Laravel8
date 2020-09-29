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

    public function addHotspot()
    {
        $kecamatans = kecamatan::get();

        return view('admin.hotspot.add_hospot')->with(compact('kecamatans'));
    }
}
