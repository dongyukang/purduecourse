<?php

namespace DongyuKang\PurdueCourse;

use Illuminate\Support\ServiceProvider;

class PurdueCourseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind('purdue', 'DongyuKang\PurdueCourse\Purdue');
    }
}
