<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTables;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTables $user)
    {
        return $user->render('admin.users.index', [
            'title' => trans('admin.users_control'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', ['title' => trans('admin.add_user')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validateData('email|required|unique:users');
        User::create($data);
        saveMsgToSession(['error' => '', 'success' => trans('admin.user_added_success')]);
        return redirect(userUrl(('control')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return is_null($user) ? with(dataNotFound()) : with(view('admin.users.edit', [
            'title' => trans('admin.edit_user'), 'user' => $user]
        ));
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
        $msg = ['success' => '', 'error' => ''];
        if(checkUserIfExist($id)){
            $data = $this->validateData('email|required|unique:users,'.$id);
            $data['password'] = bcrypt(request('password'));
            User::find($id)->update($data);
            $msg['success'] = trans('admin.user_edited_success');
        }else{
            $msg['error'] = trans('admin.entity_not_found');
        }
        saveMsgToSession($msg);
        return redirect(userUrl('control'));
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
        $users = request('users');
        $msg = ['error' => '', 'success' => ''];
        if(count($users) <= 0){
            $msg['error'] = trans('admin.no_user_selected_to_delete');
        }else{
            foreach($users as $id){
                if(checkUserIfExist($id)){
                    User::find($id)->delete();
                    $msg['success'] = trans('admin.selected_users_are_deleted');
                }else{
                    $msg['error'] = trans('admin.user_deleted_error');
                }
            }
            saveMsgToSession($msg);
            return back();
        }
    }

    protected function validateData($emailConstraints)
    {
        return $this->validate(request(), [
            'name' => 'required',
            'email' => $emailConstraints,
            'password' => 'required|min:6',
            'level' => 'required|in:client,vendor,company'
        ],[],[
            'name' => trans('admin.name'),
            'email' => trans('admin.email'),
            'password' => trans('admin.password'),
            'level' => trans('admin.level'),
        ]);
    }

}
