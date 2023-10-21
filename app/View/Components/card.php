<?php

namespace App\View\Components;

use Illuminate\View\Component;

class card extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $image;
    public $imageAlt;
    public $title;
    public $description1;
    public $description2;
    public $idCat;

    public function __construct($image,$imageAlt,$title,$description1,$description2, $idCat)
    {

        $this->image=$image;
        $this->imageAlt=$imageAlt;
        $this->title=$title;
        $this->description1=$description1;
        $this->description2=$description2;
        $this->idCat=$idCat;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card');
    }
}
