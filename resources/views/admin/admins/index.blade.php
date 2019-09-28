@extends('admin.index')

@section('content')
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">{{ trans('admin.admin_control') }}</h3>
    </div>
    <div class="box-body">
      {!! Form::open(['id' => 'del-form', 'url' => aurl('control/delete/selected'), 'method' => 'DELETE']) !!}
        {{ $dataTable->table(['class' => 'dataTable table table-bordered table-hover '], true) }}
      {!! Form::close() !!}
    </div>
  </div>


  <!-- Modal -->
  <div class="modal fade" id="warning-del" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="makeAllMsgHidden()"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title alert alert-danger" id="myModalLabel" role="alert"> {{ trans('admin.warning') }} </h4>
        </div>
        <div class="modal-body">
          <p id="no-empty-record" class="hidden"> {{ trans('admin.confirm_delete') }}&nbsp;<span id="number-checked"></span></p>
          <p id="empty-record" class="hidden">{{ trans('admin.no_admin_to_delete') }}</p>
          <p id="one-record" class="hidden">{{ trans('admin.del_one_record') }} <span class="danger" id="record-name"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal" onclick="makeAllMsgHidden()">{{ trans('admin.close') }}</button>
          <button id="del-record" type="button" class="btn btn-danger hidden" onclick="deleteConfirmed()">{{ trans('admin.ok')}}</button>
        </div>
      </div>
    </div>
  </div>
  @push('js')
      {{
        $dataTable->scripts()
      }}
  @endpush
@endsection
