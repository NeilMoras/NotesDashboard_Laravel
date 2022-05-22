<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ !$note->trashed() ?  __('Notes') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
       <x-alert-success>
           {{ session('success') }}
       </x-alert-success>
           
          <div class="flex">
              @if(!$note->trashed())
             <p class="opacity-70"><strong>Created:</strong> {{ $note->created_at->diffForHumans() }}</p>
             <p class="opacity-70 ml-8"><strong>Updated at:</strong> {{ $note->updated_at->diffForHumans() }}</p>
             <a href="{{ route('notes.edit', $note) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-auto">Edit Note</a>
             <form action="{{ route('notes.destroy', $note) }}" method="post">
                @method('delete')
                @csrf
                <button type="submit"  onclick="return confirm('Are you Sure your Want to more this note to Trash?')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-auto mr-4">Trash</button>
            </form>
            @else
            <p class="opacity-70"><strong>Deleted at:</strong> {{ $note->deleted_at->diffForHumans() }}</p>
            <form action="{{ route('trashed.update', $note) }}" method="post">
                @method('put')
                @csrf
                <button type="submit"  onclick="return confirm('Are you Sure your Want to retore this note?')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-auto mr-4">Restore Note</button>
            </form>
            <form action="{{ route('trashed.destroy', $note) }}" method="post">
               @method('delete')
               @csrf
               <button type="submit"  onclick="return confirm('Are you Sure your Want to more this note permanently? this action cannot be undone!')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-auto mr-4">Permanent Delete</button>
           </form>
            @endif
          </div>
        
                
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                        <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <h2 class="font-bold text-4xl">
                      {{ $note->title }}
                        </h2>
                        <p class="mt-4 whitespace-pre-wrap">{{ $note->text }}</p>
                    </div>
                </div>
            </div>

               
        
    </div>
</x-app-layout>