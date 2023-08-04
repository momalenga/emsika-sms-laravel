<?php

namespace Shengamo\EmsikaSms;

use Illuminate\Support\ServiceProvider;

class EmsikaSmsServiceProvider extends ServiceProvider{
    public function boot(){
        dd('It works');
    }

    public function register()
    {
        parent::register();
    }
}
