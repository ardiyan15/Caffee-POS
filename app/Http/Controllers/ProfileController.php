<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $data = [
            'menu' => '',
            'sub_menu' => '',
            'user' => User::findOrFail(Auth::user()->id)
        ];

        return view('profile.index')->with($data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $roles = [
            [
                'value' => 'owner',
            ],
            [
                'value' => 'driver',
            ],
            [
                'value' => 'admin',
            ]
        ];

        $data = [
            'menu' => '',
            'sub_menu' => '',
            'user' => User::findOrFail($id),
            'roles' => $roles
        ];

        return view('profile.edit')->with($data);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $profile = User::findOrFail($id);
            $profile->username = $request->username;
            $profile->email = $request->email;
            if ($request->password != null) {
                $profile->password = Hash::make($request->password);
            }
            $profile->roles = $request->roles;
            $profile->no_telepon = $request->nomor_telepon;
            $profile->save();
            DB::commit();
            return redirect('admin/profile')->with('success', 'Berhasil update profile');
        } catch (\Throwable $err) {
            DB::rollBack();
            return back()->with('error', 'Gagal update profile');
        }
    }

    public function destroy($id)
    {
        //
    }
}
