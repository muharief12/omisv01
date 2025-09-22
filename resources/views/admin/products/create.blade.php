@section('title', 'New Product Data')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Product Data') }}
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
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- Name Field -->
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Product Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="Product Name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        
                        <!-- Price Field -->
                        <div class="mt-4">
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price')" required autofocus autocomplete="Product Price" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        
                        <!-- Category Field -->
                        <div class="mt-4">
                            <x-input-label for="category_id" :value="__('category_id')" />
                            <x-select id="category_id" name="category_id" class="block mt-1 w-full" required autofocus>
                                <option value="" disabled selected>Select an option</option>
                                @forelse ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                    <option value="" disabled>No categoriess available</option>
                                @endforelse
                            </x-select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <!-- Photo Field -->
                        <div class="mt-4">
                            <x-input-label for="photo" :value="__('Photo')" />
                            <x-text-input id="photo" class="block mt-1 w-full" type="file" name="photo" required autofocus autocomplete="Product photo" />
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>

                        <!-- about Field -->
                        <div class="mt-4">
                            <x-input-label for="about" :value="__('About')" />
                            <x-textarea id="about" name="about" class="block mt-1 w-full" required autofocus>
                                {{old('about')}}
                            </x-textarea>
                            <x-input-error :messages="$errors->get('about')" class="mt-2" />
                        </div>

                        <!-- Buttton Component -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3">
                                {{ __('Add New Product') }}
                            </x-primary-button>          
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
