<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                        <div class="p-6 bg-white border-b border-gray-200">
            <form action="{{ route('notes.store') }}" method="post">
                @csrf
                <x-input class="w-full mb-4" field="title" type="text" name="title" placeholder="Title" autocomplete="off"  :value="@old('title')"/>
                <x-textarea class="w-full" field="text" name="text"  cols="30" rows="10" placeholder="Start typing here" :value="@old('text')"></x-textarea>
                <x-button class="mt-6">Save Note</x-button>
            </form>
                </div>
            </div>
    </div>
</x-app-layout>