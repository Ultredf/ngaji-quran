<?php

namespace App\Http\Controllers;

use App\Models\AyatTerakhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SurahController extends Controller
{
    public function index($id)
    {
        $response = Http::get('https://api.quran.gading.dev/surah/' . $id);
        if ($response->successful()) {
            $surah = $response->json();
        } else {
            $surah = [];
        }

        if (Auth::check()) {
            $ayat_terakhir_user = AyatTerakhir::where('id_user', Auth::user()->id)
                ->select(DB::raw("TRIM(CONCAT(ayat_terakhir, nama_surah)) as combined"))
                ->pluck('combined')
                ->toArray();
        } else {
            $ayat_terakhir_user = [];
        }

        if (Auth::check()) {
        $id_hapus_ayat = AyatTerakhir::where('id_user', Auth::user()->id)->get();
        } else {
            $id_hapus_ayat = [];
        }

        return view('pages.surah.index', compact('surah', 'ayat_terakhir_user', 'id_hapus_ayat'));
    }




    public function save(Request $request)
    {
        AyatTerakhir::create([
            'id_user' => Auth::user()->id,
            'id_surah' => $request->id_surah,
            'nama_surah' => $request->nama_surah,
            'ayat_terakhir' => $request->ayat_terakhir,
        ]);

        return redirect()->back();
    }


    public function delete($id, $id_ayat)
    {
        $ayat_terakhir = AyatTerakhir::where('id_surah', $id)
            ->where('ayat_terakhir', $id_ayat)
            ->where('id_user', Auth::user()->id)
            ->first();

        if ($ayat_terakhir) {
            $ayat_terakhir->delete();
        }

        return redirect()->back();
    }
}
