@if (Auth()->user()->hasRole('owner'))
    @section('title', 'Detail Order')
@else
    @section('title', 'Detail Transaction')
@endif
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ Auth()->user()->hasRole('owner') ? __('My Orders Data') : __('My Transactions Data') }}
            </h2>
            {{-- <a href="{{ route('admin.products.create')}}" class="px-5 font-bold py-3 bg-indigo-700 text-white rounded-full">Add products</a> --}}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 dark:bg-gray-800 overflow-hidden p-10 shadow-sm sm:rounded-lg text-white">
                <div class="item-card flex flex-row items-center justify-between">
                    <div class="flex flex-row items-center gap-x-4">
                        <div class="">
                            <p class="text-base font-normal text-slate-200">
                                Transaction Total 
                            </p>
                            <h3 class="text-xl font-bold text-white">
                                Rp {{ number_format($productTransaction->total_amount) }}
                            </h3>
                        </div>
                    </div>
                    <div class="">
                        <p class="text-base font-normal text-slate-200">
                            Date
                        </p>
                        <h3 class="text-xl font-bold text-white">
                            {{ \Carbon\Carbon::parse($productTransaction->created_at)->format('d F Y') }}
                        </h3>
                    </div>
                    @if ($productTransaction->is_paid == 0)
                        <span class="py-2 px-3 rounded-md bg-yellow-500">
                            <p class="text-black font-bold text-sm">Waiting</p>
                        </span>
                    @else
                        <span class="py-2 px-3 rounded-md bg-green-500">
                            <p class="text-white font-bold text-sm">Success</p>
                        </span>
                    @endif
                    {{-- <div class="flex flex-row gap-x-3">
                        @if (Auth::user()->hasRole('buyer'))
                            <a href="{{ route('product_transactions.show', $product_transaction)}}" class="font-bold px-5 py-3 bg-indigo-700 text-white rounded-full">View Transaction</a>
                        @else
                            <a href="{{ route('product_transactions.edit', $product_transaction)}}" class="font-bold px-5 py-3 bg-indigo-700 text-white rounded-full">View Transaction</a>
                        @endif
                        <form action="{{ route('admin.product_transactions.destroy', $product_transaction)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-5 py-3 font-bold bg-red-700 text-white rounded-full">Delete</button>
                        </form>
                    </div> --}}
                </div>
                <hr class="my-3">
                <div class="grid-cols-4 grid gap-x-10">
                    <div class="flex flex-col gap-y-5 col-span-2">
                        <h3 class="text-xl text-white font-bold">
                            Product Items
                        </h3>
                        @forelse ($productTransaction->details as $product_transaction)
                            <div class="item-card flex flex-row items-center justify-between">
                                <div class="flex flex-row items-center gap-x-3">
                                    <img src="{{ Storage::url($product_transaction->product->photo)}}" class=" h-[50px]" alt="{{ 'icon '. $product_transaction->product->name}}">
                                    <div class="">
                                        <h3 class="text-xl font-bold text-white">
                                            {{ $product_transaction->name }}
                                        </h3>
                                        <p class="text-base font-normal text-slate-200">
                                            Rp {{ number_format($product_transaction->price) }}
                                        </p>
                                    </div>
                                </div>
                                <p class="text-base text-center font-normal text-slate-200">
                                    {{ $product_transaction->product->category->name }}
                                </p>
                            </div>
                        @empty
                            @role('owner')
                                <p>The Order are still Empty!</p>
                            @endrole
                            @role('buyer')
                                <p>The Transactions are still Empty!</p>
                            @endrole
                        @endforelse
                    </div>
                    <div class="flex flex-col items-end gap-y-5 col-span-2">
                        <h3 class="text-xl text-white font-bold">
                            Proof of Payment
                        </h3>
                        <img src="{{ Storage::url($productTransaction->proof)}}" class="w-cover h-[300px]" alt="Proof of Payment isn't available">
                    </div>
                </div>
                <hr class="my-3">
                <div class="grid-cols-3 grid gap-x-10">
                    <div class="flex flex-col gap-y-5 col-span-2">
                        <h3 class="text-xl text-white font-bold">
                            Delivery Information
                        </h3>
                        <div class="item-card flex flex-row items-center justify-between">
                            <p class="text-base text-center font-normal text-slate-200">
                                Address
                            </p>
                            <h3 class="text-xl font-bold text-white">
                                {{ $productTransaction->address }}
                            </h3>
                        </div>
                        <div class="item-card flex flex-row items-center justify-between">
                            <p class="text-base text-center font-normal text-slate-200">
                                City
                            </p>
                            <h3 class="text-xl font-bold text-white">
                                {{ $productTransaction->city }}
                            </h3>
                        </div>
                        <div class="item-card flex flex-row items-center justify-between">
                            <p class="text-base text-center font-normal text-slate-200">
                                Post Code
                            </p>
                            <h3 class="text-xl font-bold text-white">
                                {{ $productTransaction->postal_code}}
                            </h3>
                        </div>
                        <div class="item-card flex flex-row items-center justify-between">
                            <p class="text-base text-center font-normal text-slate-200">
                                Phone Number
                            </p>
                            <div class="flex flex-col items-end">
                                <h3 class="text-xl font-bold text-white">
                                    {{ $productTransaction->phone_number}}
                                </h3>
                                @role('owner')
                                    <a href="https://wa.me/{{ $productTransaction->phone_number}}" class="mt-2 w-fit rounded-full px-5 py-3 bg-green-700 text-white font-normal">Chat via WA</a>
                                @endrole
                            </div>
                        </div>
                        <div class="item-card flex flex-col items-start justify-between">
                            <p class="text-base text-center font-normal text-slate-200">
                                Notes
                            </p>
                            <h3 class="text-xl font-bold text-white">
                                {{ $productTransaction->notes }}
                            </h3>
                        </div>
                    </div>
                    <div class="flex flex-col items-end gap-y-10 col-span-1">
                        @role('owner')
                        <h3 class="text-xl text-white font-bold">
                            Proof Status
                        </h3>
                        <form action="{{ route('product_transactions.update', $productTransaction)}}" method="post">
                            @csrf
                            @method('PUT')
                            @if ($productTransaction->is_paid)
                                <button type="submit" class="px-5 py-3 font-bold text-white bg-red-500 rounded-full">
                                    Fail Order
                                </button>
                            @else
                                <button type="submit" class="px-5 py-3 font-bold text-white bg-green-500 rounded-full">
                                    Approve Order
                                </button>
                                
                            @endif
                        </form>
                        @endrole
                        @role('buyer')
                        <h3 class="text-xl text-white font-bold">
                            Proof Follow Up
                        </h3>
                        <a href="#" class="w-fit px-5 py-3 font-bold text-white bg-green-500 rounded-full">Contact Admin</a>
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>