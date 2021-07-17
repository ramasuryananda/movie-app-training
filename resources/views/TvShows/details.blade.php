@extends('layouts.main')


@section('content')
    <div class="show-info border-b border-gray-800">
        <div class="container justify-between items-start mx-auto px-4 py-16 flex flex-col md:flex-row">
            <img src="{{$show['poster_path']}}" alt="poster for {{ $show['name'] }}" class="w-full sm:w-1/2 h-auto object-contain" >
            <div class=" mt-10 md:ml-24 md:mt-0  flex-grow relative">
                <h2 class="text-4xl font-semibold">
                    {{ $show['name'] }}
                </h2>
                <div class=" flex  flex-wrap items-center text-gray-400 text-sm mt-1">
                    <span> <svg class="fill-current text-yellow-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
                    </span>
                    <span class="ml-1">{{ $show['vote_average'] }} %</span>
                    <span class="mx-2">|</span>
                    <span>{{ $show['first_air_date'] }}</span>
                    <span class="mx-1">|</span>
                    <span>{{ $show['genres'] }}</span>
                </div>
                <p class="text-gray-300 mt-8 text-justify">
                    {{ $show['overview'] }}
                </p>

                <div class="mt-12 mb-20">
                    <h4 class="text-white font-semibold">Featured Crew</h4>
                    <div class="flex flex-wrap mt-4 ">
                        @if ($show['creator'])
                            @foreach ($show['creator'] as $creator)
                            <div class="mr-8 my-1 w-1/3  lg:w-1/4">
                                <div>{{ $creator['name'] }}</div>
                                <div class="text-sm text-gray-400">Show's Creator</div>
                            </div>
                            @endforeach
                        @endif
                        @foreach ($show['crew'] as $crew)
                            <div class="mr-8 my-1 w-1/3  lg:w-1/4">
                                <div>{{ $crew['name'] }}</div>
                                <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                @if (count($show['videos']['results']) > 0)
                    <div class="mt-16 w-full absolute  bottom-0">
                        <a target="_blank" rel="noopener noreferrer" href="https://youtube.com/watch?v={{ $show['videos']['results'][0]['key'] }}" class="flex items-center w-full justify-center bg-yellow-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-yellow-600 transition ease-in-out duration-150 hover:text-white">  <svg class="w-6 mr-1 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg> Play Trailler</a>
                    </div>

                    <template x-if="isOpen">
                        <div
                            style="background-color: rgba(0, 0, 0, .5);"
                            class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                        >
                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                <div class="bg-gray-900 rounded">
                                    <div class="flex justify-end pr-4 pt-2">
                                        <button
                                            @click="isOpen = false"
                                            @keydown.escape.window="isOpen = false"
                                            class="text-3xl leading-none hover:text-gray-300">&times;
                                        </button>
                                    </div>
                                    <div class="modal-body px-8 py-8">
                                        <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                            <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{ $show['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                @endif


            </div>
        </div>
    </div>

    <div class="show-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
                @foreach ($show['cast'] as $cast)
                            <div class="mt-8">
                                <a href="{{ route('actors.show',$cast['id']) }}">
                                    <img src="{{'https://image.tmdb.org/t/p/w500/'.$cast['profile_path']}}" class="w-50 lg:w-80 hover:opacity-75 transition ease-in-out duration-150" alt="">
                                </a>
                                <div class="mt-2">
                                    <a href="{{ route('actors.show',$cast['id']) }}" class="text-lg  hover:text-gray-300"> {{ $cast['name'] }}</a>
                                    <div class="container flex items-center text-gray-400 text-sm mt-1">

                                    </div>
                                    <div class="text-gray-400 text-sm">
                                        As {{ $cast['character'] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach

            </div>
        </div>
    </div>

    <div class="show-image border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Show Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($show['images'] as $image)
                        <div class="mt-8">
                            <a href="{{ 'https://image.tmdb.org/t/p/w500'.$image['file_path'] }}">
                                <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}" class="hover:opacity-75 transition ease-in-out duration-150 " alt="">
                            </a>
                        </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="show-image border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Recomended Tv Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4  gap-8">
                @foreach ($show['recommendations'] as $show)
                        <x-tv-card :show="$show"/>
                @endforeach

            </div>
        </div>
    </div>
@endsection

