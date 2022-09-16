<div class="mb-3 row">
    <label for="{{$id ?? $name}}" class="col-md-2 col-form-label">{{$label ?? 'Text'}}</label>

    <div class="col-md-10">
        <input type="{{$type ?? 'text'}}" class="{{$class ?? 'form-control' }}" name="{{$name}}" id="{{$id ?? $name}}"
               value="{{$value ?? ''}}">

        @error($name) <span class="text-danger">{{ $message }}</span> @enderror
    </div>
</div>