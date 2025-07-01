<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SunnatullahController extends Controller
{
    public function index()
    {
        $response = Http::get('https://doa-doa-api-ahmadramadhan.fly.dev/api');
        if ($response->successful()) {
            $datas = $response->json();
        } else {
            $datas = [];
        }

        return view('pages.sunnatullah.index', compact('datas'));
    }

    public function detail($id)
    {
        $response = Http::get('https://doa-doa-api-ahmadramadhan.fly.dev/api/' . $id);
        if ($response->successful()) {
            $data = $response->json();
        } else {
            $data = [];
        }

        // Since the response is an array with a single element, access the first element
        $data = $data[0] ?? []; // Use null coalescing operator to handle empty array

        return view('pages.sunnatullah.detail', compact('data'));
    }
}
