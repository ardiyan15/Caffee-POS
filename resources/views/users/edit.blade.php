@extends('layouts.admin_app')
@section('admin_content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit User</h1>
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
                                <form action="{{ route('users.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="">Username</label>
                                            <input class="form-control" type="text" name="username" placeholder="username"
                                                required value="{{ old('username', $user->username) }}">
                                            @error('username')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Password</label> <small>(Isi password jika ingin diubah)</small>
                                            <input class="form-control" type="password" name="password"
                                                placeholder="password">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email"
                                                required value="{{ old('email', $user->email) }}">
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">No Telepon</label>
                                            <input type="text" class="form-control prevent" name="no_telepon" required
                                                placeholder="No Telepon" maxlength="13" minlength="13"
                                                value="{{ old('no_telepon', $user->no_telepon) }}">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Roles</label>
                                            <select name="roles" class="form-control" required>
                                                <option value="">-- Pilih Roles --</option>
                                                @foreach ($roles as $role)
                                                    @if ($role['value'] == $user->roles)
                                                        <option value="{{ $role['value'] }}" selected>
                                                            {{ $role['name'] }}</option>
                                                    @else
                                                        <option value="{{ $role['value'] }}">
                                                            {{ $role['name'] }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="">Status</label>
                                            <select class="form-control" name="status" id="" required>
                                                <option value="">-- Pilih Status --</option>
                                                @if ($user->is_active == '1')
                                                    <option value="1" selected>Aktif</option>
                                                    <option value="2">Tidak Aktif</option>
                                                @else
                                                    <option value="1">Aktif</option>
                                                    <option value="2" selected>Tidak Aktif</option>
                                                @endif
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
