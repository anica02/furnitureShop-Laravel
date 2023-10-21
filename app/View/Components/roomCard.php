<?php

namespace App\View\Components;

use Illuminate\View\Component;

class roomCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $src;
    public $alt;
    public function __construct($src,$alt)
    {
        $this->src=$src;
        $this->alt=$alt;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.room-card');
    }
}
