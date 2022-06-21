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
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <th width="150">Username</th>
                                        <td width="20">:</td>
                                        <td>{{ Auth::user()->username }}</td>
                                    </tr>
                                    <tr>
                                        <th width="150">Email</th>
                                        <td width="20">:</td>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Roles</th>
                                        <td>:</td>
                                        <td>{{ Auth::user()->roles }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nomor Telepon</th>
                                        <td>:</td>
                                        <td>{{ Auth::user()->no_telepon }}</td>
                                    </tr>
                                </table>
                                <a href="{{ route('profile.show', $user->id) }}" class="btn btn-info btn-sm mt-2">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
