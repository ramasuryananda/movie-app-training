<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{

    public $popularShow;
    public $topRated;
    public $genres;


    public function __construct($popularShow,$topRated,$genres)
    {
        $this->popularShow = $popularShow;
        $this->topRated = $topRated;
        $this->genres = $genres;
    }

    public function popularShow()
    {
        return $this->formatShows($this->popularShow);
    }
    public function topRated()
    {
        return $this->formatShows($this->topRated);
    }

    private function formatShows($shows)
    {

        return collect($shows)->map(function($show){
            $formatedGenres = collect($show['genre_ids'])->mapWithKeys(function($value){
                return [$value=>$this->genres()->get($value)];
            })->implode(', ');


            return collect($show)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$show['poster_path'] ,
                'vote_average' => $show['vote_average'] > 0 ? $show['vote_average']*10 ."%" : "No Rating Yet",
                'first_air_date' => Carbon::parse($show['first_air_date'])->format('M d, Y'),
                'genres' => $formatedGenres
            ])->only([
                'poster_path',
                'vote_average',
                'first_air_date',
                'genres',
                'genre_ids',
                'id',
                'name',
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
