@extends('admin.index')


@section('content')
    <div class="box">
        <div class="box-header">
            <div class="box-title">{{ trans('admin.edit_user') }}</div>
        </div>
        <div class="box-body">
        {{ Form::open(['url' => userUrl('control/'.$user->id), 'method' => 'put', 'id' => 'edit-user']) }}
            <div class="form-group">
                {{ Form::label('name', trans('admin.name')) }}
                {{ Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => trans('admin.name')]) }}
            </div>
            <div class="form-group">
                {{ Form::label('email', trans('admin.email')) }}
                {{ Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => trans('admin.email')]) }}
            </div>
            <div class="form-group">
                {{ Form::label('password', trans('admin.password')) }}
                {{ Form::password('password', ['class' => 'form-control', 'placeholder' => trans('admin.password')]) }}
            </div>
            <div class="form-group">
                {{ Form::label('password_confirmation', trans('admin.confirm_password')) }}
                {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('admin.password')]) }}
            </div>
            <div class="form-group">
                {{ Form::label('level', trans('admin.level')) }}
                {{ Form::select('level', ['client' => trans('admin.client'), 'vendor' => trans('admin.vendor'), 'company' => trans('admin.company')], $user->level, ['class' => 'form-control', 'placeholder' => trans('admin.pick_level')]) }}
            </div>
            <div class="form-group">
                {{ Form::submit(trans('admin.save_changes'), ['class' => 'form control btn btn-success']) }}
            </div>
        {{ Form::close() }}
        </div>
    </div>
@endsection