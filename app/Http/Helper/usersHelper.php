<?php

use App\User;

if(!function_exists('checkUserIfExist')){
    function checkUserIfExist($id){
        return !is_null(User::find($id));
    }
}