<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Product extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name;
    public $price;
    public $color;
    public $category;
    public $prodId;
    public $imgSrc;
    public $imgAlt;
    public $discountStyle;
    public $discountName;
    public $discountPrice;
    public $status;
    public $material;

    public function __construct($name,$price,$color,$category,$prodId,$imgAlt,$imgSrc,$discountName,$discountStyle,$discountPrice="",$status,$material)
    {
        $this->name=$name;
        $this->price=$price;
        $this->color=$color;
        $this->category=$category;
        $this->prodId=$prodId;
        $this->imgAlt=$imgAlt;
        $this->imgSrc=$imgSrc;
        $this->discountName=$discountName;
        $this->discountStyle=$discountStyle;
        $this->discountPrice=$discountPrice;
        $this->status=$status;
        $this->material=$material;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product');
    }
}
