<?php

if (!function_exists('aurl')) {
    function aurl($url = null)
    {
        return url('admin/'.$url);
    }
}

if(!function_exists('userUrl')){
    function userUrl($url = null){
        return aurl('users/'.$url);
    }
}

if (!function_exists('admin')) {
    function admin(){
        return auth()->guard('admin');
    }
}

if (!function_exists('dataTableLanguage')) {
    function dataTableLanguage(){
        return [
            "sProcessing" => trans("admin.sProcessing"),
            "sLengthMenu" => trans("admin.sLengthMenu"),
            "sZeroRecords" => trans("admin.sZeroRecords"),
            "sEmptyTable" => trans("admin.sEmptyTable"),
            "sInfo" => trans("admin.sInfo"),
            "sInfoEmpty" => trans("admin.sInfoEmpty"),
            "sInfoFiltered" => trans("admin.sInfoFiltered"),
            "sInfoPostFix" => trans("admin.sInfoPostFix"),
            "sSearch" => trans("admin.sSearch"),
            "sUrl" => trans("admin.sUrl"),
            "sInfoThousands" => trans("admin.sInfoThousands"),
            "sLoadingRecords" => trans("admin.sLoadingRecords"),
            "oPaginate" => [
                "sFirst" => trans("admin.sFirst"),
                "sLast" => trans("admin.sLast"),
                "sNext" => trans("admin.sNext"),
                "sPrevious" => trans("admin.sPrevious")
            ],
            "oAria" => [
                "sSortAscending" => trans("admin.sSortAscending"),
                "sSortDescending" => trans("admin.sSortDescending")
            ]
            ];
    }
}

if (!function_exists('changeLanguage')) {
    function changeLanguage($lang){
        session()->has('lang') ? session()->forget('lang') : '';
        $lang == ('ar' || 'fr' || 'en') ? session()->put('lang', $lang) : session()->put('lang', 'en');
        return back();
    }
}

if (!function_exists('changeDirection')) {
    function changeDirection(){
        $dir = '';
        if(session()->has('lang')){
            session('lang') == 'ar' ? $dir = 'rtl' : $dir = '';
        }
        return $dir;
    }
}

if(!function_exists('addClassToTreeviewMenu')){
    function addClassToTreeviewMenu($pattern){
        if(preg_match("/".$pattern."/i", request()->segment(2))){
            $classToAdd = ['menu-open', 'display: block'];
        }else{
            $classToAdd = ['', ''];
        }
        return $classToAdd;
    }
}

if(!function_exists('dataNotFound')){
    function dataNotFound(){
        session()->flash('error', trans('admin.entity_not_found'));
        return back();
    }
}

if(!function_exists('saveMsgToSession')){
    function saveMsgToSession($msg){
        session()->flash('error', $msg['error']);
        session()->flash('success', $msg['success']);
    }
}