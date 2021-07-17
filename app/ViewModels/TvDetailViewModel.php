<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvDetailViewModel extends ViewModel
{
    public $show;
    public $genres;
    public function __construct($show,$genres)
    {
        $this->genres = $genres;
        $this->show = $show;
    }
    public function show(){

        $formatedRecomend = $this->formatShows(collect($this->show['recommendations']['results']))->take(4);

        return collect($this->show)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500/'.$this->show['poster_path'] ,
            'vote_average' => $this->show['vote_average']*10,
            'first_air_date' => Carbon::parse($this->show['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->show['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->show['credits']['crew'])->whereIn('job',['Producer','Director','Executive Producer','Writter']),
            'cast' =>collect($this->show['credits']['cast'])->take(6),
            'images'=>collect($this->show['images']['backdrops'])->take(6),
            'creator' =>collect($this->show['created_by'])->take(6),
            'recommendations' => $formatedRecomend
        ]);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function($genre){
            return [$genre['id']=> $genre['name']] ;
        });
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
}
