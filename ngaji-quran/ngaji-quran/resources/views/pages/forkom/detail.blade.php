@extends('welcome')

@section('content')
    <section id="detail" class="wrapper mt-40">
        <div class="mt-10 p-4 border-2 shadow-md hover:border-primary rounded-2xl duration-150">
            <h1 class="text-2xl font-bold">{{ $user_forkom->judul }}</h1>
            <div class="mt-4 flex flex-col md:flex-row justify-between gap-4 md:gap-0 md:items-center">
                <div class="flex gap-3 items-center">
                    @if (Auth::check())
                        @if ($user_forkom->foto_profile == null)
                            <img alt="image" src="{{ asset('assets-dashboard/img/avatar/avatar-1.png') }}"
                                class="w-12 h-12 rounded-full object-cover object-center">
                        @else
                            <img alt="image" src="{{ asset($user_forkom->foto_profile) }}"
                                class="w-12 h-12 rounded-full object-cover object-center">
                        @endif
                    @elseif($user_forkom->foto_profile != null)
                        <img alt="image" src="{{ asset($user_forkom->foto_profile) }}"
                            class="w-12 h-12 rounded-full object-cover object-center">
                    @else
                        <img alt="image" src="{{ asset('assets-dashboard/img/avatar/avatar-1.png') }}"
                            class="w-12 h-12 rounded-full object-cover object-center">
                    @endif
                    <div class="flex flex-col">
                        <h1 class="font-semibold text-lg">{{ $user_forkom->name }}</h1>
                        @if ($user_forkom->status == 'Verified' || Auth::user()->role == 'admin')
                            <div class="text-primary">Verified User</div>
                        @else
                            <span class="text-red-500">Unverified</span>
                        @endif
                    </div>
                </div>
                @php setlocale(LC_TIME, 'id_ID.utf8'); @endphp
                <h1 class="text-gray-400">{{ strftime('%d %B %Y', strtotime($user_forkom->date)) }}</h1>
            </div>
            <div class="mt-4 text-gray-500">
                <h1 id="pertanyaan-short-{{ $user_forkom->id_forkom }}">
                    {{ Str::limit($user_forkom->pertanyaan, 600, '...') }}
                    @if (Str::length($user_forkom->pertanyaan) > 600)
                        <a href="javascript:void(0);" onclick="toggleText({{ $user_forkom->id_forkom }})"
                            id="read-more-{{ $user_forkom->id_forkom }}" class="text-primary font-bold">Baca
                            Selengkapnya</a>
                    @endif
                </h1>
                <h1 id="pertanyaan-full-{{ $user_forkom->id_forkom }}" class="hidden">
                    {{ $user_forkom->pertanyaan }}
                    <a href="javascript:void(0);" onclick="toggleText({{ $user_forkom->id_forkom }})"
                        id="read-less-{{ $user_forkom->id_forkom }}" class="text-primary font-bold">Tutup</a>
                </h1>
            </div>

            <div class="mt-4 flex gap-3 items-center text-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-chat-dots" viewBox="0 0 16 16">
                    <path
                        d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                    <path
                        d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9 9 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.4 10.4 0 0 1-.524 2.318l-.003.011a11 11 0 0 1-.244.637c-.079.186.074.394.273.362a22 22 0 0 0 .693-.125m.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6-3.004 6-7 6a8 8 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a11 11 0 0 0 .398-2" />
                </svg>
                <h1>{{ $total_tanggapan }} Tanggapan</h1>
            </div>
        </div>
    </section>
    <section id="answer" class="wrapper">
        <h1 class="text-center text-slate-400 font-semibold my-6 text-xl">Tanggapan</h1>
        @session('success')
            <div class="wrapper my-4">
                <div
                    class="p-4  border-2 shadow-md hover:border-primary rounded-2xl duration-150 border-green-500 bg-green-100">
                    <div class="flex gap-3 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                        </svg>
                        <h1>{{ session('success') }}</h1>
                    </div>
                </div>
            </div>
            <script>
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            </script>
        @endsession
        <div class="bg-white w-full h-40 flex justify-center items-center rounded-2xl shadow-md border-2">
            @if (Auth::check())
                <form action="{{ route('forkom_detail.create', $user_forkom->id_forkom) }}" method="POST"
                    class="flex flex-col md:flex-row  gap-2 md:gap-20 md:items-center">
                    @csrf
                    <input type="text" name="tanggapan" class="md:w-[35rem] rounded-xl border-2 border-slate-300 h-14"
                        placeholder="Tulis tanggapanmu..">
                    <button onclick="return confirm('Apakah kamu yakin?')"
                        class="bg-primary text-white px-3 py-2 rounded-2xl">Kirim</button>
                </form>
            @else
                <h1>Kamu harus login untuk memberikan tanggapan.</h1>
            @endif
        </div>
    </section>

    @session('delete')
        <div class="wrapper mt-4">
            <div class="p-4  border-2 shadow-md  rounded-2xl duration-150  bg-red-200">
                <div class="flex gap-3 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                    <h1>{{ session('delete') }}</h1>
                </div>
            </div>
            <script>
                setTimeout(function() {
                    window.location.reload();
                }, 700);
            </script>
        </div>
    @endsession
    @session('update')
        <div class="wrapper mt-4">
            <div class="p-4  border-2 shadow-md  rounded-2xl duration-150  bg-yellow-200">
                <div class="flex gap-3 items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                    <h1>{{ session('update') }}</h1>
                </div>
            </div>
            <script>
                setTimeout(function() {
                    window.location.reload();
                }, 700);
            </script>
        </div>
    @endsession
    <section id="tanggapan" class="wrapper gap-4 mt-10 grid grid-cols-1 md:grid-cols-2">
        @foreach ($tanggapan_forkoms as $tanggapan)
            <div
                class="p-4 border-2 shadow-md hover:border-primary rounded-2xl duration-150
               @if (Auth::check()) @if ($tanggapan->id_user == Auth::user()->id) border-primary @endif
                @endif">
                <div class="mt-4 flex flex-col md:flex-row justify-between gap-4 md:gap-0 md:items-center">
                    <div class="flex gap-3 items-center">
                        @if (Auth::check())
                            @if ($tanggapan->foto_profile == null)
                                <img alt="image" src="{{ asset('assets-dashboard/img/avatar/avatar-1.png') }}"
                                    class="w-12 h-12 rounded-full object-cover object-center">
                            @else
                                <img alt="image" src="{{ asset($tanggapan->foto_profile) }}"
                                    class="w-12 h-12 rounded-full object-cover object-center">
                            @endif
                        @elseif($tanggapan->foto_profile != null)
                            <img alt="image" src="{{ asset($tanggapan->foto_profile) }}"
                                class="w-12 h-12 rounded-full object-cover object-center">
                        @else
                            <img alt="image" src="{{ asset('assets-dashboard/img/avatar/avatar-1.png') }}"
                                class="w-12 h-12 rounded-full object-cover object-center">
                        @endif
                        <div class="flex flex-col">
                            <h1 class="font-semibold text-lg">{{ $tanggapan->name }}</h1>
                            @if ($tanggapan->status == 'Verified' || $tanggapan->role == 'admin')
                                <div class="text-primary">Verified User</div>
                            @else
                                <span class="text-red-700">Unverified</span>
                            @endif
                        </div>
                        @if (Auth::check())
                            @if ($tanggapan->id_user == Auth::user()->id)
                                <div class="flex gap-2 items-center">
                                    @if (Auth::user()->role != 'admin')
                                        <form action={{ route('forkom_detail.destroy', $tanggapan->id_forkom_detail) }}
                                            class="text-white" method="POST">
                                            @csrf
                                            <button onclick="return confirm('Apakah kamu yakin?')"
                                                class="bg-red-500 p-2 rounded-2xl "><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-trash2" viewBox="0 0 16 16">
                                                    <path
                                                        d="M14 3a.7.7 0 0 1-.037.225l-1.684 10.104A2 2 0 0 1 10.305 15H5.694a2 2 0 0 1-1.973-1.671L2.037 3.225A.7.7 0 0 1 2 3c0-1.105 2.686-2 6-2s6 .895 6 2M3.215 4.207l1.493 8.957a1 1 0 0 0 .986.836h4.612a1 1 0 0 0 .986-.836l1.493-8.957C11.69 4.689 9.954 5 8 5s-3.69-.311-4.785-.793" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                    <button class="bg-orange-300 p-2 rounded-2xl text-white"
                                        onclick="openModal2('{{ $tanggapan->id_forkom_detail }}', '{{ $tanggapan->tanggapan }}')">
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
                            @if (Auth::user()->role == 'admin')
                                <form action={{ route('forkom_detail.destroy', $tanggapan->id_forkom_detail) }}
                                    class="text-white" method="POST">
                                    @csrf
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
                    </div>
                    @php setlocale(LC_TIME, 'id_ID.utf8'); @endphp
                    <h1 class="text-gray-400">{{ strftime('%d %B %Y', strtotime($tanggapan->date)) }}</h1>
                </div>
                <div class="mt-4 text-gray-500">
                    <h1 id="pertanyaan-short-{{ $tanggapan->id_forkom_detail }}">
                        {{ Str::limit($tanggapan->tanggapan, 600, '...') }}
                        @if (Str::length($tanggapan->tanggapan) > 600)
                            <a href="javascript:void(0);" onclick="toggleText({{ $tanggapan->id_forkom_detail }})"
                                id="read-more-{{ $tanggapan->id_forkom_detail }}" class="text-primary font-bold">Baca
                                Selengkapnya</a>
                        @endif
                    </h1>
                    <h1 id="pertanyaan-full-{{ $tanggapan->id_forkom_detail }}" class="hidden">
                        {{ $tanggapan->tanggapan }}
                        <a href="javascript:void(0);" onclick="toggleText({{ $tanggapan->id_forkom_detail }})"
                            id="read-less-{{ $tanggapan->id_forkom_detail }}" class="text-primary font-bold">Tutup</a>
                    </h1>
                </div>


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
                                        Tanggapan</h3>
                                    <form action="{{ route('forkom_detail.update', $tanggapan->id_forkom_detail) }}"
                                        method="POST">
                                        @csrf
                                        <div class="mt-2">
                                            <textarea id="modal-textarea" name="tanggapan" class="w-[22rem] p-2 border rounded-lg"></textarea>
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
                                onclick="closeModal2()">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section>
    <script>
        function openModal2(tanggapanId, tanggapanText) {
            document.getElementById('modal-textarea').value = tanggapanText;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeModal2() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>


@endsection
