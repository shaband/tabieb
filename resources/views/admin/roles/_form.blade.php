<div class="form-group">
    <label for="name_ar">{!! __("Name In Arabic") !!} *</label>
    {!! Form::text('label_ar',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'label_ar','required','placeholder'=>__('Enter Name In Arabic')]) !!}
    @error('label_ar')
    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group">
    <label for="label_en">{!! __("Name In English") !!} *</label>
    {!! Form::text('label_en',null,['class'=>'form-control','parsley-trigger'=>'change','id'=>'label_en','required','placeholder'=>__('Enter Name In English')]) !!}
    @error('label_en')
    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<h5 class="mt-3">{!! __("Permissions") !!}</h5>
<select multiple="multiple" class="multi-select" id="permissions" name="permissions[]"
        data-plugin="multiselect" data-selectable-optgroup="true">
    @foreach($permissions_groups ??[] as $key=> $groups)
        <optgroup label="{!! __($key) !!}">
            @foreach($groups as $permission)
                <option
                    value="{!! $permission->id !!}"
                    @if(isset($role_permissions) &&in_array($permission->id,$role_permissions)) selected
                    @endif
                >{!! $permission->label !!}</option>

            @endforeach
        </optgroup>
    @endforeach

</select>

