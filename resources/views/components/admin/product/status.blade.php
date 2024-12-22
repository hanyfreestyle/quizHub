@if($viewtype == 'Add')
    <input type="hidden" name="is_active" value="1">
    <input type="hidden" name="is_archived" value="0">
    <input type="hidden" name="featured" value="0">
    <input type="hidden" name="on_stock" value="1">
    <input type="hidden" name="type" value="1">
    <input type="hidden" name="sales_count" value="1">
@elseif($viewtype == 'Edit')
    <div class="row">
        <x-admin.form.select-arr name="is_active" sendvalue="{{old('is_active',$row->is_active)}}" type="selActive" col="2" :l="__('admin/proProduct.pro_status_is_active')"/>
        <x-admin.form.select-arr name="featured" sendvalue="{{old('featured',$row->featured)}}" type="selActive" col="2" :l="__('admin/proProduct.pro_featured')"/>
        <x-admin.form.select-arr name="is_archived" sendvalue="{{old('is_archived',$row->is_archived)}}" type="selActive" col="2" :l="__('admin/proProduct.pro_is_archived_t')"/>
        <x-admin.form.select-arr name="on_stock" sendvalue="{{old('on_stock',$row->on_stock)}}" type="selActive" col="2" :l="__('admin/proProduct.pro_status_stock')"/>
        <x-admin.form.input name="sales_count" :row="$row" col="2" tdir="en" :req="false" :label="__('admin/proProduct.pro_sales_count')"/>
    </div>
@endif

