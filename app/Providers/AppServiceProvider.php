<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\administration;
use App\course;
use App\student;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $adminAll = administration::all();
        View::share('adminall',$adminAll);

        $courseAll = course::all();
        View::share('courseAll',$courseAll);

        $studentAll = student::all();
        View::share('studentAll',$studentAll);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
