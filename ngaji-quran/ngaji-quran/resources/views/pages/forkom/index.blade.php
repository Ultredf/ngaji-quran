@extends('welcome')

@section('content')
    <section id="forkom" class="mt-40 wrapper mb-[10rem]">
        @session('success')
            <div class="bg-green-200 w-full text-center mb-4 py-2 rounded-2xl" role="alert">
                {{ session('success') }}
            </div>
            <script>
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            </script>
        @endsession
        @if (Auth::check())
            @if (isset(Auth::user()->status) && Auth::user()->status == 'Verified')
                <button id="toggleFormButton"
                    class="bg-primary text-white text-lg w-full p-4 rounded-md text-center flex justify-center items-center gap-4"
                    onclick="toggleForm()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                        class="bi bi-plus" viewBox="0 0 16 16">
                        <path
                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                    </svg>
                    Buat Diskusi
                </button>
                <div id="forkomForm" class="hidden  bg-[#D8D8D8] w-full py-6 px-4 md:px-10 rounded-2xl  justify-between">
                    <form action="{{ route('forum.create') }}" method="POST"
                        class="flex flex-col md:flex-row items-center justify-between w-full gap-4 ">
                        @csrf
                        @method('patch')
                        <div class="flex flex-col md:flex-row gap-4 items-center">
                            @if (Auth::check())
                                @if (Auth::user()->foto_profile == null)
                                    <img alt="image" src="{{ asset('assets-dashboard/img/avatar/avatar-1.png') }}"
                                        class="w-12 h-12 rounded-full  object-cover object-center">
                                @else
                                    <img alt="image" src="{{ asset(Auth::user()->foto_profile) }}"
                                        class="w-12 h-12 rounded-full  object-cover object-center">
                                @endif
                            @else
                                <img alt="image" src="{{ asset('assets-dashboard/img/avatar/avatar-1.png') }}"
                                    class="w-12 h-12 rounded-full  object-cover object-center">
                            @endif
                            <div class="flex flex-col gap-4">
                                <input type="text" required name="judul"
                                    class="md:w-[40rem]  bg-primary/20 h-14 rounded-2xl" placeholder="Tulis Judul...">
                                <textarea required name="pertanyaan" id="pertanyaan" class="md:w-[40rem] h-[20rem]  bg-primary/20 rounded-2xl"
                                    cols="30" rows="10">...</textarea>
                            </div>
                        </div>
                        <button type="submit" onclick="return confirm('Apakah kamu yakin?')"
                            class="bg-primary px-10 text-2xl py-2 h-14 font-semibold rounded-2xl text-white">Post</button>
                    </form>

                </div>
            @else
                <div class="bg-[#D8D8D8] w-full py-6 px-4 md:px-10 rounded-2xl flex justify-between">
                    <div class="flex flex-col md:flex-row items-center justify-between w-full gap-4 ">
                        <div class="flex gap-4 items-center">
                            @if (Auth::check())
                                @if (Auth::user()->foto_profile == null)
                                    <img alt="image" src="{{ asset('assets-dashboard/img/avatar/avatar-1.png') }}"
                                        class="w-12 h-12 rounded-full  object-cover object-center">
                                @else
                                    <img alt="image" src="{{ asset(Auth::user()->foto_profile) }}"
                                        class="w-12 h-12 rounded-full  object-cover object-center">
                                @endif
                            @else
                                <img alt="image" src="{{ asset('assets-dashboard/img/avatar/avatar-1.png') }}"
                                    class="w-12 h-12 rounded-full  object-cover object-center">
                            @endif
                            <input type="text" class="md:w-[40rem] bg-[#858585] h-14 rounded-2xl" disabled>
                        </div>
                        <div class="bg-[#858585] px-3 py-2 h-14 font-semibold rounded-2xl text-white">Belum Tersedia</div>
                    </div>

                </div>
                <h1 class="text-center text-[#818181] mt-4">*Akun harus verified untuk posting di forum, silahkan verifikasi
                    <a href="/verifikasi" class="text-primary underline font-bold">DI SINI</a>
                </h1>
            @endif
        @endif
        <div class="mt-10">
            <div class="flex flex-col md:flex-row gap-4 text-center md:justify-between">
                <div class="relative">

                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                        class="  p-2 font-bold text-4xl rounded-xl absolute left-2 top-1/2 transform -translate-y-1/2"
                        viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>

                    <div class="flex gap-2 items-center">
                        <form action="{{ route('forkom.search') }}" method="GET">
                            <input type="text" name="judul"
                                class="bg-slate-300/40 focus:bg-bl/10 w-80 md:w-96  p-2 pl-14 h-14 rounded-full border-white focus:scale-[1.01]  focus:outline-white text-slate-700 font-semibold  duration-150"
                                placeholder="Cari...">
                        </form>
                        @if (isset($_GET['judul']) && $_GET['judul'] != null)
                            <a href="/forkom" class="bg-primary text-white rounded-xl p-2">Reset</a>
                        @endif
                    </div>
                </div>
                <div class="flex gap-3 items-center mb-4">
                    <a href="{{ route('forums.index', ['sort_by' => 'terbaru']) }}"
                        class="text-gray-400 bg-gray-200 rounded-full p-2 flex gap-2 items-center
                               @if (request()->has('sort_by') && request()->sort_by === 'terbaru') text-white bg-primary @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-clock" viewBox="0 0 16 16">
                            <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                        </svg>
                        Terbaru
                    </a>

                    <a href="{{ route('forums.index', ['sort_by' => 'tanggapan_terbanyak']) }}"
                        class="text-gray-400 bg-gray-200 rounded-full p-2 flex gap-2 items-center
                               @if (request()->has('sort_by') && request()->sort_by === 'tanggapan_terbanyak') text-white bg-primary @endif">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                        </svg>
                        Tanggapan Terbanyak
                    </a>
                    @if (Auth::check())
                        <a href="{{ route('forums.index', ['sort_by' => 'forkomku']) }}"
                            class="text-gray-400 bg-gray-200 rounded-full p-2 flex gap-2 items-center
                               @if (request()->has('sort_by') && request()->sort_by === 'forkomku') text-white bg-primary @endif">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                            Forkom Ku
                        </a>
                    @endif

                </div>
            </div>
        </div>
        @foreach ($forkoms as $forkom)
            <!-- Modal -->
            <div id="myModal-{{ $forkom->id }}-{{ $forkom->instagram }}-{{ $forkom->x }}-{{ $forkom->facebook }}-{{ $forkom->tiktok }}"
                class="fixed inset-0 hidden bg-gray-900 bg-opacity-50 z-[999] flex items-center justify-center">
                <div class="bg-white rounded-lg shadow-lg md:w-fit w-[90%]">
                    <div class="p-4 border-b flex justify-between items-center w-full">
                        <h2 class="text-lg font-semibold">Detail Profile {{ $forkom->name }}</h2>
                        <button class="text-gray-500 text-2xl hover:text-gray-700 close-modal">&times;</button>
                    </div>
                    <div class="p-4">
                        @if (!empty($forkom->instagram))
                            <div class="flex gap-3 items-center">
                                <p>Instagram: {{ $forkom->instagram }}</p>
                                <a href="{{ $forkom->instagram }}" class="text-primary underline"
                                    target="_blank">Kunjungi</a>
                            </div>
                        @endif
                        @if (!empty($forkom->x))
                            <div class="flex gap-3 items-center">
                                <p>Twitter (X): {{ $forkom->x }}</p>
                                <a href="{{ $forkom->x }}" class="text-primary underline"
                                    target="_blank">Kunjungi</a>
                            </div>
                        @endif
                        @if (!empty($forkom->facebook))
                            <div class="flex gap-3 items-center">
                                <p>Facebook: {{ $forkom->facebook }}</p>
                                <a href="{{ $forkom->facebook }}" class="text-primary underline"
                                    target="_blank">Kunjungi</a>
                            </div>
                        @endif
                        @if (!empty($forkom->tiktok))
                            <div class="flex gap-3 items-center">
                                <p>Tiktok: {{ $forkom->tiktok }}</p>
                                <a href="{{ $forkom->tiktok }}" class="text-primary underline"
                                    target="_blank">Kunjungi</a>
                            </div>
                        @endif
                        @if (empty($forkom->instagram) && empty($forkom->x) && empty($forkom->facebook) && empty($forkom->tiktok))
                            <h1>User tidak menyertakan sosial media.</h1>
                        @endif
                    </div>
                    <div class="p-4 border-t">
                        <button class="bg-primary text-white px-4 py-2 rounded close-modal">Close</button>
                    </div>
                </div>
            </div>
            <div class="flex gap-4 items-center">
                <div class="w-full">
                    <div
                        class="mt-10 p-4 border-2 hover:border-primary rounded-2xl duration-150
                        @if (Auth::check()) @if ($forkom->id_user == Auth::user()->id) border-primary hover:scale-95 @endif
