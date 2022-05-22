<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                        <div class="p-6 bg-white border-b border-gray-200">
            <form action="{{ route('notes.update', $note) }}" method="post">
                {{-- blade directive --}}
                @method('put');
                @csrf
                {{-- <select name="language" class="mb-4 arounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 aria-label=".form-select-sm example">
                <option selected>Select Code language</option> --}}
                {{-- <option value="javascript">JavaScript</option>
                <option value="html">HTML</option> --}}
                {{-- @foreach($note as $note)
                  <option value="{{ $note->language }}">{{ $note->language }}</option>
                  @endforeach --}}
                  {{-- <option >Add New Language</option>
                </select> --}}
                {{-- <span class="m-4">OR</span> --}}

                <x-input class=" mb-4" field="language" type="text" name="language" placeholder="New Language" autocomplete="off"  :value="@old('language', $note->language)"/>
                <x-input class="w-full mb-4" field="title" type="text" name="title" placeholder="Title" autocomplete="off"  :value="@old('title' , $note->title)"/>
                <x-textarea class="w-full" field="text" name="text"  cols="30" rows="10" placeholder="Start typing here" :value="@old('text', $note->text)"></x-textarea>
                <x-button class="mt-6">Edit Note</x-button>
            </div>
        </div>
            </form>
                </div>
            </div>
    </div>
</x-app-layout>