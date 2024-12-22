<div class="formControl {{$col}}">
    @if($lV)
        <label class="form-label">{{$l}}
            @if($req)
                <span class="req">*</span>
            @endif
        </label>
    @endif
    <div class="input-container inputType_{{$inputType}}">
        @if($i)
            <i class="{{$i}}"></i>
        @endif

        @if($inputType == 'input')
            <input id="{{$id}}"
                   name="{{$name}}"
                   value="{{old($name,$v)}}"
                   class="form-control myInput {{$dir}} {{$withIcon}} {{$addStyle}} @error($name) is-invalid @enderror "
                   type="{{$type}}" {!! $holder !!} {!! $reqType !!}
            >
        @elseif($inputType == 'text')
            <textarea
                id="{{ $id }}"
                name="{{ $name }}"
                class="form-control myInput {{$dir}} {{ $withIcon }} {{$addStyle}} @error($name) is-invalid @enderror"
                {!! $holder !!}
                {!! $reqType !!}>{{ old($name, $v) }}</textarea>

        @elseif($inputType == 'sel')
            <select class="form-control btn-square" name="{{$name}}" {!! $reqType !!}>
                <option value="">{{__('portal/dash.form_pleses_sel')}}</option>
                @foreach($selArr as $key => $val)
                    <option value="{{$key}}" @if ($key == old($name, $v)) selected @endif >{{$val}}</option>
                @endforeach
            </select>

        @elseif($inputType == 'defCat')
            <select class="form-control btn-square" name="{{$name}}" {!! $reqType !!}>
                <option value="">{{__('portal/dash.form_pleses_sel')}}</option>
                @foreach($selArr as $key => $val)

                    <option value="{{ $val->id }}" @if ($val->id == $v) selected @endif>{{ $val->name }}</option>
                @endforeach
            </select>


        @elseif($inputType == 'color')
            <input class="form-control form-control-color" type="color" name="{{$name}}" value="{{$v}}" wfd-id="id26">
        @endif

        @if($info == 1)
            <div class="inputInfo">{{$info}}</div>
        @endif

        @error($name)
        <div class="invalid-feedback" role="alert">{{ \App\Helpers\AdminHelper::error($message,$name,$l) }}</div>
        @enderror
    </div>
</div>
