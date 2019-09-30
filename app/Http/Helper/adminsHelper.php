<?php

use App\Admin;

if(!function_exists('checkAdminIfExist')){
    function checkAdminIfExist($id){
        return !is_null(Admin::find($id));
    }
}