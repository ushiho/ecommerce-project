<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Settings;

class SettingsController extends Controller
{
    public function index(){
        return view('admin.settings', ['title' => trans('admin.settings')]);
    }

    public function update()
    {
        $data = $this->validateData();
        return setting();
        setting()->update($data);
        saveMsgToSession(['error' => '', 'success' => trans('admin.settings_saved_success')]);
        return redirect(aurl());
    }

    protected function validateData()
    {
        return $this->validate(request(), [
            'sitename_ar' => 'required',
            'sitename_en' => 'required',
            // 'email' => 'email',
            'main_lang' => 'in:ar,en,fr',
            'status' => 'in:close,open',
            // 'logo' => 'file',
            // 'icon' => 'file',
        ],[],[
            'sitename_ar' => trans('admin.sitename_ar'),
            'sitename_en' => trans('admin.sitename_en'),
            // 'email' => trans('admin.email'),
            'main_lang' => trans('admin.main_lang'),
            'status' => trans('admin.status'),
            // 'logo' => trans('admin.logo'),
            // 'logo' => trans('admin.logo'),
            'icon' => trans('admin.icon'),
        ]);
    }
}
