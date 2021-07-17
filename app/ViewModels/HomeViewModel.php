<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class HomeViewModel extends ViewModel
{
    public $popularMovies;
    public $popularShow;
    public $genres;

    public function __construct($popularMovies, $popularShow, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->popularShow = $popularShow;
        $this->genres = $genres;
    }

    public function popularShow()
    {
        return $this->formatTittle($this->popularShow);
    }
    public function popularMovies()
    {
        return $this->formatTittle($this->popularMovies);
    }

    private function formatTittle($Titles)
    {

        return collect($Titles)->map(function($title){
            $formatedGenres = collect($title['genre_ids'])->mapWithKeys(function($value){
                return [$value=>$this->genres()->get($value)];
            })->implode(', ');


            return collect($title)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$title['poster_path'] ,
                'vote_average' => $title['vote_average'] > 0 ? $title['vote_average']*10 ."%" : "No Rating Yet",
                'first_air_date' => isset($title['first_air_date']) ?  Carbon::parse($title['first_air_date'])->format('M d, Y') : null,
                'release_date' => isset($title['release_date']) ?  Carbon::parse($title['release_date'])->format('M d, Y') : null,
                'title' => isset($title['title']) ?  $title['title'] : null,
                'name' => isset($title['name']) ?  $title['name'] : null,

                'genres' => $formatedGenres
            ])->only([
                'poster_path',
                'vote_average',
                'first_air_date',
                'release_date',
                'genres',
                'genre_ids',
                'id',
                'name',
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
