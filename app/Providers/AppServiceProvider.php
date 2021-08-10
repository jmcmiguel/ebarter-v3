<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
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
        // Filter Location Macro
        Collection::macro('filterLocation', function ($location) {

            if(!$location) return $this->collect();

            return $this->filter(function ($post) use ($location) {
                return strtolower($post->user->city) === strtolower($location);
            });
        });

        // Filter Price Macro
        Collection::macro('filterPrice', function ($price, $price2) {

            if(!$price) return $this->collect();

            return $this->filter(function ($post) use ($price, $price2) {
                if($price > 5000){
                    return $post->est_price > 5000;
                }else if($price > 100){
                    return $post->est_price >= $price2 && $post->est_price <= $price;
                }else{
                    return $post->est_price < 100;
                }
            });
        });

        // Filter Hide Post Macro
        Collection::macro('filterHideOwnPost', function ($hideOwnPost) {

            if(!$hideOwnPost) return $this->collect();

            return $this->filter(function ($post){
                return $post->user_id != Auth::user()->id;
            });
        });

        // Filter Category Macro
        Collection::macro('filterCategory', function ($category) {

            if($category == 'all' ) return $this->collect();

            return $this->filter(function ($post) use($category){
                return $post->category === $category;
            });
        });

        // Custom Pagination Macro
        Collection::macro('customPaginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage)->values(),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }
}
