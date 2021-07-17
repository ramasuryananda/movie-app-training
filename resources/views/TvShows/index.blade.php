@extends('layouts.main')


@section('content')
    <div class="container mx-auto px-4 ">
        <div class="popular-tv border-b py-16 border-gray-800">
            <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold"> Popular Tv Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                @foreach ($popularShow as $show)
                    <x-tv-card :show="$show" />
                @endforeach

            </div>
        </div>
    </div>
    <div class="container mx-auto px-4 ">
        <div class="now-playing-tv  py-16 border-b border-gray-800 ">
            <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold">Top Rated Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                @foreach ($topRated as $show)
                    <x-tv-card :show="$show"  />

                @endforeach

            </div>
        </div>
    </div>
@endsection
