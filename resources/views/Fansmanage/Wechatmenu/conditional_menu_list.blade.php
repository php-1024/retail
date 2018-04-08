<label class="col-sm-2 control-label" for="input-id-1">上级菜单</label>
<div class="col-sm-10">
    <select name="parent_id" class="form-control m-b" id="parent_id">
        <option value="0">无</option>
        @foreach($list as $key=>$val)
            <option value="{{$val->id}}" @if($val->id == $parent_id) selected @endif>{{$val->menu_name}}</option>
        @endforeach
    </select>
</div>