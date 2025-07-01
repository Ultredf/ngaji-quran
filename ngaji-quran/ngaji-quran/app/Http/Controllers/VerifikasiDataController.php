<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerifikasiDataController extends Controller
{
    public function index()
    {
        $users = User::where('cv', '!=', null)->get();

        return view('dashboard.data-verifikasi.index', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Berhasil!');
    }
}
