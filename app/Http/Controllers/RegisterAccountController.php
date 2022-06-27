<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterAccountController extends Controller
{
    public function index()
    {
        return view('registrasi.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|unique:users,email'
        ]);

        DB::beginTransaction();
        try {
            User::create([
                'username' => $request->username,
                'email' => $validated['email'],
                'password' => Hash::make($request->password),
                'roles' => 'customer',
                'no_telepon' => $request->no_telepon,
                'is_active' => 0
            ]);
            Alert::success('', 'Berhasil Registrasi Akun');
            DB::commit();
            return redirect('login')->with('success', 'Berhasil Registrasi Akun');
        } catch (\Throwable $err) {
            DB::rollBack();
            return back()->with('error', 'Gagal Registrasi Akun');
        }
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
