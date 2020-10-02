<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\kecamatan;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function viewHotspot()
    {
        $response = [];
        $kecamatans = kecamatan::get();
        $response = $kecamatans;
        return "var dataKecamatan =" . json_encode($response, JSON_PRETTY_PRINT);
    }
}
