{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


@extends('layouts.dashboard.config')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profil {{ $user->kode_penghuni }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Hi, {{ Auth::user()->name }}!</h2>
                @if (Auth::user()->level == 'user')
                    <p class="section-lead">
                        Berikut merupakan profil. Jika terdapat kesalahan/penggantian data diri. <b>Wajib hubungi admin
                            secepatnya untuk proses perubahan.</b>
                    </p>
                @endif

                @session('success')
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endsession

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                @if (Auth::user()->foto_profile == null)
                                    <img alt="image" src="{{ asset('assets-dashboard/img/avatar/avatar-1.png') }}"
                                        class="rounded-circle profile-widget-picture" style="object-fit: cover; object-position: center; width:7rem;height:7rem">
                                @else
                                    <img alt="image" src="{{ asset(Auth::user()->foto_profile) }}"
                                        class="rounded-circle profile-widget-picture" style="object-fit: cover; object-position: center; width:7rem;height:7rem">
                                @endif

                                <div class="profile-widget-items">

                                </div>
                            </div>
                            <div class="profile-widget-description">
                                <div class="profile-widget-name">{{ $user->name }}<div
                                        class="text-muted d-inline font-weight-normal">
                                        <div class="slash"></div>
                                        {{ $user->role }}
                                    </div>
                                </div>
                                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                    @csrf
                                    @method('put')

                                    <div>
                                        <x-input-label for="update_password_current_password" :value="__('Password Saat Ini')" />
                                        <input class="form-control" id="update_password_current_password"
                                            name="current_password" type="password" class="mt-1 block w-full"
                                            autocomplete="current-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="update_password_password" :value="__('Password Baru')" />
                                        <input class="form-control" id="update_password_password" name="password"
                                            type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Password')" />
                                        <input class="form-control" id="update_password_password_confirmation"
                                            name="password_confirmation" type="password" class="mt-1 block w-full"
                                            autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center gap-4 mt-2">
                                        <button type="submit" class="btn btn-primary">Ganti Password</button>

                                        @if (session('status') === 'password-updated')
                                            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                                class="text-sm text-green-600 ">
                                                {{ __('Telah Tersimpan!.') }}</p>
                                        @endif
                                    </div>
                                </form>

                            </div>

                        </div>

                    </div>

                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                @csrf
                            </form>


                            <div class="card-header">
                                <h4>Edit Profile</h4>
                            </div>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Berhasil Diedit!') }}</p>
                            @endif
                            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6 col-12">
                                            <label>Name</label>
                                            <input id="name" name="name" type="text" class="form-control"
                                                value="{{ Auth::user()->name }}" autofocus autocomplete="name" />

                                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                        </div>
                                        <div class="form-group col-md-6 col-12">
                                            <label>Email</label>
                                            <input id="email" name="email" type="text" class="form-control"
                                                value="{{ Auth::user()->email }}" autofocus autocomplete="email" />

                                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                                        </div>
                                        <div class="form-group  col-12">
                                            <label>Foto Profile</label>
                                            <input id="foto_profile" name="foto_profile" type="file" class="form-control"
                                                :value="old('foto_profile', $user - > foto_profile)" autofocus
                                                autocomplete="foto_profile" />

                                            <x-input-error class="mt-2" :messages="$errors->get('foto_profile')" />
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </section>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="tambah-rekening">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Rekening</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <label for="nama_rekening">Nama Bank / Rekening</label>
                            <input type="text" id="nama_rekening" name="nama_rekening" class="form-control">
                        </div>
                        <div class="mt-4">
                            <label for="no_rekening">Nomor Rekening</label>
                            <input type="text" id="no_rekening" name="no_rekening" class="form-control">
                        </div>
                        <div class="mt-4">
                            <label for="atas_nama">Atas Nama</label>
                            <input type="text" id="atas_nama" name="atas_nama" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
