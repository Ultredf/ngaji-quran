<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')->get();


        return view('dashboard.user.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully');
    }

    public function update($id)
    {
        $user = User::find($id);

        $user->role = 'admin';
        $user->status = 'Verified';

        $user->save();

        return redirect('/admin')->with('success', 'Berhasil!');
    }
}
