<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VerifikasiController extends Controller
{
    public function index()
    {
        $sosmed = DB::table('users')
            ->join('sosial_medias', 'users.id', '=', 'sosial_medias.id_user')
            ->where('users.id', Auth::user()->id)
            ->first();

        return view('dashboard.verifikasi.index', compact('sosmed'));
    }

    public function upgrade(Request $request)
    {
        $request->validate([
            'cv' => ['required', 'mimes:pdf', 'max:2048'],
        ]);

        if ($request->hasFile('cv')) {
            $file = $request->file('cv');

            if ($file) {
                $fileName = Str::random(80) . '.' . $file->getClientOriginalExtension();
                $filePath = 'assets/cv/' . $fileName;

                $file->move(public_path('assets/cv/'), $fileName);
            } else {
                return back()->with('error', 'File upload failed');
            }
        } else {
            $cv = User::where('id', Auth::user()->id)->first();
            $filePath = $cv->profil;;
        }

        $user = User::where('id', Auth::user()->id)->first();
        $user->update([
            'cv' => $filePath,
            'status' => 'pending',
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Berhasil Request Verifikasi Akun');
    }
}
