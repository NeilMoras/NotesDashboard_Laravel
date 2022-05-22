<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' JavaScript') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          
            <a href="{{ route('notes.create') }}" class="btn-link btn-lg mb-2" rel="noopener noreferrer">+ New Note</a>
                    @forelse ($notes as $note)
                    @if($note->language === 'javascript')
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                        <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <h2 class="font-bold text-2xl">
                          <a href="{{ route('notes.show', $note->id) }}"> {{ $note->title }}</a> 
                        </h2>
                        <p>{{ Str::limit($note->text, 200) }}</p>
                        <span class="block mt-4 text-sm opacity-70"> {{$note->updated_at->diffForHumans()  }}</span>
                    </div>
                </div>
            </div>
            @endif
            @empty
            <p>You have not notes yet</p>
                   @endforelse
                   {{ $notes->links() }}
                </div>
               
        
    </div>
</x-app-layout>