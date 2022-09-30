<?php

namespace App\Http\Livewire\movies;

use Livewire\Component;
use App\Models\Movie;


class Create extends Component
{
    public $title, $producer, $description, $genre, $year, $email;

    public function addMovie(){
        $this->validate([
            'title'              =>            ['required' ,'string', 'max:255'],
            'producer'           =>            ['required' ,'string', 'max:255'],
            'description'        =>            ['required' ,'string', 'max:255'],
            'genre'              =>            ['required' ,'string', 'max:255'],
            'year'               =>            ['required' ,'numeric','min:2010' ,'max:2022'],
        ]);

        $movies = Movie::create([
            'title'                =>        $this->title,
            'producer'             =>        $this->producer,
            'description'          =>        $this->description,
            'genre'                =>        $this->genre,
            'year'                 =>        $this->year,
        ]);

        $log_entry = 'Added a new movie "' . $movies->title . ' " with the number of ' . $movies->id;
        event(new UserLog($log_entry));
        
        return redirect('/index')->with('message', 'Added Successfully!!');
    }

    public function render()
    {
        return view('livewire.movies.create');
    }
}
