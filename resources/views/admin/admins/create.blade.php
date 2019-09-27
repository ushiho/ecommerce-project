@extends('admin.index')

@section('content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">{{ trans('admin.admin_create') }}</h3>
    </div>
    <div class="box-body">
        {!! Form::open(['url' => aurl('control'), 'method' => 'post']) !!}
        <div class="form-group">
            {!! Form::label('name', trans('admin.name')) !!}
            {!! Form::text('name', old('name'), ['placeholder' => trans('admin.name'), 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('email', trans('admin.email')) !!}
            {!! Form::email('email', old('email'), ['placeholder' => trans('admin.email'), 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', trans('admin.password')) !!}
            {!! Form::password('password', ['placeholde' => trans('admin.password'), 'class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit(trans('admin.save_changes'), ['class' => 'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}
    </div>
  </div>

@endsection
