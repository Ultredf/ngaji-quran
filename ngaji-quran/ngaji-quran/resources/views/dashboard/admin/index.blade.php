@extends('layouts.dashboard.config')
@section('content')
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <h1>Data User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                    <div class="breadcrumb-item">Data User</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data User</h2>
                <p class="section-lead">
                    Kamu bisa mengelola data user di sini.
                </p>
                @session('success')
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endsession

                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Foto Profile</th>
                                                <th>Edit</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($admins as $admin)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $admin->name }}
                                                    </td>
                                                    <td>
                                                        {{ $admin->email }}
                                                    </td>
                                                    <td>
                                                        @if ($admin->foto_profile)
                                                            <img src="{{ asset($admin->foto_profile) }}" alt="image"
                                                                width="100">
                                                        @else
                                                            <img src="{{ asset('assets-dashboard/img/avatar/avatar-1.png') }}"
                                                                alt="image" width="100">
                                                        @endif
                                                    </td>
                                                    <td><button class="btn btn-warning" data-toggle="modal"
                                                            data-target="#exampleModal-{{ $admin->id }}">Edit</button>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('admin.destroy', $admin->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger" type="submit"
                                                                onclick="return confirm('Hapus admin ini?')">Hapus</button>
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

            </div>
        </section>
    </div>
    @foreach ($admins as $admin)
        <div class="modal fade" id="exampleModal-{{ $admin->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit {{ $admin->name }} sebagai admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah kamu yakin menjadikan {{ $admin->name }} sebagai user?</p>
                    </div>
                    <div class="modal-footer">
                        <form action={{ route('admin.update', $admin->id) }} method="POST">
                            @csrf
                            @method('post')
                            <button type="submit" class="btn btn-primary">Edit user</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
