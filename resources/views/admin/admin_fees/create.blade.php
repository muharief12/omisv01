@section('title', 'New Admin Fee Data')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Admin Fee Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="py-3 px-3 w-full rounded-3xl bg-red-500 text-white">
                                <ul>
                                    <li>{{ $error }}</li>
                                </ul>
                            </div>
                        @endforeach
                    @endif
                    <form method="POST" action="{{ route('admin.admin_fees.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Tax Percentage Field -->
                        <div class="mt-4">
                            <x-input-label for="tax" :value="__('Tax Percentage')" />
                            <x-text-input id="tax" class="block mt-1 w-full" type="number" name="tax" :value="old('tax')" required autofocus autocomplete="Tax Percentage" />
                            <x-input-error :messages="$errors->get('tax')" class="mt-2" />
                        </div>
                        <!-- Insurance Percentage Field -->
                        <div class="mt-4">
                            <x-input-label for="insurance" :value="__('Insurance Percentage')" />
                            <x-text-input id="insurance" class="block mt-1 w-full" type="number" name="insurance" :value="old('insurance')" required autofocus autocomplete="Insurance Percentage" />
                            <x-input-error :messages="$errors->get('insurance')" class="mt-2" />
                        </div>
                        <!-- Delivery Percentage Field -->
                        <div class="mt-4">
                            <x-input-label for="insurance" :value="__('Delivery Percentage')" />
                            <x-text-input id="delivery" class="block mt-1 w-full" type="number" name="delivery" :value="old('delivery')" required autofocus autocomplete="Delivery Percentage" />
                            <x-input-error :messages="$errors->get('delivery')" class="mt-2" />
                        </div>
                        <!-- Buttton Component -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3">
                                {{ __('Add New Category') }}
                            </x-primary-button>          
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
