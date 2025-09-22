@if (Auth()->user()->hasRole('owner'))
    @section('title', 'My Orders Data')
@else
    @section('title', 'My Transactions Data')
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
                @forelse ($product_transactions as $product_transaction)
                    <div class="item-card flex flex-row items-center justify-between">
                        <div class="flex flex-row items-center gap-x-4">
                            <div class="">
                                <p class="text-base font-normal text-slate-200">
                                    Transaction Total 
                                </p>
                                <h3 class="text-xl font-bold text-white">
                                    Rp {{ number_format($product_transaction->total_amount) }}
                                </h3>
                            </div>
                        </div>
                        <div class="">
                            <p class="text-base font-normal text-slate-200">
                                Date
                            </p>
                            <h3 class="text-xl font-bold text-white">
                                {{ \Carbon\Carbon::parse($product_transaction->created_at)->format('d F Y') }}
                            </h3>
                        </div>
                        @if ($product_transaction->is_paid == 0)
                            <span class="py-2 px-3 rounded-md bg-yellow-500">
                                <p class="text-black font-bold text-sm">Waiting</p>
                            </span>
                        @else
                            <span class="py-2 px-3 rounded-md bg-green-500">
                                <p class="text-white font-bold text-sm">Success</p>
                            </span>
                        @endif
                        <div class="flex flex-row gap-x-3">
                            @if (Auth::user()->hasRole('buyer'))
                                <a href="{{ route('product_transactions.show', $product_transaction)}}" class="font-bold px-5 py-3 bg-indigo-700 text-white rounded-full">View Transaction</a>
                            @else
                                <a href="{{ route('product_transactions.show', $product_transaction)}}" class="font-bold px-5 py-3 bg-indigo-700 text-white rounded-full">View Transaction</a>
                            @endif
                            {{-- <form action="{{ route('admin.product_transactions.destroy', $product_transaction)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-5 py-3 font-bold bg-red-700 text-white rounded-full">Delete</button>
                            </form> --}}
                        </div>
                    </div>
                    <hr class="my-3">
                @empty
                    @role('owner')
                        <p>The Order are still Empty!</p>
                    @endrole
                    @role('buyer')
                        <p>The Transactions are still Empty!</p>
                    @endrole
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>