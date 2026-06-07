<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataHarianController extends Controller
{
    public function store(Request $request)
    {
        // ambil data dari form
        $data = $request->all();

        // sementara cek dulu (debug)
        dd($data);
    }
}