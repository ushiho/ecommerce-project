<a href="{{ userUrl('control/'.$id.'/edit') }}" class="btn btn-primary btn-s" title=" {{ trans('admin.edit') }} "><i class="fa fa-edit"></i></a>
<a href="#" onclick="warningDelOne('{{$id}}', '{{$name}}', '{{ userUrl('control/') }}')" class="btn btn-danger btn-s" title=" {{ trans('admin.delete') }} "><i class="fa fa-trash"></i></a>
<a href="#" class="btn btn-warning" onclick="showDetails()"><i class="fa fa-eye"></i></a>