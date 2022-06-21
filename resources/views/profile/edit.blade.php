@extends('layouts.admin_app')

@section('admin_content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>User Profile</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('profile.update', $user->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Username</label>
                                                <input type="text" name="username" class="form-control"
                                                    value="{{ $user->username }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="Email" value="{{ $user->email }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password <small>( Isi jika ingin diubah
                                                        )</small></label>
                                                <input type="text" name="password" class="form-control"
                                                    placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Roles</label>
                                                <select name="roles" class="form-control">
                                                    <option value="">-- Pilih Roles -- </option>
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role['value'] }}"
                                                            @if ($role['value'] == $user->roles) selected @endif>
                                                            {{ ucwords($role['value']) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nomor Telepon</label>
                                                <input type="text" class="form-control" name="nomor_telepon"
                                                    placeholder="Nomor telepon" value="{{ $user->no_telepon }}">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    <a href="{{ route('profile.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
