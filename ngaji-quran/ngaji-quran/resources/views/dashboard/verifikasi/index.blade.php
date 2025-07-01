@extends('layouts.dashboard.config')
@section('content')
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <h1>Verifikasi Akun Kamu</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                    <div class="breadcrumb-item">Verifikasi Akun Kamu</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Verifikasi Akun!</h2>
                <p class="section-lead">
                    Jika kamu berminat untuk posting hal bermanfaat di forum, yuk verifikasi akun kamu! </p>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            @if (Auth::user()->cv == null)
                                <div class="d-flex justify-between">
                                    <div class="card-header">
                                        <h4>* Kamu hanya memerlukan CV atau riwayat diri dengan menyertakan foto/video yang
                                            mendukung bahwa kamu pernah berkontribusi di bidang agama islam.</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action={{ route('verifikasi.upgrade') }} method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <label for="">Curriculum Vitae (CV)</label>
                                        <input type="file" class="form-control" name="cv">
                                        <button class="btn btn-primary mt-4">Verifikasi</button>
                                    </form>
                                </div>
                            @endif

                            @if (!empty(Auth::user()->status))
                                @if (Auth::user()->status == 'Pending')
                                    <div class="alert alert-warning">
                                        Akun kamu sedang menunggu verifikasi, tunggu hingga konfirmasi admin.
                                    </div>
                                @elseif(Auth::user()->status == 'Unverified')
                                    <div class="alert alert-danger">
                                        Akun kamu sedang ditolak, silahkan hubungi admin.
                                    </div>
                                    <div class="mt-4">
                                        <h5>Jangan khawatir, kamu bisa mencoba lagi di sini:</h5>
                                        <form action={{ route('verifikasi.upgrade') }} method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <label for="">Curriculum Vitae (CV)</label>
                                            <input type="file" class="form-control" name="cv">
                                            <button class="btn btn-primary mt-4">Verifikasi</button>
                                        </form>
                                    </div>
                                @else
                                    @if (!empty(Auth::user()->status))
                                        @if (Auth::user()->status == 'Verified')
                                            <h6>Kamu bisa menambahkan sosial media agar mudah dikenali!</h6>
                                            <p>*Masukkan dalam bentuk link</p>
                                            <div class="row mb-4">
                                                <div class="col">

                                                    @if ($sosmed->instagram == null && $sosmed->facebook == null && $sosmed->tikTok == null && $sosmed->x == null)
                                                        <form action={{ route('sosmed.create') }} method="POST"
                                                            class="row">
                                                            @csrf
                                                            <div class="col-12 col-lg-3">
                                                                <div>
                                                                    <label for="Instagram">Instagram</label>
                                                                    <input type="link" value="{{ old('Instagram') }}"
                                                                        class="form-control" name="Instagram">
                                                                    @error('Instagram')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-3">
                                                                <div>
                                                                    <label for="Facebook">Facebook</label>
                                                                    <input type="link" value="{{ old('Facebook') }}"
                                                                        class="form-control" name="Facebook">
                                                                    @error('Facebook')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-3">
                                                                <div>
                                                                    <label for="TikTok">TikTok</label>
                                                                    <input type="link" value="{{ old('TikTok') }}"
                                                                        class="form-control" name="TikTok">
                                                                    @error('TikTok')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-3">
                                                                <div>
                                                                    <label for="X">Twitter (X)</label>
                                                                    <input type="link" value="{{ old('X') }}"
                                                                        class="form-control" name="X">
                                                                    @error('X')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-3 mt-2">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    @else
                                                        <form action={{ route('sosmed.update') }} method="POST"
                                                            class="row">
                                                            @csrf
                                                            <div class="col-12 col-lg-3">
                                                                <div>
                                                                    <label for="Instagram">Instagram</label>
                                                                    <input type="link"
                                                                        @if (!empty($sosmed->instagram)) value="{{ $sosmed->instagram }}" @else value="{{ old('Instagram') }}" @endif
                                                                        }}" class="form-control" name="Instagram">
                                                                    @error('Instagram')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-3">
                                                                <div>
                                                                    <label for="Facebook">Facebook</label>
                                                                    <input type="link"
                                                                        @if (!empty($sosmed->facebook)) value="{{ $sosmed->facebook }}" @else value="{{ old('Facebook') }}" @endif
                                                                        class="form-control" name="Facebook">
                                                                    @error('Facebook')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-3">
                                                                <div>
                                                                    <label for="TikTok">TikTok</label>
                                                                    <input type="link"
                                                                        @if (!empty($sosmed->tiktok)) value="{{ $sosmed->tiktok }}" @else value="{{ old('TikTok') }}" @endif
                                                                        class="form-control" name="TikTok">
                                                                    @error('TikTok')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-3">
                                                                <div>
                                                                    <label for="X">Twitter (X)</label>
                                                                    <input type="link"
                                                                        @if (!empty($sosmed->x)) value="{{ $sosmed->x }}" @else value="{{ old('X') }}" @endif
                                                                        class="form-control" name="X">
                                                                    @error('X')
                                                                        <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-3 mt-2">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </form>
                                                    @endif

                                                </div>
                                            </div>
                                        @else
                                            <div class="alert alert-success">
                                                Akun kamu telah terverifikasi, kamu sudah bisa post di forum & menebarkan
                                                manfaat!.
                                            </div>
                                            <div class="mt-4">
                                                <a href="/diskusi" class="btn btn-primary">Mulai Diskusi</a>
                                            </div>
                                        @endif
                                    @endif

                                    <div class="alert alert-success">
                                        Akun kamu telah terverifikasi, kamu sudah bisa post di forum & menebarkan manfaat!.
                                    </div>
                                    <div class="mt-4">
                                        <a href="/diskusi" class="btn btn-outline-warning">Mulai Diskusi</a>
                                    </div>
                                @endif
                            @endif

                            @if (!empty(Auth::user()->cv))
                                <iframe src="{{ asset(Auth::user()->cv) }}" style="width: 100%; height: 400px;"
                                    frameborder="0" class="mt-4"></iframe>
                            @endif

                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
