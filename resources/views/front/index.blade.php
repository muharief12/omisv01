@extends('layouts.front')

@section('title', 'Home')

@section('content')
<!-- Header -->
<section class="wrapper flex flex-col gap-2.5 items-center justify-center">
	<p class="text-4xl font-extrabold text-center">
		We Provide <br>
		Best Medicines
	</p>
	<form action="{{ route('front.search')}}" method="GET" id="searchForm" class="w-full">
		<input type="text" name="keyword" id="searchProduct"
			class="block w-full py-3.5 pl-4 pr-10 rounded-[50px] font-semibold placeholder:text-grey placeholder:font-normal text-black text-base bg-no-repeat bg-[calc(100%-16px)] focus:ring-2 focus:ring-primary focus:outline-none focus:border-none transition-all"
			style="background-image: url('{{ asset('assets/svgs/ic-search.svg') }}');"
			placeholder="Search by product name"
			value="{{ $keyword}}">
	</form>
</section>

<!-- Your last order -->
<section class="wrapper">
	<div
		style="background-image: url('{{ asset('assets/svgs/pipeline.svg') }}')"
		class="flex justify-between gap-5 items-center bg-lilac py-3.5 px-4 rounded-2xl relative bg-left bg-no-repeat bg-cover">
		<p class="text-base font-bold">
			Your last order has <br>
			been proceed
		</p>
		<img src="{{ asset('assets/svgs/nekodicine.svg') }}" class="w-[90px] h-[70px]" alt="">
	</div>
</section>

<!-- Categories -->
<section class="wrapper !px-0 flex flex-col gap-2.5">
	<p class="px-4 text-base font-bold">
		Categories
	</p>
	<div id="categoriesSlider" class="relative">
		@forelse ($categories as $category)
		<div class="inline-flex gap-2.5 items-center py-3 px-3.5 relative bg-white rounded-xl mr-4">
			<img src="{{ Storage::url($category->icon) }}" class="size-10" alt="">
			<a href="{{ route('front.category', $category->slug) }}" class="text-base font-semibold truncate stretched-link">
				{{ $category->name }}
			</a>
		</div>
		@empty
		<p>The Category is not available</p>
		@endforelse
	</div>
</section>

<!-- Latest Products -->
<section class="wrapper !px-0 flex flex-col gap-2.5">
	<p class="px-4 text-base font-bold">
		Latest Products
	</p>
	<div id="proudctsSlider" class="relative">
		@forelse ($products as $product)
		<div class="rounded-2xl bg-white py-3.5 pl-4 pr-[22px] inline-flex flex-col gap-4 items-start mr-4 relative w-[158px]">
			<img src="{{ Storage::url($product->photo) }}" class="h-[100px] w-full object-contain" alt="">
			<div>
				<a href="{{ route('front.product.details', $product->slug)}}" class="text-base font-semibold w-[120px] truncate stretched-link block">
					{{ $product->name }}
				</a>
				<p class="text-sm truncate text-grey">
					Rp {{ number_format($product->price)}}
				</p>
			</div>
		</div>
		@empty
		<p>The Product Latest is not available</p>
		@endforelse
	</div>
</section>

<!-- Explore -->
<section class="wrapper">
	<div
		style="background-image: url('{{ asset('assets/svgs/doctor-help.svg') }}')"
		class="bg-lilac py-3.5 px-5 rounded-2xl relative bg-right-bottom bg-no-repeat bg-auto">
		<img src="{{ asset('assets/svgs/cloud.svg') }}" class="-ml-1.5 mb-1.5" alt="">
		<div class="flex flex-col gap-4 mb-[23px]">
			<p class="text-base font-bold">
				Explore great doctors <br>
				for your better life
			</p>
			<a href="#"
				class="rounded-full bg-white text-primary flex w-max gap-2.5 px-6 py-2 justify-center items-center text-base font-bold">
				Explore
			</a>
		</div>
	</div>
</section>

<!-- Most Purchased -->
<section class="wrapper flex flex-col gap-2.5 pb-40">
	<p class="text-base font-bold">
		Most Purchased
	</p>
	<div class="flex flex-col gap-4">
		@forelse ($products as $product)
		<div class="py-3.5 pl-4 pr-[22px] bg-white rounded-2xl flex gap-1 items-center relative">
			<img src="{{ Storage::url($product->photo) }}" class="w-full max-w-[70px] max-h-[70px] object-contain"
				alt="">
			<div class="flex flex-wrap items-center justify-between w-full gap-1">
				<div class="flex flex-col gap-1">
					<a href="{{ route('front.product.details', $product->slug)}}"
						class="text-base font-semibold stretched-link whitespace-nowrap w-[150px] truncate">
						{{ $product->name}}
					</a>
					<p class="text-sm text-grey">
						Rp {{ number_format($product->price)}}
					</p>
				</div>
				<div class="flex">
					<img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
					<img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
					<img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
					<img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
					<img src="{{ asset('assets/svgs/star.svg') }}" class="size-[18px]" alt="">
				</div>
			</div>
		</div>
		@empty
		<p>The Product most be purchased is not available</p>
		@endforelse
	</div>
</section>
@endsection