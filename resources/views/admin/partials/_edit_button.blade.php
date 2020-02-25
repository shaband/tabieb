{{--
@params int required  $id
@params int required  $routeName

--}}
<a href="{!! route('admin.'.$routeName.'.edit',$id) !!}" class="btn btn-primary">
    <i class="fas fa-pencil-alt text-white"></i>
</a>

