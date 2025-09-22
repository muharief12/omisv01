@extends('layouts.front')

@section('title', 'Posts')

@section('content')
<!-- Topbar -->
<section class="relative flex items-center justify-between gap-5 wrapper">
    <a href="{{ url('/')}}" class="p-2 bg-white rounded-full">
        <img src="{{ asset('assets/svgs/ic-arrow-left.svg') }}" class="size-5" alt="">
    </a>
    <p class="absolute text-base font-semibold translate-x-1/2 -translate-y-1/2 top-1/2 right-1/2">
        Our Articles
    </p>
    <button type="button" class="p-2 bg-white rounded-full">
        <img src="{{ asset('assets/svgs/ic-triple-dots.svg') }}" class="size-5" alt="">
    </button>
</section>


<!-- Search Results -->
<section class="wrapper flex flex-col gap-2.5">
    <div class="flex flex-col gap-4">
        @forelse ($posts as $post)
        <!-- <div class="py-3.5 pl-4 pr-[22px] bg-white border-l-4 border-bg-red rounded-2xl flex gap-1 items-center relative">
            <div class="flex flex-wrap items-center justify-between w-full gap-1">
                <img src="{{ Storage::url($post->image) }}" alt="" class="w-[50px] h-[100%] object-cover" />
                <div class="flex flex-col gap-1">
                    <a href="{{ route('post_detail', $post->slug)}}" class="text-base font-semibold stretched-link whitespace-nowrap w-[150px] truncate">
                        {{ $post->title }}
                    </a>
                    <p class="text-sm text-bold">
                        oleh {{ $post->user->name }}
                    </p>
                    <p class="text-sm text-base">
                        {{ \Carbon\Carbon::parse($post->created_at)->isoFormat('DD MMMM YYYY')}}
                    </p>
                    <span class="inline-flex items-center rounded-md bg-green-400/10 px-2 py-1 text-xs font-medium text-green-400 inset-ring inset-ring-green-500/20">{{ $post->postType->name }}</span>
                </div>
            </div>
        </div> -->
        <div class="flex bg-white border-l-4 border-red-500 rounded-2xl overflow-hidden shadow-sm">
            <!-- Gambar di sisi kiri full height -->
            <div class="w-32 h-full">
                <img src="{{ Storage::url($post->image) }}" alt="" class="w-full h-full object-cover" />
            </div>

            <!-- Konten di sisi kanan -->
            <div class="flex flex-col justify-between p-4 gap-2 w-full">
                <a href="{{ route('post_detail', $post->slug) }}" class="text-base font-semibold whitespace-nowrap truncate w-full">
                    {{ $post->title }}
                </a>
                <p class="text-sm font-semibold text-base">
                    oleh {{ $post->user->name }}
                </p>
                <p class="text-sm text-base">
                    {{ \Carbon\Carbon::parse($post->created_at)->isoFormat('DD MMMM YYYY') }}
                </p>
                <span class="inline-flex items-center rounded-md bg-green-400/10 px-2 py-1 text-xs font-medium text-green-500 ring-1 ring-green-500/20 w-max">
                    {{ $post->postType->name }}
                </span>
            </div>
        </div>

        @empty
        <p class="text-center text-red-500">The post article isn't ready</p>
        @endforelse
    </div>
</section>
@endsection