<span class="label 
    {{ $level == 'client' ? 'label-warning' : '' }}
    {{ $level == 'vendor' ? 'label-info' : '' }}
    {{ $level == 'company' ? 'label-success' : '' }}
    ">
    {{trans('admin.'.$level)}}
</span>