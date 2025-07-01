<main>
    <header>
        <div class="flex justify-center w-full  h-full ">
            <nav class=" fixed  py-8 w-full z-20 border-b-2 border-b-gray-300/50 bg-white">
                <div class="wrapper flex justify-between  items-center w-full">
                    <a href="/">
                        <img src={{ asset('assets/img/logo.svg') }} class="w-[90%]" alt="Logo">
                    </a>
                    <ul class="hidden md:flex gap-4 items-center">
                        <li><a href="/"
                                class="{{ Request::is('/') || Request::is('surah*') ? 'font-bold' : 'hover:font-bold duration-150 ' }} ">Home</a>
                        </li>

                        <li><a href="/diskusi"
                                class="{{ Request::is('diskusi*') ? 'font-bold' : 'hover:font-bold duration-150 ' }} ">Diskusi</a>
                        </li>
                        <li><a href="/doa"
                                class="{{ Request::is('doa*') ? 'font-bold' : 'hover:font-bold duration-150 ' }} ">Doa</a>
                        </li>
                    </ul>
                    <div class="flex gap-4 items-center">
                        @if (Auth::check())
                            <a href="/dashboard"
                                class="text-primary border-2 rounded-full border-primary px-3 py-2 font-semibold">
                                Dashboard</a>
                        @else
                            <a href="/register"
                                class="text-primary border-2 rounded-full border-primary px-3 py-2 font-semibold">Sign
                                Up</a>
                            <a href="/login" class="text-slate-900 font-semibold">Login</a>
                        @endif
                    </div>
                </div>
            </nav>
            <div class="flex md:hidden justify-center">
                <nav class="fixed bottom-8 z-[40]">
                    <div class="bg-primary text-white text-lg font-bold   w-fit rounded-full p-6">
                        <ul class="flex gap-4 items-center">
                            <li><a href="/"
                                    class="{{ Request::is('/') || Request::is('surah*') ? 'bg-white text-primary p-2 rounded-full' : 'hover:font-bold duration-150 ' }}">Home</a>
                            </li>
                            <li><a href="/diskusi"
                                    class="{{ Request::is('diskusi*') ? 'bg-white text-primary p-2 rounded-full' : 'hover:font-bold duration-150 ' }}">Diskusi</a>
                            </li>
                            <li><a href="/doa"
                                    class="{{ Request::is('doa*') || Request::is('surah*') ? 'bg-white text-primary p-2 rounded-full' : 'hover:font-bold duration-150 ' }}">Doa</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

    </header>
</main>
