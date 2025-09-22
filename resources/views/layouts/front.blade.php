<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') Page | OMIS v01</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
</head>

<body>
    <!-- Topbar -->
    <section class="flex items-center justify-between gap-5 wrapper">
        @guest
        <a href="{{ url('login')}}" class="inline-flex w-max text-white font-bold text-base bg-primary rounded-full px-[30px] py-3 justify-center items-center whitespace-nowrap">
            Login
        </a>
        @endguest
        @auth
        <div class="flex items-center gap-3">
            <div class="bg-white rounded-full p-[5px] flex justify-center items-center">
                <!-- <img src="{{ asset('assets/svgs/avatar.svg') }}" class="size-[50px] rounded-full" alt=""> -->
                <img src="{{ 'Storage/' . App\Models\AdminFee::where('is_active', true)->first()->logo }}" class="size-[50px] rounded-full" alt="">
            </div>
            <div class="">
                <p class="text-base font-semibold capitalize text-primary">
                    {{ Auth::user()->name}}
                </p>
                <p class="text-sm">
                    Welcome Back!
                </p>
            </div>
        </div>
        @endauth
        <div class="flex items-center gap-[10px]">
            @auth
            <form action="{{ route('logout')}}" method="post">
                @csrf
                <button type="submit" class="inline-flex w-max text-white font-bold text-sm bg-red-500 rounded-full px-1 py-2 justify-center items-center whitespace-nowrap">
                    Logout
                </button>
            </form>
            @endauth
            <button class="p-2 bg-white rounded-full">
                <span class="relative">
                    <a href="{{ route('carts.index')}}">
                        <img src="{{ asset('assets/svgs/ic-shopping-bag.svg') }}" class="size-5" alt="">
                    </a>
                    @if (Auth::user()->carts()->count() > 0)
                    <!-- notification dot -->
                    <span class="block rounded-full size-1.5 bg-primary absolute top-0 right-0 -translate-x-1/2"></span>
                    @endif
                </span>
            </button>
        </div>
    </section>

    @yield('content')

    <!-- Floating navigation -->
    <nav class="fixed z-50 bottom-[30px] bg-black rounded-[50px] pt-[18px] px-10 left-1/2 -translate-x-1/2 w-80">
        <div class="flex items-center justify-center gap-5 flex-nowrap">
            <a href="/" class="flex flex-col items-center justify-center gap-1 px-1 group {{ request()->is('/') ? 'is-active' : ''}}">
                <img src="{{ asset('assets/svgs/ic-grid.svg') }}" class="filter-to-grey group-[.is-active]:filter-to-primary" alt="">
                <p
                    class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Home
                </p>
            </a>
            <a href="{{ route('posts')}}" class="flex flex-col items-center justify-center gap-1 px-1 group {{ request()->is('posts*') ? 'is-active' : ''}}">
                <img src="{{ asset('assets/svgs/ic-location.svg') }}" class="filter-to-grey group-[.is-active]:filter-to-primary"
                    alt="">
                <p
                    class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Articels
                </p>
            </a>
            <a href="{{ route('orders') }}" class="flex flex-col items-center justify-center gap-1 px-1 group {{ request()->is('orders*') ? 'is-active' : ''}}">
                <img src="{{ asset('assets/svgs/ic-note.svg') }}" class="filter-to-grey group-[.is-active]:filter-to-primary" alt="">
                <p
                    class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Orders
                </p>
            </a>
            <a href="{{ route('my_profile')}}" class="flex flex-col items-center justify-center gap-1 px-1 group {{ request()->is('my-profile*') ? 'is-active' : '' }}">
                <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="filter-to-grey group-[.is-active]:filter-to-primary"
                    alt="">
                <p
                    class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Profile
                </p>
            </a>
        </div>
    </nav>

    @stack('prepend-script')
    <script src="{{ url('https://code.jquery.com/jquery-3.7.1.min.js') }}" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ url('https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js') }}"></script>

    <script src="{{ asset('scripts/sliderConfig.js') }}" type="module"></script>
    {{-- <script src="{{ asset('scripts/searchProductListener.js') }}" type="module"></script> --}}
    @stack('after-script')
</body>

</html>