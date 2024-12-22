@extends('admin.layouts.app')

@section('content')
    <x-admin.hmtl.breadcrumb :pageData="$pageData"/>
    <x-admin.hmtl.section>
        <x-admin.card.def :page-data="$pageData">

            <form data-parsley-validate class="mainForm" action="{{route($PrefixRoute.'.update',intval($users->id))}}" method="post"
                  enctype="multipart/form-data">
                @csrf
                <div class="col-lg-12">

                    <div class="row">
                        <x-admin.form.input name="name" :row="$users" :label="__('admin/config/roles.users_fr_name')" col="4" tdir="ar"/>
                        <x-admin.form.input name="email" :row="$users" :label="__('admin/config/roles.users_fr_email')" col="4" tdir="en"/>
                        <x-admin.form.input name="phone" :row="$users" :label="__('admin/config/roles.users_fr_phone')" col="4" tdir="en"/>


                        <x-admin.form.input name="user_password" value="{{ old('user_password') }}" :label="__('admin/form.text_password')"
                                            :req="$pageData['passReq']" col="4" type="password" tdir="en"/>

                        <x-admin.form.input name="user_password_confirmation" value="{{old('user_password_confirmation')}}"
                                            :label="__('admin/form.text_password_confirm')" :req="$pageData['passReq']" col="4" type="password"
                                            tdir="en"/>
                        <x-admin.form.input name="slug" :row="$users" label="Slug" col="4" tdir="en"/>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{__('admin/config/roles.users_fr_role')}}</label>
                                @php
                                    $printName = getRoleName();
                                @endphp
                                <select class="select2  @error('roles') is-invalid @enderror" name="roles[]" multiple="multiple"
                                        data-placeholder="{{__('admin/config/roles.users_fr_role_selone')}}" style="width: 100%;">
                                    @foreach($roles as $role)
                                        <option value="{{$role->name}}" @if(isset($userRole[$role->id])) selected @endif >{{ $role->$printName }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                              <strong>{{ \App\Helpers\AdminHelper::error($errors->first('roles'),'roles',"hany") }}</strong>
                            </span>
                            </div>
                        </div>
                    </div>
                    <hr>

                    @if($crmActive)
                        <div class="row">
                            <x-admin.form.select-arr name="crm_crm" :sendvalue="old('crm_crm',$users->crm_crm)" :l="__('admin/config/roles.crm_crm')" :req="false" col="3" type="selActive"/>
                            <x-admin.form.select-arr name="crm_sales" :sendvalue="old('crm_sales',$users->crm_sales)" :l="__('admin/config/roles.crm_sales')" :req="false" col="3" type="selActive"/>
                            <x-admin.form.select-arr name="crm_tech" :sendvalue="old('crm_tech',$users->crm_tech)" :l="__('admin/config/roles.crm_tech')" :req="false" col="3" type="selActive"/>
                        </div>
                        <div class="row">
                            <x-admin.form.select-multiple name="crm_team" :categories="$team" :sel-cat="old('crm_team',$users->crm_team)" :label="__('admin/config/roles.crm_team')" :req="false"
                                                          :has-trans="false" col="12"/>
                        </div>
                        <hr>
                        <x-admin.form.textarea name="des" value="{!! old('des',$users->des) !!}" :label="__('admin/config/roles.users_des')"/>

                        <hr>
                    @endif
                    <x-admin.form.upload-file view-type="{{$pageData['ViewType']}}" :row-data="$users" thisfilterid="1" :emptyphotourl="$PrefixRoute.'.emptyPhoto'" :multiple="false"/>
                </div>


                <x-admin.form.submit-role-back :page-data="$pageData"/>
            </form>

        </x-admin.card.def>
    </x-admin.hmtl.section>


@endsection

