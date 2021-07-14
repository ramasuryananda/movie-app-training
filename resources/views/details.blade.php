@extends('layouts.main')


@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container justify-between mx-auto px-4 py-16 flex flex-col md:flex-row"> 
            <img src="{{'https://image.tmdb.org/t/p/w500/'.$movie['poster_path']}}" alt="parasite" class="w-full sm:w-1/2 h-auto object-contain" >
            <div class=" mt-10 md:ml-24 md:mt-0  flex-grow relative">
                <h2 class="text-4xl font-semibold">
                    {{ $movie['title'] }}
                </h2>
                <div class=" flex  flex-wrap items-center text-gray-400 text-sm mt-1">
                    <span> <svg class="fill-current text-yellow-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
                    </span>
                    <span class="ml-1">{{ $movie['vote_average']*10 }} %</span>
                    <span class="mx-2">|</span>
                    <span>{{ \Carbon\Carbon::parse($movie['release_date'])->format('M d, Y') }}</span>
                    <span class="mx-1">|</span>
                    <span>@foreach ($movie['genres'] as $genre)
                        {{ $genre['name'] }} 
                        @if (!$loop->last), 
                        @endif
                    @endforeach</span>
                </div>
                <p class="text-gray-300 mt-8 text-justify">
                    {{ $movie['overview'] }}
                </p>

                <div class="mt-12">
                    <h4 class="text-white font-semibold">Featured Cast</h4>
                    <div class="flex flex-wrap mt-4">
                        @foreach ($movie['credits']['crew'] as $crew)
                            @if ($crew['job'] == "Producer" || $crew['job'] == "Director" || $crew['job'] == "Executive Producer")
                                <div class="mr-8 my-1 w-1/3  lg:w-1/4">
                                    <div>{{ $crew['name'] }}</div>
                                    <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                @if (count($movie['videos']['results']) > 0)
                    <div class="mt-12 w-full absolute  bottom-0">
                        <a target="_blank" rel="noopener noreferrer" href="https://youtube.com/watch?v={{ $movie['videos']['results'][0]['key'] }}" class="flex items-center w-full justify-center bg-yellow-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-yellow-600 transition ease-in-out duration-150 hover:text-white">  <svg class="w-6 mr-1 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg> Play Trailler</a>
                    </div>
                @endif

                
            </div>
        </div>
    </div>

    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Cast</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
                @foreach ($movie['credits']['cast'] as $cast)
                            @if ($loop->index < 6)
                            <div class="mt-8">
                                <a href="#">
                                    <img src="{{'https://image.tmdb.org/t/p/w500/'.$cast['profile_path']}}" class="w-50 lg:w-80 hover:opacity-75 transition ease-in-out duration-150" alt="">
                                </a>
                                <div class="mt-2">
                                    <a href="#" class="text-lg  hover:text-gray-300"> {{ $cast['name'] }}</a>
                                    <div class="container flex items-center text-gray-400 text-sm mt-1">           
                                    
                                    </div>
                                    <div class="text-gray-400 text-sm">
                                        As {{ $cast['character'] }}
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach

            </div>
        </div>
    </div>

    <div class="movie-image border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Movie Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($movie['images']['backdrops'] as $image)
                    @if ($loop->index < 6)
                        <div class="mt-8">
                            <a href="{{ 'https://image.tmdb.org/t/p/w500'.$image['file_path'] }}">
                                <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}" class="hover:opacity-75 transition ease-in-out duration-150 " alt="">
                            </a>
                        </div>
                        
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="movie-image border-b border-gray-800">
        <div class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-semibold">Recomended Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4  gap-8">
                @foreach ($movie['recommendations']['results'] as $movie)
                    @if ($loop->index <4)
                        <x-movie-card :movie="$movie" :genres="$genres" />
                        
                    @endif
                    
                @endforeach
               
            </div>
        </div>
    </div>
@endsection