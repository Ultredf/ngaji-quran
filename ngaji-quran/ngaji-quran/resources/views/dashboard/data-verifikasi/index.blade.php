@extends('layouts.dashboard.config')
@section('content')
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <h1>Data Verifikasi User</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                    <div class="breadcrumb-item">Data Verifikasi User</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Data Verifikasi User</h2>
                <p class="section-lead">
                    Kamu bisa menyetujui data CV user di sini.
                </p>

                @session('success')
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endsession


                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="d-flex justify-between">
                            </div>

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
                                                <th>Status</th>
                                                <th>Detail</th>
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
                                                            data-target="#exampleModal-{{ $user->id }}">Detail</button>
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Verifikasi Akun {{ $user->name }}
                            @if ($user->status == null)
                                <span class="badge badge-secondary">Unverified</span>
                            @elseif($user->status == 'Pending')
                                <span class="badge badge-warning">Pending Verifikasi</span>
                            @elseif($user->status == 'Verified')
                                <span class="badge badge-success">Verified</span>
                            @else
                                <span class="badge badge-danger">Unverified</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <iframe src="{{ asset($user->cv) }}" style="width: 100%; height: 60vh;" frameborder="0"></iframe>
                    </div>
                    <div class="modal-footer ">
                        <form action={{ route('verifikasi-data.update', $user->id) }} method="POST"
                            style="display:flex; gap:10px">
                            @csrf
                            @method('post')
                            <select name="status" id="status" class="form-control">
                                <option value="Pending" @if ($user->status == 'Pending') selected @endif>Pending</option>
                                <option value="Verified" @if ($user->status == 'Verified') selected @endif>Verified</option>
                                <option value="Unverified" @if ($user->status == 'Unverified') selected @endif>Unverified
                                </option>
                            </select>
                            <button type="submit" class="btn btn-primary">Verifikasi User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
