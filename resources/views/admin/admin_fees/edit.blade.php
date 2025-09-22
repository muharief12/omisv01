@section('title', 'Edit Category Data')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Admin Fee Data') }}
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
                    <form method="POST" action="{{ route('admin.admin_fees.update', $adminFee) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Tax Percentage Field -->
                        <div class="mt-4">
                            <x-input-label for="tax" :value="__('Tax Percentage')" />
                            <x-text-input id="tax" class="block mt-1 w-full" type="number" name="name" value="{{$adminFee->tax}}" required autofocus autocomplete="Tax Percentage" />
                            <x-input-error :messages="$errors->get('tax')" class="mt-2" />
                        </div>
                        <!-- Insurance Percentage Field -->
                        <div class="mt-4">
                            <x-input-label for="insurance" :value="__('Insurance Percentage')" />
                            <x-text-input id="insurance" class="block mt-1 w-full" type="number" name="insurance" value="{{ $adminFee->insurance}}" required autofocus autocomplete="Insurance Percentage" />
                            <x-input-error :messages="$errors->get('insurance')" class="mt-2" />
                        </div>
                        <!-- Delivery Percentage Field -->
                        <div class="mt-4">
                            <x-input-label for="insurance" :value="__('Delivery Percentage')" />
                            <x-text-input id="delivery" class="block mt-1 w-full" type="number" name="delivery" value="{{$adminFee->delivery}}" required autofocus autocomplete="Delivery Percentage" />
                            <x-input-error :messages="$errors->get('delivery')" class="mt-2" />
                        </div>                        
                        <!-- Is Active Field -->
                        <div class="mt-4">
                            <x-input-label for="is_active" :value="__('Is Active Percentage')" />
                            <select name="is_active" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="is_active">
                                <option value="{{ $adminFee->is_active }}" selected disabled>{{ $adminFee->is_active == 0 ? 'In Active': 'Active'}}</option>
                                <option value="1">Active</option>
                                <option value="0">In Active</option>

                            </select>
                            <x-input-error :messages="$errors->get('delivery')" class="mt-2" />
                        </div>                        
                        <!-- Buttton Component -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3 mt-4">
                                {{ __('Update Admin Fee') }}
                            </x-primary-button>          
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
