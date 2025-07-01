@extends('welcome')

@section('content')
    <section id="hero" class="mt-40 wrapper flex flex-col md:flex-row justify-between items-center">
        <img src="{{ asset('assets/img/hero.svg') }}" alt="Hero">
        <div class="flex flex-col md:w-1/2 gap-4">
            <h1 class="font-londrina text-primary font-bold text-7xl">NgajiQuran Aja Yuk!</h1>
            <h1 class="text-[#515656] text-2xl">Baca Dimanapun, Tafsir Mendalam, Sunnah Terpadu, Hidayah Seutuhnya.
            </h1>
            <a href="" class="bg-primary rounded-full text-white w-fit p-4 mt-4 text-xl font-semibold">Get
                Started</a>
        </div>
    </section>
    <section id="surah" class="mt-20 wrapper mb-[10rem]">
        <div class="text-primary">
            <div class="flex flex-col">
                <div class="flex items-start gap-4" id="tab-container">
                    <div class="flex flex-col gap-3 items-center">
                        <h1 id="tab-terakhir-dibaca"
                            class="tab-header cursor-pointer py-2 text-lg border-b-2 border-transparent text-gray-700"
                            onclick="showTab('terakhir-dibaca')">Terakhir Dibaca</h1>
                    </div>
                    <div class="flex flex-col gap-3 items-center">
                        <h1 id="tab-bookmarks"
                            class="tab-header cursor-pointer py-2 text-lg border-b-2 border-transparent text-gray-700"
                            onclick="showTab('bookmarks')">Bookmarks</h1>
                    </div>
                    <div class="flex flex-col gap-3 items-center">
                        <h1 id="tab-ayat-terakhir"
                            class="tab-header cursor-pointer py-2 text-lg border-b-2 border-transparent text-gray-700"
                            onclick="showTab('ayat-terakhir')">Ayat Terakhir</h1>
                    </div>
                </div>
                <hr class="w-full border-gray-500 -mt-1">
            </div>
        </div>


        <!-- Display tab For Terakhir Dibaca -->
        <div id="content-terakhir-dibaca" class="tab-content mt-8 flex flex-wrap gap-3 items-center">
            {{-- Show data from local storage --}}
        </div>



        <!-- Display tab For Bookmark -->
        <div id="content-bookmarks" class="tab-content mt-8 flex flex-wrap gap-3 items-center hidden">
            @foreach ($data_bookmarks as $bookmark)
                <a href="/surah/{{ $bookmark['id_surah'] }}"
                    class="text-dark border-dark px-4 py-2 border-2 w-fit rounded-full">{{ $bookmark['name'] }}</a>
            @endforeach
        </div>


        <!-- Display tab For Terakhir Dibaca -->
        <div id="content-ayat-terakhir" class="tab-content mt-8 flex flex-wrap gap-3 items-center">
            @foreach ($ayat_terakhir as $ayat)
                <a href="/surah/{{ $ayat['id_surah'] }}"
                    class="text-dark border-dark px-4 py-2 border-2 w-fit rounded-full">{{ $ayat['nama_surah'] }} / {{ $ayat['ayat_terakhir'] }}</a>
            @endforeach
        </div>


        <div class="text-primary mt-10">
            <div class="flex flex-col">
                <div class="flex items-start gap-4">
                    <div class="flex flex-col gap-3 items-center">
                        <h1>Surah</h1>
                        <hr class="border-primary w-full border-2">
                    </div>
                    {{-- <h1>Juz</h1> --}}
                </div>
                <hr class="w-full border-gray-500 -mt-[1px]">
            </div>
        </div>

        <div class="mt-10 grid md:grid-cols-2 gap-6">
            @if (!empty($surahs))
                @foreach ($surahs['data'] as $surah)
                    <a href="/surah/{{ $surah['number'] }}" class="border-2 border-primary rounded-2xl p-2 md:p-6">
                        <div class="flex justify-between items-center">
                            <div class="flex gap-6 items-center">
                                <div class="rotate-45">
                                    <div
                                        class="bg-primary text-white md:w-12 w-8 h-8 md:h-12 flex justify-center items-center rounded-md md:rounded-xl">
                                        <h1 class="-rotate-45 font-semibold md:text-2xl">{{ $surah['number'] }}</h1>
                                    </div>
                                </div>
                                @if (Auth::check())
                                    <div class="text-primary">
                                        @if (in_array($surah['number'], $bookmarks))
                                            <form action="{{ route('bookmarks.delete', ['id' => $surah['number']]) }}"
                                                class="" method="POST">
                                                @csrf
                                                <button type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="currentColor" class="bi bi-bookmark-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2" />
                                                    </svg>

                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('bookmarks.create', ['id' => $surah['number']]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit">
                                                    <input type="text" hidden name="name"
                                                        value="{{ $surah['name']['transliteration']['id'] }}">
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
                                <h1 class="text-primary font-bold md:text-2xl">
                                    {{ $surah['name']['transliteration']['id'] }}
                                </h1>
                            </div>
                            <div class="flex flex-col gap-2 items-center text-dark md:text-xl">
                                <h1 class="font-amiri">{{ $surah['name']['short'] }}</h1>
                                <h1>{{ $surah['numberOfVerses'] }} Ayat</h1>
                            </div>
                        </div>

                    </a>
                @endforeach
            @else
                <p>No surahs found.</p>
            @endif
        </div>

    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contentTerakhirDibaca = document.getElementById('content-terakhir-dibaca');

            // Function to decode HTML entities
            function decodeHTMLEntities(text) {
                const textArea = document.createElement('textarea');
                textArea.innerHTML = text;
                return textArea.value;
            }

            // Retrieve the history from local storage
            const history = JSON.parse(localStorage.getItem('recentSurahs')) || [];

            // Clear the content first
            contentTerakhirDibaca.innerHTML = '';

            if (history.length === 0) {
                contentTerakhirDibaca.innerHTML = '<p>-</p>';
            } else {
                // Iterate through the history and create links
                history.forEach(surah => {
                    const surahLink = document.createElement('a');
                    surahLink.href = `/surah/${surah.number}`;
                    surahLink.classList.add('text-dark', 'border-dark', 'px-4', 'py-2', 'border-2', 'w-fit',
                        'rounded-full');
                    surahLink.textContent = decodeHTMLEntities(surah.name);

                    contentTerakhirDibaca.appendChild(surahLink);
                });
            }
        });


        function showTab(tabName) {
            const tabContainer = document.getElementById('tab-container');

            // Remove active class and structure from all tab headers
            document.querySelectorAll('.tab-header').forEach(header => {
                header.classList.remove('border-primary', 'text-primary');
                header.classList.add('text-gray-700');

                // Remove the <hr> element if it exists
                const hrElement = header.nextElementSibling;
                if (hrElement && hrElement.tagName === 'HR') {
                    hrElement.remove();
                }
            });

            // Find the clicked tab header
            const activeTab = document.getElementById('tab-' + tabName);
            activeTab.classList.add('border-primary', 'text-primary');
            activeTab.classList.remove('text-gray-700');

            // Add the <hr> element under the active tab
            const hrElement = document.createElement('hr');
            hrElement.className = 'border-primary w-full border-2 mt-1';
            activeTab.parentNode.appendChild(hrElement);

            // Hide all tab content
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Show the selected tab content
            document.getElementById('content-' + tabName).classList.remove('hidden');
        }

        // Default tab to show on page load
        document.addEventListener('DOMContentLoaded', () => {
            showTab('terakhir-dibaca');
        });
    </script>
@endsection
