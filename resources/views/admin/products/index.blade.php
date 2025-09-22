@extends('layouts.app')
@section('title', 'Products Data')
<!-- <x-app-layout> -->
@section('content')

<x-slot name="header">
    <div class="flex flex-row items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Data') }}
        </h2>
        <a href="{{ route('admin.products.create')}}" class="px-5 font-bold py-3 bg-indigo-700 text-white rounded-full">Add products</a>
    </div>
</x-slot>

<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white flex flex-col gap-y-5 dark:bg-gray-800 overflow-hidden p-10 shadow-sm sm:rounded-lg text-white">
            @forelse ($products as $product)
            <div class="item-card flex flex-row items-center justify-between">
                <div class="flex flex-row items-center gap-x-4">
                    <div class="">
                        <img src="{{ Storage::url($product->photo)}}" class=" w-[50px]" alt="{{ 'icon '. $product->name}}">
                    </div>
                    <div class="w-[100%]">
                        <h3 class="text-xl font-bold text-white">
                            {{ $product->name }}
                        </h3>
                        <p class="text-base font-normal text-slate-200">
                            Rp {{ number_format($product->price) }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-row items-center gap-x-5">
                    <div class="">
                        <p class="text-base px-0 text-center font-normal text-slate-200">
                            {{ $product->category->name }}
                        </p>
                    </div>
                    <a href="{{ route('admin.products.edit', $product)}}" class="font-bold px-5 py-3 bg-indigo-700 text-white rounded-full">Edit</a>
                    <form action="{{ route('admin.products.destroy', $product)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-5 py-3 font-bold bg-red-700 text-white rounded-full">Delete</button>
                    </form>
                </div>
            </div>
            @empty
            <p>The Products are still Empty!</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
<!-- </x-app-layout> -->