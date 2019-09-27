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
        $data = $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ],[],[
            'name' => trans('admin.name'),
            'email' => trans('admin.email'),
            'password' => trans('admin.password'),
        ]);
        $data['password'] = bcrypt(request('password'));
        Admin::create($data);
        session()->flash('success', trans('admin.admin_added_success'));
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
        // $admin = Admin::where('id', $id)->first();
        $admin = Admin::find($id);
        return view("admin.admins.edit", ['title' => trans('admin.admin_edit'), 'admin' => $admin]);
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
        $data = $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:admins,'.$id,
            'password' => 'required|min:6',
        ],[],[
            'name' => trans('admin.name'),
            'email' => trans('admin.email'),
            'password' => trans('admin.password'),
        ]);

        $data['password'] = bcrypt(request('password'));
        Admin::find($id)->update($data);
        session()->flash('success', trans('admin.admin_edited_success'));
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
        //
    }

    public function deleteSelected(){
        return request();
    }
}
