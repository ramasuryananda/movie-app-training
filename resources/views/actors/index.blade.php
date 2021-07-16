@extends('layouts.main')


@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="popular-actors border-b py-16 border-gray-800">
            <h2 class="uppercase tracking-wider text-yellow-500 text-lg font-semibold"> Popular Actors</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                @foreach ($popularActor as $actor)
                <div class="actor mt-8">
                    <a href="{{ route('actors.show',$actor['id']) }}" class=""><img src="{{ $actor['profile_path'] }}" alt=""></a>
                    <div class="mt-2">
                        <a href="{{ route('actors.show',$actor['id']) }}" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                        <div class="text-sm truncate text-gray-400">{{ $actor['known_for']}}</div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
        <div class="page-load-status my-8">
            <p class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</p>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">Error</p>
          </div>
        {{-- <div class="flex justify-between mt-16">
            @if ($previous)
                <a class="items-start" href="/actors/page/{{ $previous }}">Previous</a>
            @else
                <div></div>
            @endif
            @if ($next)
                <a class="items-end" href="/actors/page/{{ $next }}">Next</a>
            @else
                <div></div>
            @endif

        </div> --}}
    </div>
@endsection

@section('script')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        let elem = document.querySelector('.grid');
        let infScroll = new InfiniteScroll( elem, {
        // options
        path: '/actors/page/@{{#}}',
        append: '.actor',
        // history: false,
        status: '.page-load-status'
        });
    </script>
@endsection
