{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
@csrf

<!-- Name -->
<div>
  <x-input-label for="name" :value="__('Name')" />
  <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
  <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<!-- Email Address -->
<div class="mt-4">
  <x-input-label for="email" :value="__('Email')" />
  <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
  <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Password -->
<div class="mt-4">
  <x-input-label for="password" :value="__('Password')" />

  <x-text-input id="password" class="block mt-1 w-full"
    type="password"
    name="password"
    required autocomplete="new-password" />

  <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Confirm Password -->
<div class="mt-4">
  <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

  <x-text-input id="password_confirmation" class="block mt-1 w-full"
    type="password"
    name="password_confirmation" required autocomplete="new-password" />

  <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>

<div class="flex items-center justify-end mt-4">
  <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
    {{ __('Already registered?') }}
  </a>

  <x-primary-button class="ms-4">
    {{ __('Register') }}
  </x-primary-button>
</div>
</form>
</x-guest-layout> --}}


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up | Parma</title>
  <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>

  <div class="flex flex-col items-center px-6 py-10 min-h-dvh">
    <img src="{{ asset('assets/svgs/logo.svg') }}" class="mb-[53px]" alt="">
    <form action="{{ route('register')}}" method="POST" class="mx-auto max-w-[345px] w-full p-6 bg-white rounded-3xl mt-auto" id="deliveryForm">
      @csrf
      <div class="flex flex-col gap-5">
        <p class="text-[22px] font-bold">
          New Account
        </p>
        <!-- Full Name -->
        <div class="flex flex-col gap-2.5">
          <label for="fullname" class="text-base font-semibold">Full Name</label>
          <input type="text" name="name" id="fullname__"
            class="form-input" style="background-image: url('{{ asset('assets/svgs/ic-profile.svg') }}')" placeholder="Write your full name">
        </div>
        <!-- Email Address -->
        <div class="flex flex-col gap-2.5">
          <label for="email" class="text-base font-semibold">Email Address</label>
          <input type="email" name="email" id="email__"
            class="form-input" style="background-image: url('{{ asset('assets/svgs/ic-email.svg') }}')" placeholder="Your email address">
        </div>
        <!-- Password -->
        <div class="flex flex-col gap-2.5">
          <label for="password" class="text-base font-semibold">Password</label>
          <input type="password" name="password" id="password__"
            class="form-input" style="background-image: url('{{ asset('assets/svgs/ic-lock.svg') }}')" placeholder="Protect your password">
        </div>
        <!-- Confirm Password -->
        <div class="flex flex-col gap-2.5">
          <label for="password" class="text-base font-semibold">Confirm Password</label>
          <input type="password" name="password_confirmation" id="confirm-password__"
            class="form-input" style="background-image: url('{{ asset('assets/svgs/ic-lock.svg') }}')" placeholder="Protect your password">
        </div>
        <button type="submit" class="inline-flex text-white font-bold text-base bg-primary rounded-full whitespace-nowrap px-[30px] py-3 justify-center items-center" onclick="window.location.href='./login.html'">
          Create My Account
        </button>
      </div>
    </form>
    <a href="{{ route('login')}}" class="font-semibold text-base mt-[30px] underline">
      Sign In to My Account
    </a>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>

</html>