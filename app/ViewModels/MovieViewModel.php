<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $popularMovies;
    public $playing;
    public $genres;

    public function __construct($popularMovies, $playingMovies, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->playing = $playingMovies;
        $this->genres = $genres;
    }

    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }
    public function playing()
    {
        return $this->formatMovies($this->playing);
    }

    private function formatMovies($movies)
    {

        return collect($movies)->map(function($movie){
            $formatedGenres = collect($movie['genre_ids'])->mapWithKeys(function($value){
                return [$value=>$this->genres()->get($value)];
            })->implode(', ');


            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'] ,
                'vote_average' => $movie['vote_average'] > 0 ? $movie['vote_average']*10 ."%" : "No Rating Yet",
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $formatedGenres
            ])->only([
                'poster_path',
                'vote_average',
                'release_date',
                'genres',
                'genre_ids',
                'id',
                'title',
                'overview',
            ]);
        });
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function($genre){
            return [$genre['id']=> $genre['name']] ;
        });
    }
}
