@if(!empty($list))
<form class="form-horizontal" role="form" id="defined_menu_edit" action="{{ url('api/ajax/defined_menu_edit') }}">
<input type="hidden" id="defined_menu_delete" value="{{ url('api/ajax/defined_menu_delete') }}">
<input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
<div class="dd" id="nestable1">
    <ol class="dd-list">
        @foreach($list as $key=>$val)
        <li class="dd-item" data-id="2">
            <div class="dd-handle">
                  <span class="pull-right">
                    <button type="button" class="btn btn-success btn-xs" onclick="getEditForm('{{$val['id']}}')"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                    <button type="button" class="btn btn-success btn-xs delete_btn" onclick="getDeleteForm('{{$val['id']}}')"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                  </span>
                {{$val['menu_name']}}
            </div>

            <ol class="dd-list">
                @foreach($val['so_menu'] as $kk=>$vv)
                <li class="dd-item" data-id="3">
                    <div class="dd-handle">
                          <span class="pull-right">
                            <button type="button" class="btn btn-success btn-xs" onclick="getEditForm('{{$vv['id']}}')"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                            <button type="button" class="btn btn-success btn-xs delete_btn" onclick="getDeleteForm('{{$val['id']}}')"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                          </span>
                        {{$vv['menu_name']}}
                    </div>
                </li>
                @endforeach
            </ol>
        </li>
        @endforeach
    </ol>
</div>
</form>
@else
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title">
                <h1 style="color:#FF0000">请在右侧添加菜单</h1>
            </div>
        </div>
    </div>
@endif
<script>
    function getEditForm(menu_id){
        var target = $("#defined_menu_edit");
        var url = target.attr("action");
        var token = $('#_token').val();
        var data = {'_token':token,'id':menu_id};
        $.post(url,data,function(response){
            if(response.status=='-1'){
                swal({
                    title: "提示信息",
                    text: response.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                },function(){
                    window.location.reload();
                });
                return;
            }else{
                $('#ctrl_box').html(response);
            }
        });
    }

    function getDeleteForm(menu_id){
        var url = $("#defined_menu_delete").val();
        var token = $('#_token').val();
        var data = {'_token':token,'id':menu_id};
        $.post(url,data,function(response){
            if(response.status=='-1'){
                swal({
                    title: "提示信息",
                    text: response.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                },function(){
                    window.location.reload();
                });
                return;
            }else{
                $('#myModal').html(response);
                $('#myModal').modal();
            }
        });
    }
</script>