@extends('welcome')

@section('content')
    <section id="surah" class="mt-40 mb-[10rem] wrapper">
        @if (!empty($surah) && isset($surah['data']['verses']))
            <div class="text-center">
                <h1 class="font-bold text-2xl">{{ $surah['data']['name']['long'] }}</h1>
                <h1 class="font-bold text-xl">{{ $surah['data']['name']['transliteration']['id'] }}</h1>
                <p class="text-gray-500">{{ $surah['data']['revelation']['id'] }} - {{ $surah['data']['numberOfVerses'] }}
                    Ayat</p>
            </div>
            <ul class="w-fulll">
                @foreach ($surah['data']['verses'] as $verse)
                    <div class="flex gap-4 items-center w-full">
                        <li class="mt-10 w-full">
                            <a href="javascript:void(0);"
                                class="bg-white text-gray-500 shadow-xl rounded-2xl p-4 w-fit flex gap-2 items-center hidden"
                                id="tafsir-link-{{ $verse['number']['inSurah'] }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-chat-square" viewBox="0 0 16 16">
                                    <path
                                        d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1h-2.5a2 2 0 0 0-1.6.8L8 14.333 6.1 11.8a2 2 0 0 0-1.6-.8H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2.5a1 1 0 0 1 .8.4l1.9 2.533a1 1 0 0 0 1.6 0l1.9-2.533a1 1 0 0 1 .8-.4H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                </svg>
                                Lihat Tafsir
                            </a>
                            <div class="flex justify-between">
                                <a href="javascript:void(0);" class="text-gray-500 hover:scale-110 duration-150"
                                    onclick="toggleTafsirContent({{ $verse['number']['inSurah'] }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                                        <path
                                            d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                    </svg>
                                </a>
                                <div class="text-2xl font-bold flex gap-2  items-center">
                                    <p class="text-sm font-semibold border-[1px] flex justify-center items-center w-8 h-8 rounded-full  border-primary">
                                        {{ $verse['number']['inSurah'] }}</p>
                                    <p>{{ $verse['text']['arab'] }}</p>
                                </div>
                            </div>
                            <p class="mt-2 text-primary">{{ $verse['text']['transliteration']['en'] }}</p>
                            <p class="mt-2">{{ $verse['translation']['id'] }}</p>
                            <div class="mt-4 border-2 rounded-2xl p-4 hidden"
                                id="tafsir-content-{{ $verse['number']['inSurah'] }}">
                                <h1>{{ $verse['tafsir']['id']['long'] }}</h1>
                            </div>


                        </li>
                        @if (Auth::check())
                            <div class="text-primary">
                                @php
                                    $combined = trim(
                                        $verse['number']['inSurah'] . $surah['data']['name']['transliteration']['id'],
                                    );
                                @endphp
                                @if (in_array($combined, $ayat_terakhir_user))
                                    <form
                                        action="{{ route('surah.delete', ['id_ayat' => $verse['number']['inSurah'], 'id' => $surah['data']['number']]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-bookmark-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2" />
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('surah.save', ['id' => $verse['number']['inSurah']]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit">
                                            <input type="text" hidden name="id_surah"
                                                value="{{ $surah['data']['number'] }}">
                                            <input type="hidden" name="nama_surah"
                                                value="{{ $surah['data']['name']['transliteration']['id'] }}">
                                            <input type="hidden" name="ayat_terakhir"
                                                value="{{ $verse['number']['inSurah'] }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
                                                <path
                                                    d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </ul>
        @else
            <p>No surah found.</p>
        @endif
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const surahNumber = '{{ $surah['data']['number'] }}';
            const surahName = '{{ $surah['data']['name']['transliteration']['id'] }}';

            // Retrieve the existing history from local storage
            let history = JSON.parse(localStorage.getItem('recentSurahs')) || [];

            // Check if the Surah is already in the history
            const existingSurahIndex = history.findIndex(surah => surah.number === surahNumber);

            if (existingSurahIndex !== -1) {
                // Remove the existing entry
                history.splice(existingSurahIndex, 1);
            }

            // Add the new entry at the beginning
            history.unshift({
                number: surahNumber,
                name: surahName
            });

            // Limit history to the last 10 entries
            if (history.length > 5) {
                history.pop();
            }

            // Save the updated history back to local storage
            localStorage.setItem('recentSurahs', JSON.stringify(history));
        });

        function toggleTafsirContent(verseNumber) {
            const link = document.getElementById(`tafsir-link-${verseNumber}`);
            const content = document.getElementById(`tafsir-content-${verseNumber}`);
            link.classList.toggle('hidden');
            content.classList.toggle('hidden');
        }
    </script>
@endsection
