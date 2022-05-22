<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ request()->routeIs('notes.index') ? __(' All Notes') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-alert-success>
            {{ session('success') }}
        </x-alert-success>
        @if(request()->routeIs('notes.index') )
            <a href="{{ route('notes.create') }}" class="btn-link btn-lg mb-2" rel="noopener noreferrer">+ New Note</a>
            {{-- <form action="{{ route('notes.index') }}" method="get"> --}}
            <select name="language" id="language" class="
            mb-4  ml-10 arounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50' aria-label=".form-select-sm example">
            <option selected>Filter  Code language</option>
            {{-- <option value="javascript">JavaScript</option>
            <option value="html">HTML</option> --}}
            @foreach($notes as $note)
              <option class="uppercase" value="{{ $note->language }}">{{ $note->language }}</option>
              @endforeach
            </select>
            @endif
            {{-- <x-button class="mt-6">Get</x-button> --}}
            </form>
                    @forelse ($notes as $note)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4 display">
                        <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <div class="flex"> <span class="ml-auto uppercase">{{ $note->language }}</span>
                        </div>
                       
                        <h2 class="font-bold text-2xl">
                          <a 
                          @if(request()->routeIs('notes.index') )
                            href="{{ route('notes.show', $note)}}" @else href="{{ route('trashed.show', $note)}}" @endif > {{ $note->title }}</a> 
                        </h2>
                        <p>{{ Str::limit($note->text, 200) }}</p>
                        <span class="block mt-4 text-sm opacity-70"> {{$note->updated_at->diffForHumans()  }}</span>
                    </div>
                </div>
            </div>
            @empty
            @if(request()->routeIs('notes.index') )
            <p>You have not notes yet</p>
                
            @else
            <p>No Item in trash</p>
            @endif
                   @endforelse
                   {{ $notes->links() }}
                </div>
               
        
    </div>
</x-app-layout>
<script>

$("select").change(function() {

var sort = $(this).val();
var url = route()
var data = { sort: sort };
console.log(url);
$.ajax({
    url: url,
    method: 'GET',
    data: data,
    dataType: 'json',
    success: function(data) {
    console.log(data)
        $("#language").html(data.result);
    },
    error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
    }

});
});
</script>