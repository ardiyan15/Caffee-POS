<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $menu = '';

    public function index()
    {
        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'test',
            'users' => User::orderBy('id', 'DESC')->get()
        ];

        return view('users.index')->with($data);
    }

    public function create()
    {
        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'test'
        ];

        return view('users.create')->with($data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email'
        ]);

        DB::beginTransaction();
        try {
            User::create([
                'username' => $validated['username'],
                'password' => Hash::make($request->password),
                'roles' => $request->roles,
                'no_telepon' => $request->no_telepon,
                'email' => $request->email,
                'is_active' => '1'
            ]);
            DB::commit();
            return redirect('admin/users')->with('success', 'Berhasil menambah user baru');
        } catch (\Throwable $err) {
            DB::rollBack();
            return back()->with('error', 'Gagal menambah user baru');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $roles = [
            [
                'value' => 'owner',
                'name' => 'Owner'
            ],
            [
                'value' => 'driver',
                'name' => 'Driver'
            ],
            [
                'value' => 'admin',
                'name' => 'Admin'
            ]
        ];

        $data = [
            'menu' => $this->menu,
            'sub_menu' => 'test',
            'user' => User::findOrFail($id),
            'roles' => $roles
        ];

        return view('users.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|unique:users,email,' . $user->id
        ]);
        DB::beginTransaction();
        try {
            $user->username = $validated['username'];
            $user->email = $validated['email'];
            $user->no_telepon = $request->no_telepon;
            $user->roles = $request->roles;
            if ($request->password !== null) {
                $user->password = $request->passsword;
            }
            $user->is_active = $request->status;
            $user->save();
            DB::commit();
            return redirect('admin/users')->with('success', 'Berhasil update user');
        } catch (\Throwable $err) {
            DB::rollBack();
            return back()->with('error', 'Gagal update user');
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->delete();
            DB::commit();
            return back()->with('success', 'Berhasil menghapus user');
        } catch (\Throwable $err) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus user');
        }
    }
}
