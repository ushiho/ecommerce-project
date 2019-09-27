<a href="{{ aurl('control/'.$id.'/edit') }}" class="btn btn-info btn-s" title="{{ trans('admin.edit') }}"><i class="fa fa-edit"></i></a>
<a href="#" class="btn btn-danger btn-s del-record-btn" title="{{ trans('admin.delete') }}" id="del-record-btn-{{$id}}"
onclick='warningDelOne("{{$id}}", "{{$name}}")'><i class="fa fa-trash"></i></a>