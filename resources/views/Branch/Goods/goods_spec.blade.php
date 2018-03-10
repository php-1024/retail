{{--@foreach($spec as $key=>$val)--}}
{{--<form method="get" role="form" id="searchForm" action="">--}}
    {{--<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">--}}
    {{--<input type="hidden" id="spec_item_add" value="{{ url('branch/ajax/spec_item_add') }}">--}}
    {{--<div class="m-t">--}}
        {{--<label class="label label-primary">{{$val->name}}</label>--}}
        {{--<button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>--}}
        {{--<button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>--}}
    {{--</div>--}}
    {{--<div class="m-t">--}}
        {{--@foreach($val->spec_item as $k=>$v)--}}
        {{--<div class="m-t col-lg-2">--}}
            {{--<label class="label label-success">{{$v->name}}</label>--}}
            {{--<button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>--}}
            {{--<button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>--}}
        {{--</div>--}}
        {{--@endforeach--}}
        {{--<div class="m-t col-lg-2">--}}
            {{--<button type="button" class="btn btn-info btn-xs" onclick="addSpecItem('{{$val->id}}')"><i class="fa fa-plus"></i>&nbsp;&nbsp;添加规格子项</button>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div style="clear: both;"></div>--}}
    {{--<div class="line line-dashed b-b line-lg pull-in"></div>--}}
{{--</form>--}}
{{--@endforeach--}}

<div class="m-t">
    <label class="label label-primary">主食</label>
    <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
    <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
</div>
<div class="m-t">
    <div class="m-t col-lg-2">
        <label class="label label-success">米饭</label>
        <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
    </div>
    <div class="m-t col-lg-2">
        <label class="label label-success">拉面</label>
        <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
    </div>
    <div class="m-t col-lg-2">
        <label class="label label-success">餐包</label>
        <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
    </div>
    <div class="m-t col-lg-2">
        <button type="button" class="btn addBtn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;&nbsp;添加规格子项</button>
    </div>
</div>
<div style="clear: both;"></div>
<div class="line line-dashed b-b line-lg pull-in"></div>
<div class="m-t">
    <label class="label label-primary">味道</label>
    <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
    <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
</div>
<div class="m-t">
    <div class="m-t col-lg-2">
        <label class="label label-success">酸</label>
        <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
    </div>
    <div class="m-t col-lg-2">
        <label class="label label-success">甜</label>
        <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
    </div>
    <div class="m-t col-lg-2">
        <label class="label label-success">苦</label>
        <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
    </div>
    <div class="m-t col-lg-2">
        <label class="label label-success">辣</label>
        <button type="button" class="btn editBtn btn-info btn-xs"><i class="fa fa-edit"></i></button>
        <button type="button" class="btn deleteBtn btn-danger btn-xs"><i class="fa fa-times"></i></button>
    </div>
    <div class="m-t col-lg-2">
        <button type="button" class="btn addBtn btn-info btn-xs"><i class="fa fa-plus"></i>&nbsp;&nbsp;添加规格子项</button>
    </div>
</div>
<div style="clear: both;"></div>
<div class="line line-dashed b-b line-lg pull-in"></div>
