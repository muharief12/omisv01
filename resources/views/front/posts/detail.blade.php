<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Details Post | OMIS</title>
  <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}') }}" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
</head>

<body>
  <!-- Topbar -->
  <section class="relative flex items-center justify-between gap-5 wrapper">
    <a href="{{ route('posts')}}" class="p-2 bg-white rounded-full">
      <img src="{{ asset('assets/svgs/ic-arrow-left.svg') }}" class="size-5" alt="">
    </a>
    <p class="absolute text-base font-semibold translate-x-1/2 -translate-y-1/2 top-1/2 right-1/2">
      Details
    </p>
    <button type="button" class="p-2 bg-white rounded-full">
      <img src="{{ asset('assets/svgs/ic-triple-dots.svg') }}" class="size-5" alt="">
    </button>
  </section>

  <img src="{{ Storage::url($post->image) }}" class="h-[220px] w-auto mx-auto relative z-10" alt="">
  <section class="bg-white rounded-[60px] pt-[60px] pb-[60px] px-6 pb-5 -mt-9 mb-9 flex flex-col gap-5 max-w-[425px] mx-auto">
    <div>
      <div class="items-center justify-between">
        <div class="flex flex-col mb-3 text-center gap-1">
          <p class="font-bold text-[22px]">
            {{ $post->title }}
          </p>
          <p class="font-normal text-base">{{ \Carbon\Carbon::parse($post->created_at)->isoFormat('DD MMMM YYYY') }}</p>
        </div>
      </div>
      <div class="flex items-center justify-between">
        <div class="flex flex-col gap-1">
          <div class="flex items-center gap-1.5">
            <span class="inline-flex items-center rounded-md bg-green-400/10 px-2 py-1 text-xs font-medium text-green-500 ring-1 ring-green-500/20 w-max">
              {{ $post->postType->name }}
            </span>
          </div>
        </div>
        <div class="flex items-center gap-1">
          <img src="{{ asset('assets/svgs/ic-thumb-shape-filled.svg') }}" class="size-6" alt="">
          <p class="font-semibold text-balance">
            {{ number_format($post->like) }} Likes
          </p>
        </div>
      </div>
      <div class="my-3.5 text-justify">
        {!! str($post->content)->sanitizeHtml() !!}
      </div>
    </div>

  </section>

  <script src="{{ url('https://code.jquery.com/jquery-3.7.1.min.js')}}" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="{{ url('https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js')}}"></script>

  <script src="{{ asset('scripts/sliderConfig.js')}}" type="module"></script>
</body>

</html>