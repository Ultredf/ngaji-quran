@extends('layouts.dashboard.config')
@section('content')
    <div class="main-content" style="min-height: 731px;">
        <section class="section">
            <div class="section-header">
                <h1>Selamat Datang, {{ Auth::user()->name }}</h1>
            </div>
        </section>
    </div>
@endsection
