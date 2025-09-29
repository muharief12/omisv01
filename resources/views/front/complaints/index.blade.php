<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints | ABC Coffee Shop</title>
    <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>

<body>
    <!-- Topbar -->
    <section class="relative flex items-center justify-between gap-5 wrapper">
        <a href="{{ url('/')}}" class="p-2 bg-white rounded-full">
            <img src="{{ asset('assets/svgs/ic-arrow-left.svg') }}" class="size-5" alt="">
        </a>
        <p class="absolute text-base font-semibold translate-x-1/2 -translate-y-1/2 top-1/2 right-1/2">
            Complaint History
        </p>
        <button type="button" class="p-2 bg-white rounded-full">
            <img src="{{ asset('assets/svgs/ic-triple-dots.svg') }}" class="size-5" alt="">
        </button>
    </section>


    <!-- Search Results -->
    <section class="wrapper flex flex-col gap-2.5">
        <p class="text-base font-bold">
            Your Complaints ({{$complaints->count()}})
        </p>
        <div class="flex flex-col gap-4">
            @forelse ($complaints as $complaint)
            <div class="py-3.5 pl-4 pr-[22px] bg-white border-l-4 border-[rgb(253,145,90)] rounded-2xl flex gap-1 items-center relative">

                <div class="flex flex-wrap items-center justify-between w-full gap-1">
                    <div class="flex flex-col gap-1">
                        <a href="{{ route('edit_complaint', $complaint->id) }}" class="text-base font-semibold stretched-link whitespace-nowrap w-[150px] truncate">
                            {{ $complaint->order->code }}
                        </a>
                        <p class="text-sm text-base">
                            {{ $complaint->title }}
                        </p>
                        <p class="text-sm text-base">
                            {{ \Carbon\Carbon::parse($complaint->created_at)->isoFormat('DD MMMM YYYY')}}
                        </p>
                    </div>
                    <div class="">
                        <!-- <img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
                        <img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
                        <img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
                        <img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
                        <img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt=""> -->
                        @if ($complaint->status === 'submission')
                        <span class="inline-flex items-center rounded-md bg-red-400/10 px-2 py-1 text-xs font-medium text-red-500 inset-ring inset-ring-red-400/20">Submission</span>
                        @elseif ($complaint->status === 'process')
                        <span class="inline-flex items-center rounded-md bg-blue-400/10 px-2 py-1 text-xs font-medium text-blue-400 inset-ring inset-ring-blue-500/20">In Process</span>
                        @else
                        <span class="inline-flex items-center rounded-md bg-green-400/10 px-2 py-1 text-xs font-medium text-green-400 inset-ring inset-ring-green-500/20">{{ $complaint->status}}</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-red-500">The complaint data isn't ready</p>
            @endforelse
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('scripts/searchProductListener.js') }}" type="module"></script> --}}
</body>

</html>