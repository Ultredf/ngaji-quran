<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', '=', 'admin')->get();
        return view('dashboard.admin.index', compact('admins'));
    }

    public function destroy($id)
    {
        $admin = User::find($id);
        $admin->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function update($id)
    {
        $admin = User::find($id);

        $admin->role = 'user';
        $admin->status = null;

        $admin->save();

        return redirect('/user')->with('success', 'Berhasil!');
    }
}
