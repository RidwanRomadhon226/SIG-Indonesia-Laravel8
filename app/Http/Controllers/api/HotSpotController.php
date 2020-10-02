<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Hotspot;
use App\Models\kecamatan;
use Illuminate\Http\Request;

class HotSpotController extends Controller
{
    public function viewHotspotPoint()
    {
        $hotspot = Hotspot::get();
        // $response = [];

        foreach ($hotspot as $row) {
            $data = [];
            $data['type'] = "Feature";
            $data['properties'] = [
                "name" => $row->lokasi,
                "lokasi" => $row->lokasi,
                "icon" => ($row->marker == '') ? asset('assets/unggahan/marker/20201002212324-assets_icons_fire.png') : asset('assets/unggahan/marker/' . $row->marker),
                "popUp" => "Lokasi : " . $row->lokasi . ", Kec. <br>Keterangan : " . $row->keterangan . "<br>Tanggal : " . $row->tanggal
            ];
            $data['geometry'] = [
                "type" => "Point",
                "coordinates" => [$row->lng, $row->lat]
            ];
            $response[] = $data;
        };

        return "var geojsonPoint =" . json_encode($response, JSON_PRETTY_PRINT);
    }
}
