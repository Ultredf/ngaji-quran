<?php

namespace App\Http\Controllers;

use App\Models\SosialMedia;
use Illuminate\Http\Request;

class SosialMediaController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'Instagram' => 'nullable|url|unique',
            'X' => 'nullable|url|unique',
            'Facebook' => 'nullable|url|unique',
            'Tiktok' => 'nullable|url|unique',
        ]);

        SosialMedia::create([
            'id_user' => auth()->user()->id,
            'instagram' => $request->Instagram,
            'tiktok' => $request->Tiktok,
            'facebook' => $request->Facebook,
            'x' => $request->X,
        ]);

        return redirect()->back()->with('success', 'Sosial Media Telah Di-update');
    }

    public function update(Request $request)
    {
        $request->validate([
            'Instagram' => 'nullable|url|unique',
            'X' => 'nullable|url|unique',
            'Facebook' => 'nullable|url|unique',
            'TikTok' => 'nullable|url|unique',
        ]);

        $sosialMedia = SosialMedia::where('id_user', auth()->user()->id)->first();
        $sosialMedia->update([
            'instagram' => $request->Instagram,
            'tiktok' => $request->TikTok,
            'facebook' => $request->Facebook,
            'x' => $request->X,
        ]);

        return redirect()->back()->with('success', 'Sosial Media Telah Di-update');
    }
}
