@extends('admin.index')

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{ trans('admin.users_control') }}</h3 class="box-title">
        </div>
        <div class="box-body">
            {{ Form::open(['url' => userUrl('control/delete/selected'), 'method' => 'delete', 'id' => 'del-form']) }}
            {{ $dataTable->table(['class' => 'dataTable table table-bordered table-hover'], true) }}
            {{ Form::close() }}
        </div>
    </div>

      <!-- Del Warning Modal -->
    <div class="modal fade" id="warning-del" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title alert alert-danger" id="myModalLabel" role="alert"> {{ trans('admin.warning') }} </h4>
            </div>
            <div class="modal-body">
                <p id="no-empty-record" class="hidden"> {{ trans('admin.confirm_delete') }}&nbsp;<span id="number-checked"></span></p>
                <p id="empty-record" class="hidden">{{ trans('admin.no_admin_to_delete') }}</p>
                <p id="one-record" class="hidden">{{ trans('admin.del_one_record') }} <span class="danger" id="record-name"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal" onclick="makeAllMsgHidden('{{ userUrl('control/delete/selected') }}')">{{ trans('admin.close') }}</button>
                <button id="del-record" type="button" class="btn btn-danger hidden" onclick="deleteConfirmed()">{{ trans('admin.ok')}}</button>
            </div>
            </div>
        </div>
    </div>

      <!-- Show User Modal -->
    <div class="modal fade" id="show-details" tabindex="-1" role="dialog" aria-labelledby="shwoUserModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title alert alert-info" id="shwoUserModal" role="alert"> {{ trans('admin.details') }} </h4>
            </div>
            <div class="modal-body">
                <form class="form-inline">
                    <div class="form-group">
                        <label for="exampleInputName2">Name</label>
                        <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail2">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">
                    </div>
                    <button type="submit" class="btn btn-default">Send invitation</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.close') }}</button>
                <button id="del-record" type="button" class="btn btn-danger hidden">{{ trans('admin.ok')}}</button>
            </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        
        /* table thead th:first-child {
            width: 50%;
        } */
        /* table thead th:nth-child(1) {
            width: 2%;
        }
        table thead th:nth-child(2) {
            width: 3%;
        }
        table thead th:nth-child(3) {
            width: 5%;
        }
        table thead th:nth-child(4) {
            width: 5%;
        } */
        table thead th:nth-child(5) {
            width: 30%;
        }
        table thead th:nth-child(6) {
            width: 15%;
        }
        table thead th:nth-child(7) {
            width: 15%;
        }
        table thead th:nth-child(8) {
            width: 40%;
        }
    </style>
    @endpush
    @push('js')
    {{ 
        $dataTable->scripts() 
    }}
    @endpush
@endsection()