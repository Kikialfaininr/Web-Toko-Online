<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Session;

class ProfilController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view('editprofil', compact('user'));
    }

    public function user()
    {
        return DataTables::of(User::query())->toJson();
    }

    public function adminuser(Request $request)
    {
        $user = User::all();
        return view('adminuser', compact('user', 'request'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('old_password')) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            } else {
                return back()
                    ->withErrors(['old_password' => __('Please enter the correct password')])
                    ->withInput();
            }
        }

        $user->save();
        Session::flash('sukses', 'Profil berhasil diupdate');
        return Redirect('/editprofil');
    }
}