@extends('layouts.admin_app')
@section('admin_content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tambah User</h1>
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
                                <form action="{{ route('users.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Username</label>
                                            <input class="form-control" type="text" name="username" placeholder="username"
                                                required value="{{ old('username') }}">
                                            @error('username')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Password</label>
                                            <input class="form-control" type="password" name="password"
                                                placeholder="password" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email"
                                                required value="{{ old('email') }}">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">No Telepon</label>
                                            <input type="text" class="form-control prevent" name="no_telepon" required
                                                placeholder="No Telepon" maxlength="13" minlength="13"
                                                value="{{ old('no_telepon') }}">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Roles</label>
                                            <select name="roles" class="form-control" required>
                                                <option value="">-- Pilih Roles --</option>
                                                <option value="owner" {{ old('roles') == 'owner' ? 'selected' : '' }}>
                                                    Owner</option>
                                                <option value="admin" {{ old('roles') == 'admin' ? 'selected' : '' }}>
                                                    Admin</option>
                                                <option value="driver" {{ old('roles') == 'driver' ? 'selected' : '' }}>
                                                    Driver</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-sm rounded">Simpan</button>
                                    <a href="{{ route('users.index') }}"
                                        class="btn btn-secondary btn-sm rounded">Kembali</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
