@foreach($spec as $key=>$val)
<form method="get" role="form" id="searchForm" action="">
    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
    <input type="hidden" id="spec_edit" value="{{ url('cateringbranch/ajax/spec_edit') }}">
    <input type="hidden" id="spec_delete" value="{{ url('cateringbranch/ajax/spec_delete') }}">
    <input type="hidden" id="spec_item_edit" value="{{ url('cateringbranch/ajax/spec_item_edit') }}">
    <input type="hidden" id="spec_item_delete" value="{{ url('cateringbranch/ajax/spec_item_delete') }}">
    <input type="hidden" id="spec_item_add" value="{{ url('cateringbranch/ajax/spec_item_add') }}">
    <div class="m-t">
        <label class="label label-primary">{{$val->name}}</label>
        <button type="button" class="btn editBtn btn-info btn-xs" onclick="editSpec('{{$val->id}}')"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn deleteBtn btn-danger btn-xs" onclick="deleteSpec('{{$val->id}}')"><i class="fa fa-times"></i></button>
    </div>
    <div class="m-t">
        @foreach($val->catering_spec_item as $k=>$v)
        <div class="m-t col-lg-2">
            <label class="label label-success">{{$v->name}}</label>
            <button type="button" class="btn editBtn btn-info btn-xs" onclick="editSpecItem('{{$v->id}}')"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn deleteBtn btn-danger btn-xs" onclick="deleteSpecItem('{{$v->id}}')"><i class="fa fa-times"></i></button>
        </div>
        @endforeach
        <div class="m-t col-lg-2">
            <button type="button" class="btn btn-info btn-xs" onclick="addSpecItem('{{$val->id}}','{{$val->goods_id}}')"><i class="fa fa-plus"></i>&nbsp;&nbsp;添加规格子项</button>
        </div>
    </div>
    <div style="clear: both;"></div>
    <div class="line line-dashed b-b line-lg pull-in"></div>
</form>
@endforeach
