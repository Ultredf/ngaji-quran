@extends('welcome')

@section('content')
    <section id="doa" class="mt-40 wrapper mb-[10rem]">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            @foreach ($datas as $data)
                <div class="relative hover:scale-105 duration-150 bg-[#F9FAFB] border-2 rounded-2xl w-full h-20">
                    <h1
                        class="bg-[#E3FCF0] text-primary w-14 flex justify-center items-center rounded-l-2xl h-full absolute left-0">
                        {{ $data['id'] }}</h1>
                    <div class="ml-20 h-full items-center mr-6 flex justify-between">
                        <div class="flex flex-col justify-center h-full">
                            <h1 class="font-bold md:text-lg">{{ $data['doa'] }}</h1>
                            <h1 class="text-sm text-gray-400">1 Bacaan</h1>
                        </div>
                        <a href="/doa/{{ $data['id'] }}" class="text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                            </svg>
                        </a>

                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endsection
