@extends('admin.index')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ trans('admin.settings') }}</h3>
        </div>
        <div class="box-body">
        {{ Form::open(['url' => aurl('site/settings/save'), 'method' => 'post']) }}
            <div class="form-group">
                {{ Form::label('sitename_ar', trans('admin.sitename_ar')) }}
                {{ Form::text('sitename_ar', setting()->sitename_ar, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('sitename_en', trans('admin.sitename_en')) }}
                {{ Form::text('sitename_en', setting()->sitename_en, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('email', trans('admin.email')) }}
                {{ Form::email('email', setting()->email, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('main_lang', trans('admin.main_lang')) }}
                {{ Form::select('main_lang', ['en' => trans('admin.english'), 'ar' => trans('admin.arabic'), 'fr' => trans('admin.french')], setting()->main_lang, ['class' => 'form-control', 'placeholder' => '---Pick a main language---']) }}
            </div>
            <div class="form-group">
                {{ Form::label('status', trans('admin.status')) }}
                {{ Form::select('status', ['close' => 'close', 'open' => 'open'], setting()->status, ['class' => 'form-control', 'placeholder' => '---Pick a status---']) }}
            </div>
            <div class="form-group">
                {{ Form::label('logo', trans('admin.logo')) }}
                {{ Form::file('logo', ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('icon', trans('admin.icon')) }}
                {{ Form::file('icon', ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('description', trans('admin.description')) }}
                {{ Form::textarea('description', setting()->description, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('keywords', trans('admin.keywords')) }}
                {{ Form::textarea('keywords', setting()->keywords, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('msg_maintenance', trans('admin.msg_maintenance')) }}
                {{ Form::textarea('msg_maintenance', setting()->msg_maintenance, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::submit(trans('admin.save_changes'), ['class' => 'btn btn-success']) }}
            </div>
        {{ Form::close() }}
        </div>
    </div>
@endsection