<?php

namespace App\Http\Controllers;

use App\Models\ForkomDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ForkomDetailController extends Controller
{
    public function index($id)
    {
        $user_forkom = DB::table('forkoms')
            ->join('users', 'forkoms.id_user', '=', 'users.id')
            ->select('forkoms.*', 'users.*', 'forkoms.id as id_forkom')
            ->where('forkoms.id', $id)
            ->first();

        $tanggapan_forkoms = DB::table('forkoms_details')
            ->join('users', 'forkoms_details.id_user', '=', 'users.id')
            ->join('forkoms', 'forkoms_details.id_forkom', '=', 'forkoms.id')
            ->where('forkoms.id', $id)
            ->select('forkoms_details.*', 'users.*', 'forkoms.*', 'forkoms_details.id as id_forkom_detail', 'forkoms.id as id_forkom', 'users.id as id_user')
            ->orderBy('id_forkom_detail', 'desc')
            ->get();

        $total_tanggapan = DB::table('forkoms_details')
            ->join('users', 'forkoms_details.id_user', '=', 'users.id')
            ->join('forkoms', 'forkoms_details.id_forkom', '=', 'forkoms.id')
            ->where('forkoms.id', $id)
            ->select('forkoms_details.*', 'users.*', 'forkoms.*', 'forkoms_details.id as id_forkom_detail', 'forkoms.id as id_forkom', 'users.id as id_user')
            ->count();

        return view('pages.forkom.detail', compact('tanggapan_forkoms', 'user_forkom', 'total_tanggapan'));
    }
    public function create(Request $request, $id)
    {

        $request->validate([
            'tanggapan' => 'required',
        ]);

        ForkomDetails::create([
            'id_user' => Auth::user()->id,
            'id_forkom' => $id,
            'tanggapan' => $request->tanggapan,
            'date' => now()

        ]);

        return redirect()->back()->with('success', 'Tanggapan Berhasil Dibuat!');
    }

    public function destroy($id)
    {
        $tanggapan = ForkomDetails::find($id);
        $tanggapan->delete();
        return redirect()->back()->with('delete', 'Tanggapan Berhasil Dihapus!');
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'tanggapan' => 'required',
        ]);

        $tanggapan = ForkomDetails::find($id);
        $tanggapan->update([
            'tanggapan' => $request->tanggapan,
            'date' => now()
        ]);

        return redirect()->back()->with('update', 'Tanggapan Berhasil Diupdate!');
    }
}
