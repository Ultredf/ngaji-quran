<?php

namespace App\Http\Controllers;

use App\Models\Forkoms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ForkomsController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->sort_by;

        $forkomsQuery = DB::table('forkoms')
            ->join('users', 'forkoms.id_user', '=', 'users.id')
            ->leftJoin('sosial_medias', 'users.id', '=', 'sosial_medias.id_user') // Changed to leftJoin

            ->select('forkoms.*', 'users.*', 'sosial_medias.*', 'forkoms.id as id_forkom', 'users.id as id_user');

        if ($filter == 'tanggapan_terbanyak') {
            $totalTanggapanQuery = DB::table('forkoms_details')
                ->select('id_forkom', DB::raw('count(*) as total'))
                ->groupBy('id_forkom');

            $forkoms = DB::table('forkoms')
                ->join('users', 'forkoms.id_user', '=', 'users.id')
                ->leftJoinSub($totalTanggapanQuery, 'total_tanggapan', function ($join) {
                    $join->on('forkoms.id', '=', 'total_tanggapan.id_forkom');
                })
                ->leftJoin('sosial_medias', 'users.id', '=', 'sosial_medias.id_user') // Ensure leftJoin here as well
                ->select('forkoms.*', 'users.*', 'sosial_medias.*', 'forkoms.id as id_forkom', 'users.id as id_user', DB::raw('COALESCE(total_tanggapan.total, 0) as total'))
                ->orderByDesc('total')
                ->paginate(5);
        } elseif ($filter == 'forkomku') { // Changed to compare $filter instead of $forkomsQuery
            $forkoms = $forkomsQuery->where('id_user', Auth::user()->id)->orderBy('id_forkom', 'desc')->paginate(5);
        } else {
            $forkoms = $forkomsQuery->orderBy('id_forkom', 'desc')->paginate(5);
        }
        // dd($forkoms);
        $total_tanggapan = DB::table('forkoms_details')
            ->select('id_forkom', DB::raw('count(*) as total'))
            ->groupBy('id_forkom')
            ->pluck('total', 'id_forkom')
            ->all();

        $sosmeds = DB::table('sosial_medias')
            ->join('users', 'sosial_medias.id_user', '=', 'users.id')
            ->select('sosial_medias.*', 'users.*', 'sosial_medias.id as id_sosmed', 'users.id as id_user')
            ->get();

        return view('pages.forkom.index', compact('forkoms', 'total_tanggapan', 'sosmeds'));
    }




    public function create(Request $request)
    {

        $request->validate([
            'judul' => 'required',
            'pertanyaan' => 'required',
        ]);

        Forkoms::create([
            'id_user' => Auth::user()->id,
            'judul' => $request->judul,
            'pertanyaan' => $request->pertanyaan,
            'date' => now()
        ]);

        return redirect()->back()->with('success', 'Berhasil post forkom!');
    }

    public function destroy($id)
    {
        $forkom = Forkoms::find($id);
        $forkom->delete();
        return redirect()->back()->with('success', 'Berhasil hapus forkom!');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'pertanyaan' => 'required',
        ]);
        $forkom = Forkoms::find($id);
        $forkom->update([
            'id_user' => Auth::user()->id,
            'judul' => $request->judul,
            'pertanyaan' => $request->pertanyaan,
            'date' => now()
        ]);
        return redirect()->back()->with('success', 'Berhasil update forkom!');
    }

    public function search(Request $request)
    {
        $search = $request->judul;
        $forkoms = DB::table('forkoms')
            ->join('users', 'forkoms.id_user', '=', 'users.id')
            ->select('forkoms.*', 'users.*', 'forkoms.id as id_forkom', 'users.id as id_user')
            ->orderBy('id_forkom', 'desc')
            ->where('judul', 'like', '%' . $search . '%')
            ->get();

        $total_tanggapan = DB::table('forkoms_details')
            ->select('id_forkom', DB::raw('count(*) as total'))
            ->groupBy('id_forkom')
            ->pluck('total', 'id_forkom')
            ->all();

        return view('pages.forkom.index', compact('forkoms', 'total_tanggapan'));
    }
}
