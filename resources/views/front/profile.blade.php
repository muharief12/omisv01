<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | ABC Coffee Shop</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- Topbar -->
    <section class="relative flex items-center justify-between w-full gap-5 wrapper">
        <a href="{{ url('/')}}" class="p-2 bg-white rounded-full">
            <img src="{{ asset('assets/svgs/ic-arrow-left.svg') }}" class="size-5" alt="">
        </a>
        <p class="absolute text-base font-semibold translate-x-1/2 -translate-y-1/2 top-1/2 right-1/2">
            Profile
        </p>
    </section>

    <!-- Payment Method -->
    <section class="wrapper flex flex-col gap-2.5">
        <div class="flex items-center justify-between">
            <p class="text-base font-bold">
                Your Achievement
            </p>
        </div>
        <div class="grid items-center grid-cols-2 gap-4">
            <label
                class="relative rounded-2xl bg-white flex gap-2.5 px-3.5 py-3 items-center justify-start has-[:checked]:ring-2 has-[:checked]:ring-primary transition-all">
                <!-- <input type="radio" name="payment_method" id="manualMethod" class="absolute opacity-0"> -->
                <img src="{{ asset('assets/svgs/ic-receipt-text-filled.svg') }}" alt="">
                <div class="flex flex-col">
                    <p class="text-base font-semibold">
                        Point
                    </p>
                    <p class="text-base font-normal">
                        {{ $point }} Points
                    </p>
                </div>
            </label>
            <label
                class="relative rounded-2xl bg-white flex gap-2.5 px-3.5 py-3 items-center justify-start has-[:checked]:ring-2 has-[:checked]:ring-primary transition-all">
                <!-- <input type="radio" name="payment_method" id="creditMethod" class="absolute opacity-0"> -->
                <img src="{{ asset('assets/svgs/ic-card-filled.svg') }}" alt="">
                <div class="flex flex-col">
                    <a href="{{ route('orders')}}">
                        <p class="text-base font-semibold">
                            Transaction
                        </p>
                    </a>
                    <p class="text-base font-normal">
                        {{ number_format($transaction) }} Trx
                    </p>
                </div>
            </label>
            <label
                class="relative rounded-2xl bg-white flex gap-2.5 px-3.5 py-3 items-center justify-start has-[:checked]:ring-2 has-[:checked]:ring-primary transition-all">
                <!-- <input type="radio" name="payment_method" id="creditMethod" class="absolute opacity-0"> -->
                <img src="{{ asset('assets/svgs/ic-card-filled.svg') }}" alt="" />
                <div class="flex flex-col">
                    <a href="{{ route('index_complaint') }}">
                        <p class="text-base font-semibold">
                            Complaint
                        </p>
                    </a>
                    <p class="text-base font-normal">
                        {{ number_format($complaint) }} Items
                    </p>
                </div>
            </label>
            <label
                class="relative rounded-2xl bg-white flex gap-2.5 px-3.5 py-3 items-center justify-start has-[:checked]:ring-2 has-[:checked]:ring-primary transition-all">
                <img src="{{ asset('assets/svgs/ic-receipt-text-filled.svg') }}" alt="">
                <div class="flex flex-col">
                    <p class="text-base font-semibold">
                        Comission
                    </p>
                    <p class="text-base font-normal">
                        <!-- <span class="inline-flex items-center rounded-md bg-red-400/10 px-2 py-1 text-xs font-medium text-red-500 inset-ring inset-ring-red-400/20">Development</span> -->
                        Rp {{ number_format($comission) }}
                    </p>
                </div>
            </label>
        </div>
    </section>

    <!-- Delivery to -->
    <section class="wrapper flex flex-col gap-2.5 pb-40">
        <div class="flex items-center justify-between">
            <p class="text-base font-bold">
                My Profile
            </p>
            <button type="button" class="p-2 bg-white rounded-full" data-expand="deliveryForm">
                <img src="{{ asset('assets/svgs/ic-chevron.svg') }}" class="transition-all duration-300 -rotate-180 size-5" alt="">
            </button>
        </div>
        <form action="{{ route('my_profile.update')}}" method="POST" enctype="multipart/form-data" class="p-6 bg-white rounded-3xl" id="deliveryForm">
            @csrf
            <div class="flex flex-col gap-5">
                <!-- Name -->
                <div class="flex flex-col gap-2.5">
                    <label for="name" class="text-base font-semibold">Name</label>
                    <input type="name" name="name" value="{{ $user->name }}" id="email__"
                        class="form-input" style="background-image: url('{{ asset('assets/svgs/ic-profile.svg') }}')" placeholder="Your email address">
                </div>
                <!-- Email Address -->
                <div class="flex flex-col gap-2.5">
                    <label for="email" class="text-base font-semibold">Email Address</label>
                    <input type="email" name="email" value="{{ $user->email }}" readonly id="email__"
                        class="form-input" style="background-image: url('{{ asset('assets/svgs/ic-email.svg') }}')" placeholder="Your email address">
                </div>
                <!-- Password -->
                <div class="flex flex-col gap-2.5">
                    <label for="password" class="text-base font-semibold">Password</label>
                    <input type="password" name="password" value="{{ $user->password }}" id="password__"
                        class="form-input" style="background-image: url('{{ asset('assets/svgs/ic-lock.svg') }}')" placeholder="Protect your password">
                </div>
                <!-- AM Code -->
                <div class="flex flex-col gap-2.5">
                    <label for="affiliate_code" class="text-base font-semibold">Affiliate Code</label>
                    <input type="text" name="affiliate_code" value="{{ $user->affiliate_code ?? $affiliateCode }}" id="affiliate_code"
                        class="form-input" style="background-image: url('{{ asset('assets/svgs/ic-profile.svg') }}')" placeholder="Your Affiliate Code">
                </div>
                <!-- Address -->
                <div class="flex flex-col gap-2.5">
                    <label for="address" class="text-base font-semibold">Address</label>
                    <input type="text" value="{{ $user->address}}" name="address" id="address__"
                        class="form-input bg-[url('{{ asset('assets/svgs/ic-location.svg') }}')]" placeholder="Gonilan">
                </div>
                <!-- City -->
                <div class="flex flex-col gap-2.5">
                    <label for="city" class="text-base font-semibold">City</label>
                    <input type="text" name="city" value="{{ $user->city }}" id="city__" class="form-input bg-[url('{{ asset('assets/svgs/ic-map.svg') }}')]"
                        placeholder="Sukoharjo">
                </div>
                <!-- Post Code -->
                <div class="flex flex-col gap-2.5">
                    <label for="postal_code" class="text-base font-semibold">Post Code</label>
                    <input type="number" name="postal_code" value="{{ $user->postal_code }}" id="postcode__"
                        class="form-input bg-[url('{{ asset('assets/svgs/ic-house.svg') }}')]" placeholder="57374">
                </div>
                <!-- Phone Number -->
                <div class="flex flex-col gap-2.5">
                    <label for="phone_number" class="text-base font-semibold">Phone Number</label>
                    <input type="number" name="phone_number" value="{{ $user->phone_number }}" id="phonenumber__"
                        class="form-input bg-[url('{{ asset('assets/svgs/ic-phone.svg') }}')]" placeholder="62821192301923">
                </div>
                <!-- profession -->
                <div class="flex flex-col gap-2.5">
                    <label for="notes" class="text-base font-semibold">Profession</label>
                    <span class="relative">
                        <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="absolute size-5 top-4 left-4" alt="">
                        <input name="profession" id="profession__" value="{{ $user->profession }}"
                            class="form-input" placeholder="Pelajar/Wirausaha/dll" />
                    </span>
                </div>
                <!-- bod -->
                <div class="flex flex-col gap-2.5">
                    <label for="bod" class="text-base font-semibold">Birth of Date</label>
                    <span class="relative">
                        <img src="{{ asset('assets/svgs/ic-note.svg') }}" class="absolute size-5 top-4 left-4" alt="">
                        <input name="bod" type="date" id="bod__" value="{{ $user->bod }}"
                            class="form-input" />
                    </span>
                </div>
                <button type="submit" class="inline-flex items-center justify-center px-5 py-3 text-base font-bold text-white rounded-full w-full bg-primary whitespace-nowrap">
                    Update Profile
                </button>
                <!-- Proof of Payment -->
                <!-- <div class="flex flex-col gap-2.5">
                    <label for="proof" class="text-base font-semibold">Proof of Payment</label>
                    <input type="file" name="proof" id="proof_of_payment__"
                        class="form-input bg-[url('{{ asset('assets/svgs/ic-folder-add.svg') }}')]">
                </div> -->
            </div>
    </section>

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
            <a href="#" class="flex flex-col items-center justify-center gap-1 px-1 group">
                <img src="{{ asset('assets/svgs/ic-location.svg') }}" class="filter-to-grey group-[.is-active]:filter-to-primary"
                    alt="">
                <p
                    class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Stores
                </p>
            </a>
            <a href="{{ route('orders') }}" class="flex flex-col items-center justify-center gap-1 px-1 group">
                <img src="{{ asset('assets/svgs/ic-note.svg') }}" class="filter-to-grey group-[.is-active]:filter-to-primary" alt="">
                <p
                    class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Orders
                </p>
            </a>
            <a href="{{ route('my_profile')}}" class="flex flex-col items-center justify-center gap-1 px-1 group {{ request()->is('my-profile*') ? 'is-active' : ''}}">
                <img src="{{ asset('assets/svgs/ic-profile.svg') }}" class="filter-to-grey group-[.is-active]:filter-to-primary"
                    alt="">
                <p
                    class="border-b-4 border-transparent group-[.is-active]:border-primary pb-3 text-xs text-center font-semibold text-grey group-[.is-active]:text-primary">
                    Profile
                </p>
            </a>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('scripts/global.js') }}"></script>
</body>

</html>