@endif
                         ">
                        <h1 class="text-2xl font-bold">
                            {{ $forkom->judul }}</h1>
                        <div class="mt-4 flex flex-col md:flex-row justify-between gap-4 md:gap-0 md:items-center">
                            <div class="flex gap-3 items-center">
                                @if (Auth::check())
                                    @if ($forkom->foto_profile == null)
                                        <img alt="image" src="{{ asset('assets-dashboard/img/avatar/avatar-1.png') }}"
                                            class="w-12 h-12 rounded-full object-cover object-center">
                                    @else
                                        <img alt="image" src="{{ asset($forkom->foto_profile) }}"
                                            class="w-12 h-12 rounded-full object-cover object-center">
                                    @endif
                                @elseif($forkom->foto_profile != null)
                                    <img alt="image" src="{{ asset($forkom->foto_profile) }}"
                                        class="w-12 h-12 rounded-full object-cover object-center">
                                @else
                                    <img alt="image" src="{{ asset('assets-dashboard/img/avatar/avatar-1.png') }}"
                                        class="w-12 h-12 rounded-full object-cover object-center">
                                @endif
                                <div class="flex flex-col">
                                    <h1 class="font-semibold text-lg">{{ $forkom->name }}</h1>
                                    @if ($forkom->status == 'Verified')
                                        <div class="text-primary">Verified User @if ($forkom->role == 'admin')
                                                (Admin)
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-red-500">Unverified</span>
                                    @endif
                                </div>

                                @if ($forkom->role != 'admin')
                                    <button
                                        id="openModal-{{ $forkom->id }}-{{ $forkom->instagram }}-{{ $forkom->x }}-{{ $forkom->facebook }}-{{ $forkom->tiktok }}"
                                        data-modal-id="{{ $forkom->id }}-{{ $forkom->instagram }}-{{ $forkom->x }}-{{ $forkom->facebook }}-{{ $forkom->tiktok }}"
                                        class="bg-primary text-white px-4 py-2 rounded open-modal">Profile</button>
                                @endif


                            </div>
                            @php setlocale(LC_TIME, 'id_ID.utf8'); @endphp
                            <h1 class="text-gray-400">{{ strftime('%d %B %Y', strtotime($forkom->date)) }}</h1>
                        </div>
                        <div class="mt-4 text-gray-500">
                            <h1>
                                {{ Str::limit($forkom->pertanyaan, 600, '...') }}
                            </h1>
                        </div>

                        <a href="/diskusi/detail/{{ $forkom->id_forkom }}"
                            class="hover:scale-105 duration-150 hover:font-bold">
                            <div class="mt-4 flex gap-3 items-center text-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                    <path
                                        d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                                    <path
                                        d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125m.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2" />
                                </svg>
                                <h1>{{ $total_tanggapan[$forkom->id_forkom] ?? 0 }} Tanggapan ></h1>
                            </div>

                        </a>
                    </div>
                </div>
                @if (Auth::check())
                    @if ($forkom->id_user == Auth::user()->id)
                        <div class="flex flex-col gap-2 items-center">
                            <form action={{ route('forkom.destroy', $forkom->id_forkom) }} class="text-white"
                                method="POST">
                                @csrf
                                @method('delete')
                                <button onclick="return confirm('Apakah kamu yakin?')"
                                    class="bg-red-500 p-2 rounded-2xl "><svg xmlns="http://www.w3.org/2000/svg"
                                        width="16" height="16" fill="currentColor" class="bi bi-trash2"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M14 3a.7.7 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.7.7 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2M3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5s-3.69-.311-4.785-.793" />
                                    </svg>
                                </button>
                            </form>
                            <button class="bg-orange-300 p-2 rounded-2xl text-white"
                                onclick="openModal('{{ $forkom->id_forkom }}', '{{ $forkom->judul }}', '{{ $forkom->pertanyaan }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                </svg>
                            </button>

                        </div>
                    @endif

                    @if (Auth::check())
                        @if (Auth::user()->role == $forkom->role)
                        @else
                            @if (Auth::user()->role == 'admin')
                                <form action={{ route('forkom.destroy', $forkom->id_forkom) }} class="text-white"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('Apakah kamu yakin?')"
                                        class="bg-red-500 p-2 rounded-2xl "><svg xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="16" fill="currentColor" class="bi bi-trash2"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M14 3a.7.7 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.7.7 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2M3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5s-3.69-.311-4.785-.793" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        @endif
                    @endif
                @endif
            </div>
            <div id="editModal" class="fixed z-[80] inset-0 overflow-y-auto hidden">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>

                    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all md:w-96">
                        <div class="bg-white p-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center">
                                    <h3 class="text-lg font-medium text-gray-900" id="modal-title">Edit
                                        Forkom</h3>
                                    <form action="{{ route('forkom.update', $forkom->id_forkom) }}" method="POST">
                                        @csrf
                                        <div class="mt-2 text-start">
                                            <h1>Judul</h1>
                                            <input id="modal-textarea" name="judul"
                                                class="w-[22rem] p-2 border rounded-lg"></input>
                                        </div>
                                        <div class="mt-2 text-start">
                                            <h1>Pertanyaan</h1>
                                            <textarea id="modal-pertanyaan" name="pertanyaan" class="w-[22rem] p-2 border rounded-lg"></textarea>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary  text-white text-base font-medium  hover:bg-primary/80 sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
                            </form>
                            <button type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm"
                                onclick="closeModal()">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @if (isset($_GET['judul']) == null)
            <ul class="flex mt-10 justify-center gap-2 text-xl">
                @for ($i = 1; $i <= $forkoms->lastPage(); $i++)
                    <li>
                        <a href="?page={{ $i }}@if (request()->has('sort_by') && request()->sort_by != null) &sort_by={{ request()->sort_by }} @endif"
                            class="text-dark px-2 py-1 rounded-md @if ($forkoms->currentPage() === $i) bg-primary text-white @endif">
                            {{ $i }}
                        </a>
                    </li>
                @endfor
            </ul>
        @endif

        @foreach ($sosmeds as $sosmed)
            <div id="detail-modal-{{ $sosmed->id }}" class="fixed z-[80] inset-0 overflow-y-auto hidden">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>

                    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all md:w-96">
                        <div class="bg-white p-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center">
                                    <h3 class="text-lg font-medium text-gray-900" id="modal-title">Profile</h3>

                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary  text-white text-base font-medium  hover:bg-primary/80 sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
                            </form>
                            <button type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm"
                                onclick="closeModal({{ $sosmed->id }})">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all open modal buttons
            const openModalButtons = document.querySelectorAll('.open-modal');

            // Add click event listener to each button
            openModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const modalId = this.getAttribute('data-modal-id');
                    const modal = document.getElementById(`myModal-${modalId}`);
                    modal.classList.remove('hidden');
                });
            });

            // Get all close modal buttons
            const closeModalButtons = document.querySelectorAll('.close-modal');

            // Add click event listener to each close button
            closeModalButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const modal = this.closest('.fixed.inset-0');
                    modal.classList.add('hidden');
                });
            });
        });
    </script>
@endsection
