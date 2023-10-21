<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    private $menu;
    private $links = [

            [
                "icon"=>"fab fa-instagram-square",
                "href"=>"https://www.instagram.com/_sweetheart55_/"
            ],
            [
                "icon"=>"fab fa-twitter-square",
                "href"=>"https://twitter.com/anika99black"
            ],
            [
                "icon"=>"fab fa-linkedin",
                "href"=>"https://www.linkedin.com/in/anica-radenkovi%C4%87-9519b3206/"
            ],
            [
                "icon"=>"fab fa-facebook-square",
                "href"=>"https://www.facebook.com/anica.radenkovic96/"
            ],
            [
                "icon"=>"fab fa-github-square",
                "href"=>"https://github.com/anica02"
            ]

    ];


    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        View::share('links', $this->links);

        Paginator::useBootstrapFour();
    }
}
