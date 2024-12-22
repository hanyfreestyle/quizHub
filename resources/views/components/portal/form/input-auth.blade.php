<div class="form-group">
    @if($lV)
        <label>{{$l}}</label>
    @endif
    <div class="input-container @error($name) is-invalid @enderror">
        @if($i)
            <i class="{{$i}}"></i>
        @endif
        <input type="{{$type}}" id="{{$id}}" name="{{$name}}" class="inputFont"  value="{{old($name)}}" {!! $holder !!} >
    </div>

    @error($name)
    <div class="invalid-feedback" role="alert">{{ \App\Helpers\AdminHelper::error($message,$name,$l) }}</div>
    @enderror
</div>
