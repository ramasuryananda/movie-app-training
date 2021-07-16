<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieDetailsViewModel extends ViewModel
{
    public $movie;
    public $genres;
    public function __construct($movie,$genres)
    {
        $this->genres = $genres;
        $this->movie = $movie;
    }

    public function movie(){

        $formatedRecomend = $this->formatMovies(collect($this->movie['recommendations']['results']))->take(4);

        return collect($this->movie)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$this->movie['poster_path'],
            'vote_average' => $this->movie['vote_average']*10,
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M d, Y'),
            'genres' => collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->movie['credits']['crew'])->whereIn('job',['Producer','Director','Executive Producer']),
            'cast' =>collect($this->movie['credits']['cast'])->take(6),
            'images'=>collect($this->movie['images']['backdrops'])->take(6),
            'recommendations' => $formatedRecomend
        ]);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function($genre){
            return [$genre['id']=> $genre['name']] ;
        });
    }

    private function formatMovies($movies)
    {

        return collect($movies)->map(function($movie){
            $formatedGenres = collect($movie['genre_ids'])->mapWithKeys(function($value){
                return [$value=>$this->genres()->get($value)];
            })->implode(', ');


            return collect($movie)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'],
                'vote_average' => $movie['vote_average']*10,
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
}
