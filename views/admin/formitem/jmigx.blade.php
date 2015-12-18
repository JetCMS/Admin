@foreach($options as $key=>$val)
    @if(!isset($val['type']))
        <div class="form-group">
            <label for="context">{{$val['lable'] or $key}}</label>
            <input class="form-control" name="field_array[{{$key}}]" id="field_array_{{$key}}" value="{!! $field[$key] or '' !!}">
        </div>
    @elseif($val['type'] == 'textarea')
        <div class="form-group">
            <label for="context">{{$val['lable'] or $key}}</label>
            <textarea class="form-control" cols="50" rows="10" name="field_array[{{$key}}]">{!! $field[$key] or '' !!}</textarea>
        </div>
    @elseif($val['type'] == 'text')
        <div class="form-group">
            <label for="context">{{$val['lable'] or $key}}</label>
            <input class="form-control" name="field_array[{{$key}}]" id="field_array_{{$key}}" value="{!! $field[$key] or '' !!}">
        </div>
    @else
        <div class="form-group">
            <label for="context">{{$val['lable'] or $key}}</label>
            <input class="form-control" name="field_array[{{$key}}]" id="field_array_{{$key}}" value="{!! $field[$key] or '' !!}">
        </div>
    @endif
@endforeach
