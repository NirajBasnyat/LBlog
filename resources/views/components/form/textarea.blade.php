<div class="mb-3 row">
    <label for="{{$id ?? $name}}" class="col-md-2 col-form-label">{{$label ?? 'TextArea'}}</label>

    <div class="col-md-10">
        <textarea class="{{$class ?? 'form-control'}}" name="{{$name}}" id="{{$id ?? $name}}" rows="{{$rows ?? 5}}" cols="{{$cols ?? 5}}">{{$value}}</textarea>
        @error($name) <span class="text-danger">{{ $message }}</span> @enderror
    </div>
</div>