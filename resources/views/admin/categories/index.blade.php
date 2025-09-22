@section('title', 'Categories Data')
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Category Data') }}
            </h2>
            <a href="{{ route('admin.categories.create')}}" class="px-5 font-bold py-3 bg-indigo-700 text-white rounded-full">Add Category</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white flex flex-col gap-y-5 dark:bg-gray-800 overflow-hidden p-10 shadow-sm sm:rounded-lg text-white">
                @forelse ($categories as $category)
                    <div class="item-card flex flex-row items-center justify-between">
                        <img src="{{ Storage::url($category->icon)}}" class="w-[50px] h-[50px]" alt="{{ 'icon '. $category->name}}">
                        <h3 class="text-xl font-bold text-white">
                            {{ $category->name }}
                        </h3>
                        <div class="flex flex-row gap-x-5">
                            <a href="{{ route('admin.categories.edit', $category)}}" class="font-bold px-5 py-3 bg-indigo-700 text-white rounded-full">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-5 py-3 font-bold bg-red-700 text-white rounded-full">Delete</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>The categories are still Empty!</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
