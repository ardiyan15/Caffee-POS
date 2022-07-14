@extends('layouts.admin_app')

@section('admin_content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Master User</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('users.create') }}"
                                    class="btn btn-primary btn-sm rounded pull-right">Tambah User</a>
                            </div>
                            <div class="card-body">
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Roles</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Tanggal Dibuat</th>
                                            <th class="text-center">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $user->username }}</td>
                                                <td class="text-center">{{ $user->email }}</td>
                                                <td class="text-center">{{ ucwords($user->roles) }}</td>
                                                <td class="text-center">
                                                    @if ($user->is_active == 0)
                                                        <span class="badge text-white badge-danger">Tidak Aktif</span>
                                                    @elseif($user->is_active == 1)
                                                        <span class="badge text-white badge-success">Aktif</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ substr($user->created_at, 0, 10) }}</td>
                                                <td class="text-center">
                                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('users.edit', $user->id) }}"
                                                            class="btn btn-sm btn-info rounded"><i class="fas fa-edit"
                                                                title="Edit"></i></a>
                                                        <button class="delete-confirm btn btn-sm btn-danger rounded"><i
                                                                class="fa fa-trash" aria-hidden="true" data-toggle="tooltip"
                                                                title="Hapus"></i></button>
                                                        @if ($user->is_active == 0)
                                                            <a href="{{ route('activation', $user->id) }}"
                                                                class="btn btn-success btn-sm"><i class="fas fa-check"
                                                                    title="Aktivasi"></i></a>
                                                        @else
                                                            <a href="{{ route('deactivation', $user->id) }}"
                                                                class="text-white btn btn-warning btn-sm"><i
                                                                    class="fas fa-times" title="Deaktivasi"></i></a>
                                                        @endif
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
