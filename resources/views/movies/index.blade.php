@extends('layouts.main')


@section('content')
    <div class="container mx-auto px-4 ">
        <div class="popular-movies border-b py-16 border-gray-800">
            <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold"> Popular Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                @foreach ($popularMovies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach

            </div>
        </div>
    </div>
    <div class="container mx-auto px-4 ">
        <div class="now-playing-movies  py-16 border-b border-gray-800 ">
            <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold"> Now Playing</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                @foreach ($playing as $movie)
                    <x-movie-card :movie="$movie"  />

                @endforeach

            </div>
        </div>
    </div>
@endsection
