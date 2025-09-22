@section('title', 'Edit Category Data')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Category Data') }}
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
                    <form method="POST" action="{{ route('admin.categories.update', $category) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Name Field -->
                        <div class="mt-4">
                            <x-input-label for="name" :value="__('Category Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $category->name }}" autofocus autocomplete="Category Name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <!-- Icon Field -->
                        <div class="mt-4">
                            <x-input-label for="icon" :value="__('Icon')" />
                            <img src="{{ Storage::url($category->icon )}}" alt="{{ $category->name." icon"}}">
                            <x-text-input id="icon" class="block mt-1 w-full" type="file" name="icon" autofocus autocomplete="Category Icon" />
                            <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                        </div>
                        <!-- Buttton Component -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-3 mt-4">
                                {{ __('Update Category') }}
                            </x-primary-button>          
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
