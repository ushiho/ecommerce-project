<?php

namespace App\Http\Controllers\admin;

use App\Admin;
use Illuminate\Http\Request;
use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDataTable $admin)
    {
        return $admin->render('admin.admins.index', [
            'title' => 'admin.admin_panel',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.admins.create", ['title' => trans('admin.admin_create')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = $this->validateData('required|email|unique:admins');
        $data['password'] = bcrypt(request('password'));
        Admin::create($data);
        saveMsgToSession(['error' => '', 'success' => trans('admin.admin_added_success')]);
        return redirect(aurl('control/'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $admin = Admin::find($id);
        return is_null($admin) ? with(dataNotFound()) : with(view("admin.admins.edit", ['title' => trans('admin.admin_edit'), 'admin' => $admin]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $msg = ['error' => '', 'success' => ''];
        if(checkAdminIfExist($id)){
            $data = $this->validateData('required|email|unique:admins,'.$id);
            $data['password'] = bcrypt(request('password'));
            Admin::find($id)->update($data);
            $msg['success'] = trans('admin.admin_edited_success');
        } else {
            $msg['error'] = trans('admin.admin_deleted_error');
        }
        saveMsgToSession($msg);
        return redirect(aurl('control'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $msg = ['error' => '', 'success' => ''];        
        if($id == admin()->user()->id){
            $msg['error'] = trans('admin.can_not_remove_profile');
        }else{
            Admin::find($id)->delete() ? $msg['success'] = trans('admin.admin_deleted_success') : $msg['error'] = trans('admin.admin_deleted_error');
        }
        saveMsgToSession($msg);
        return back();
    }

    public function deleteSelected(){
        $msg = ['error' => '', 'success' => ''];
        if(count(request('admins')) <= 0){
            $msg['error'] = trans('admin.no_admin_selected_to_delete');
        }else{
            foreach(request('admins') as $adminId){
                $adminId == admin()->user()->id ? $msg['error'] = trans('admin.can_not_remove_profile') : Admin::find($adminId)->delete() ? $msg['success'] = trans('admin.selected_admins_are_deleted') : $msg['error'] = trans('admin.admin_deleted_error');
            }
        }
        saveMsgToSession($msg);
        return back();
    }

    protected function validateData($emailContraints){
        return $this->validate(request(), [
            'name' => 'required',
            'email' => $emailContraints,
            'password' => 'required|min:6',
            ],[],[
                'name' => trans('admin.name'),
                'email' => trans('admin.email'),
                'password' => trans('admin.password'),
            ]);
    }

}
