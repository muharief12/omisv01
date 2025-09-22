@section('title','Admin Fee Data')
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Admin Fee Data') }}
            </h2>
            <a href="{{ route('admin.admin_fees.create')}}" class="px-5 font-bold py-3 bg-indigo-700 text-white rounded-full">Add Admin Fee</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 dark:bg-gray-800 overflow-hidden p-10 shadow-sm sm:rounded-lg text-white">
                @forelse ($adminFees as $item)
                    <div class="item-card flex flex-row items-center justify-between">
                        <div class="flex flex-row items-center gap-x-4">
                            <div class="">
                                <p class="text-base font-normal text-slate-200">
                                    PIC 
                                </p>
                                <h3 class="text-xl font-bold text-white">
                                    {{ $item->user->name}}
                                </h3>
                            </div>
                        </div>
                        <div class="">
                            <p class="text-base font-normal text-slate-200">
                                Tax
                            </p>
                            <h3 class="text-xl font-bold text-white">
                                {{ $item->tax }} %
                            </h3>
                        </div>
                        <div class="">
                            <p class="text-base font-normal text-slate-200">
                                Delivery
                            </p>
                            <h3 class="text-xl font-bold text-white">
                                {{ $item->delivery }} %
                            </h3>
                        </div>
                        <div class="">
                            <p class="text-base font-normal text-slate-200">
                                Insurance
                            </p>
                            <h3 class="text-xl font-bold text-white">
                                {{ $item->insurance }} %
                            </h3>
                        </div>
                        @if ($item->is_active == 0)
                            <span class="py-2 px-3 rounded-md bg-red-500">
                                <p class="text-white font-bold text-sm">Inactive</p>
                            </span>
                        @else
                            <span class="py-2 px-3 rounded-md bg-green-500">
                                <p class="text-white font-bold text-sm">Active</p>
                            </span>
                        @endif
                        <div class="flex flex-row gap-x-5">
                            <a href="{{ route('admin.admin_fees.edit', $item)}}" class="font-bold px-5 py-3 bg-indigo-700 text-white rounded-full">Edit</a>
                            <form action="{{ route('admin.admin_fees.destroy', $item)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-5 py-3 font-bold bg-red-700 text-white rounded-full">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>The Admin Fees are still Empty!</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
