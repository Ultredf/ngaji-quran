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
                                                <th>Status</th>
                                                <th>Edit</th>
                                                <th>Hapus</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $user->name }}
                                                    </td>
                                                    <td>
                                                        {{ $user->email }}
                                                    </td>
                                                    <td>
                                                        @if ($user->foto_profile)
                                                            <img src="{{ asset($user->foto_profile) }}" alt="image"
                                                                width="100">
                                                        @else
                                                            <img src="{{ asset('assets-dashboard/img/avatar/avatar-1.png') }}"
                                                                alt="image" width="100">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($user->status == null)
                                                            <span class="badge badge-secondary">Unverified</span>
                                                        @elseif($user->status == 'Pending')
                                                            <span class="badge badge-warning">Pending Verifikasi</span>
                                                        @elseif($user->status == 'Verified')
                                                            <span class="badge badge-success">Verified</span>
                                                        @else
                                                            <span class="badge badge-danger">Unverified</span>
                                                        @endif
                                                    </td>
                                                    <td><button class="btn btn-warning" data-toggle="modal"
                                                            data-target="#exampleModal-{{ $user->id }}">Edit</button>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('user.destroy', $user->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-danger" type="submit"
                                                                onclick="return confirm('Hapus user ini?')">Hapus</button>
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




    @foreach ($users as $user)
        <div class="modal fade" id="exampleModal-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit {{ $user->name }} sebagai admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah kamu yakin menjadikan {{ $user->name }} sebagai admin?</p>
                    </div>
                    <div class="modal-footer">
                        <form action={{ route('user.update', $user->id) }} method="POST">
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
