@if(Session::has('AddDone'))

    <div class="alert alert-success alert-dismissible">
        @if(Session('AddDone'))
            {{ Session('AddDone') }}
        @else
            {{__('alertMass.confirm_add')}}
        @endif
    </div>

@elseif(Session::has('UpdateDone'))

    <div class="alert alert-success alert-dismissible">
        @if(Session('UpdateDone'))
            {{Session('UpdateDone')}}
        @else
            {{__('alertMass.confirm_update')}}
        @endif
    </div>

@elseif(Session::has('EditDone'))

    <div class="alert alert-success alert-dismissible">
        {{__('alertMass.confirm_edit')}}
    </div>

@elseif(Session::has('confirmDelete'))

    <div class="alert alert-danger alert-dismissible">
        {{__('alertMass.confirm_delete')}}
    </div>

@elseif(Session::has('Error'))
    <div class="alert alert-danger alert-dismissible">
        {{ Session('Error') }}
    </div>
@elseif(Session::has('err'))
    <div class="alert alert-danger alert-dismissible">
        {{ Session('err') }}
    </div>
@elseif(Session::has('err_s'))
    <div class="alert alert-success alert-dismissible">
        {{ Session('err_s') }}
    </div>

@elseif(Session::has('ExceptionNotSave'))

    <div class="alert alert-danger alert-dismissible">
        {{__('alertMass.confirm_not_save')}}
    </div>

@else
    @if($errors->has([]))
        <div class="alert alert-danger alert-dismissible">
            {{__('alertMass.def_form_err')}}
            @if($fullErr)
                <ul class="form_all_err">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif
@endif
