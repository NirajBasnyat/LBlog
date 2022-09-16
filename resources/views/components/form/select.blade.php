<div class="mb-3 row">
    <label for="{{$id ?? $name}}" class="col-md-2 col-form-label">{{$label ?? 'Select'}}</label>

    <div class="col-md-10">
        <select name='{{$name}}' class="form-control" id="{{$id ?? $name}}">
            <option value="" disabled selected>Select from given options</option>
            @foreach($options as $key => $item)
                @if (isset($model))
                    <option value='{{ $key }}'
                            {{($model == $key || $model == $item) ? 'selected' : ''}}
                    >{{ $item }}</option>
                @else
                    <option value='{{ $key }}' {{old($name) == $key ? 'selected' : ''}}>{{ $item }}</option>
                @endif
            @endforeach
        </select>
        @error($name) <span class="text-danger">{{$message}}</span> @enderror

    </div>


</div>