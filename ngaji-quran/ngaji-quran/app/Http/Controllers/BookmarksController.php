<?php

namespace App\Http\Controllers;

use App\Models\Bookmarks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarksController extends Controller
{
    public function create(Request $request)
    {
        Bookmarks::create([
            'id_user' => Auth::user()->id,
            'id_surah' => $request->id,
            'name' => $request->name
        ]);

        return redirect()->back();
    }

    public function delete($id)
    {
        $bookmark = Bookmarks::where('id_surah', $id)
            ->where('id_user', Auth::user()->id)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
        }

        return redirect()->back();
    }
}
