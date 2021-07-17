<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;





class SearchDropDown extends Component
{
    public $search =  '';

    public function render()
    {

        $searchResult = [];
        if(strlen($this->search) >=2){
            $searchResult = Http::withToken(config('services.tmdb.token'))->get('https://api.themoviedb.org/3/search/multi?query='.$this->search)->json()['results'];
        }

        return view('livewire.search-drop-down',[
            'searchResults' => collect($searchResult)->take(7)
        ]);
    }
}
