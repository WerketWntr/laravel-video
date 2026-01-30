<?php

namespace App\Livewire;


use App\Models\Video;
use Illuminate\Http\Request;
use Livewire\Component;

class Navigation extends Component
{
    public string $query = '';
    public $searchResults = [];

    public function render()
    {
        return view('livewire.navigation');
    }

    public function mount(Request $request): void
    {
        if ($request->query('query')) {
            $this->query = $request->query('query');
        }
    }

    public function updatedQuery(): void
    {
        if(!empty($this->query)){
            $this->searchResults = Video::search($this->query)->get();
        } else {
            $this->searchResults = [];
        }
    }

    public function setQuery($query): void
    {
        $this->query = $query;
        $this->searchResults = [];

        $this->js("setTimeout(function() { document.getElementById('search-form').submit(); }, 0);");
    }

}
