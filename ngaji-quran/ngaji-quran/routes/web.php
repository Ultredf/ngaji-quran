<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookmarksController;
use App\Http\Controllers\ForkomDetailController;
use App\Http\Controllers\ForkomsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SosialMediaController;
use App\Http\Controllers\SunnatullahController;
use App\Http\Controllers\SurahController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\VerifikasiDataController;
use App\Models\AyatTerakhir;
use App\Models\Bookmarks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $response = Http::get('https://api.quran.gading.dev/surah');

    if ($response->successful()) {
        $surahs = $response->json();
    } else {
        $surahs = [];
    }
    if (Auth::check()) {
        $bookmarks = Bookmarks::where('id_user', auth()->user()->id)->pluck('id_surah')->toArray();
        $data_bookmarks = Bookmarks::where('id_user', auth()->user()->id)->get();
    } else {
        $bookmarks = [];
        $data_bookmarks = [];
    }
    if (Auth::check()) {
        $ayat_terakhir = AyatTerakhir::where('id_user', auth()->user()->id)->orderBy('id', 'desc')->get();
    } else {
        $ayat_terakhir = [];
    }

    return view('pages.index', compact('surahs', 'bookmarks', 'data_bookmarks', 'ayat_terakhir'));
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/surah/{id}', [SurahController::class, 'index'])->name('surah.index');
Route::get('/diskusi', [ForkomsController::class, 'index'])->name('forums.index');
Route::get('/doa', [SunnatullahController::class, 'index'])->name('sunnatullah.index');
Route::get('/doa/{id}', [SunnatullahController::class, 'detail'])->name('sunnatullah.detail');

Route::get('/diskusi/detail/{id}', [ForkomDetailController::class, 'index'])->name('forkom_detail.index');

Route::post('/forkom_detail/{id}', [ForkomDetailController::class, 'create'])->name('forkom_detail.create');
Route::post('/forkom_detail/{id}/delete', [ForkomDetailController::class, 'destroy'])->name('forkom_detail.destroy');
Route::post('/forkom_detail/{id}/update', [ForkomDetailController::class, 'update'])->name('forkom_detail.update');

Route::get('/forkom/search', [ForkomsController::class, 'search'])->name('forkom.search');

Route::post('/bookmark/create/{id}', [BookmarksController::class, 'create'])->name('bookmarks.create');
Route::post('/bookmark/delete/{id}', [BookmarksController::class, 'delete'])->name('bookmarks.delete');

Route::patch('/forkom/create', [ForkomsController::class, 'create'])->name('forum.create');
Route::delete('/forkom/destroy/{id}', [ForkomsController::class, 'destroy'])->name('forkom.destroy');
Route::post('/forkom/update/{id}', [ForkomsController::class, 'update'])->name('forkom.update');


Route::post('/surah/save/{id}', [SurahController::class, 'save'])->name('surah.save');
Route::delete('/surah/delete/{id}/{id_ayat}', [SurahController::class, 'delete'])->name('surah.delete');

Route::middleware(['middleware' => 'role:user, admin'])->group(function () {
    Route::post('/sosmed/create', [SosialMediaController::class, 'create'])->name('sosmed.create');
    Route::post('/sosmed/update', [SosialMediaController::class, 'update'])->name('sosmed.update');
});
Route::middleware(['middleware' => 'role:user'])->group(function () {
    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
    Route::post('/verifikasi/upgrade', [VerifikasiController::class, 'upgrade'])->name('verifikasi.upgrade');
});

Route::middleware(['middleware' => 'role:admin'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::delete('/user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/user/update/{id}', [UserController::class, 'update'])->name('user.update');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/admin/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::post('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');

    Route::get('/data-verifikasi', [VerifikasiDataController::class, 'index'])->name('verifikasi-data.index');
    Route::post('/data-verifikasi/{id}', [VerifikasiDataController::class, 'update'])->name('verifikasi-data.update');
});

require __DIR__ . '/auth.php';
