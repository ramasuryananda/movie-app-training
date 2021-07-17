<div>
    <div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click.away="isOpen = false">
        <input wire:model.debounce.500ms="search" type="text" class="bg-gray-800 text-sm rounded-full w-64 pl-8 focus:outline-none focus:shadow-lg px-4 py-1 " placeholder="Search Movies or Tv Series"
        x-ref="search"
        @keydown.window="
            if (event.keyCode === 191) {
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"
        >
        <div class="absolute top-0">
            <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/></svg>
        </div>
        <div wire:loading class="spinner top-0 right-0 mr-3 mt-4"></div>
    </div>

    <div class="absolute bg-gray-800 rounded w-64 mt-4" x-show.transition.opacity="isOpen"
    >
        <ul>
            @forelse ($searchResults as $result)
                <li class="border-b border-gray-700">
                    @if ($result['media_type'] === 'movie')
                        <a href="{{ route('movies.show',$result['id']) }}" class="block hover:bg-gray-800 px-3 py-3 flex items-center">
                            @if ($result['poster_path'])
                                <img class="w-10" src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster">
                            @else
                                <img src="https://via.placeholder.com/50x75" alt="poster" class="w-10">
                            @endif

                            <span class="pl-2">{{ $result['title'] }}</span>
                        </a>

                    @elseif ($result['media_type'] === 'tv')
                        <a href="{{ route('tv.show',$result['id']) }}" class="block hover:bg-gray-800 px-3 py-3 flex items-center">
                            @if ($result['poster_path'])
                                <img class="w-10" src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="poster">
                            @else
                                <img src="https://via.placeholder.com/50x75" alt="poster" class="w-10">
                            @endif

                            <span class="pl-2">{{ $result['name'] }}</span>
                        </a>
                    @elseif ($result['media_type'] === 'preson')
                        <a href="{{ route('actors.show',$result['id']) }}" class="block hover:bg-gray-800 px-3 py-3 flex items-center">
                            @if ($result['poster_path'])
                                <img class="w-10" src="https://image.tmdb.org/t/p/w92/{{ $result['profile_path'] }}" alt="poster">
                            @else
                                <img src="https://via.placeholder.com/50x75" alt="poster" class="w-10">
                            @endif

                            <span class="pl-2">{{ $result['name'] }}</span>
                        </a>

                    @endif

                </li>
            @empty
                @if (strlen($search) > 2)
                    <div class="px-3 py-3">No Results for: {{ $search }}</div>
                @endif
            @endforelse
            </li>
        </ul>
    </div>
</div>
