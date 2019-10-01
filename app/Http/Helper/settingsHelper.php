<?php

use App\Model\Settings;

if(!function_exists('setting')){
    function setting()
    {
        return Settings::orderBy('id', 'desc')->first();
    }
}