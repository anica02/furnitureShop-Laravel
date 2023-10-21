<?php

namespace App\View\Components;

use Illuminate\View\Component;

class cartRow extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $name;
    public $image;
    public $alt;
    public $price;
    public $discount;
    public $idProd;

    public function __construct($idProd,$image,$alt,$name,$price,$discount="")
    {
        $this->idProd=$idProd;
        $this->image=$image;
        $this->alt=$alt;
        $this->name=$name;
        $this->price=$price;
        $this->discount=$discount;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-row');
    }
}
