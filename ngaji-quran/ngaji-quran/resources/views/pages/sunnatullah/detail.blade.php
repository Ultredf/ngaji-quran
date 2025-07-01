@extends('welcome')

@section('content')
    <section id="detail" class="mt-40 wrapper">
        @if (!empty($data) && isset($data['ayat']))
            <div class="text-center">
                <h1 class="font-bold text-2xl">{{ $data['doa'] }}</h1>
                <h1 class="text-sm text-gray-500">1 Bacaan</h1>
            </div>
            <div class="flex justify-end">
                <h1 class="text-7xl mt-10">{{ $data['ayat'] }}</h1>
            </div>
            <div class="flex justify-start text-lg gap-2 mt-10 flex-col">
                <h1 class="text-primary">{{ $data['latin'] }}</h1>
                <h1>{{ $data['artinya'] }}</h1>
            </div>
        @else
            <p>No data found.</p>
        @endif
    </section>
@endsection
