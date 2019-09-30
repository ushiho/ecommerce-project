@extends('admin.index')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"> {{trans('admin.add_user')}} </h3>
        </div>
        <div class="box-body">
            {{ Form::open(['url' => userUrl('control'), 'method' => 'post']) }}
            <div class="form-group">
                {{ Form::label('name', trans('admin.name')) }}
                {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('email', trans('admin.email')) }}
                {{ Form::email('email', old('email'), ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('password', trans('admin.password')) }}
                {{ Form::password('password', ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('password_confirmation', trans('admin.confirm_password')) }}
                {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('level', trans('admin.level')) }}
                {{ Form::select('level', ['client' => trans('admin.client'), 'vendor' => trans('admin.vendor'), 'company' => trans('admin.company')], null, ['placeholder' => '---'.trans('admin.pick_level').'---', 'class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::submit(trans('admin.save_changes'), ['class' => 'btn btn-success']) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection