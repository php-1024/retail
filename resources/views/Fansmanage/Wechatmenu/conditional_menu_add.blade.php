<header class="panel-heading font-bold">
    自定义菜单设置
</header>

<form class="form-horizontal" role="form" id="conditional_menu_add_check" action="{{ url('fansmanage/ajax/conditional_menu_add_check') }}">
    <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
    <input type="hidden" id="wechat_menu_add" value="{{ url('fansmanage/ajax/wechat_menu_add') }}">
    <input type="hidden" name="response_type" id="response_type" value="1">
    <input type="hidden" id="conditional_menu_get" value="{{ url('fansmanage/ajax/conditional_menu_get') }}">
    <input type="hidden" id="conditional_menu_list" value="{{ url('fansmanage/ajax/conditional_menu_list') }}">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="input-id-1">会员标签组</label>
        <div class="col-sm-10">
            <select  class="form-control m-b" onchange="changeConditionalMenu(this)" name="label_id">
                <option value ="0">无</option>
                @foreach($label_list as $key=>$value)
                    <option value ="{{$value->id}}">{{$value->label_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group" id="menu"></div>

    <div class="line line-dashed b-b line-lg pull-in"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="input-id-1">菜单名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="限制四个字" name="menu_name" value="">
        </div>
    </div>

    <div class="line line-dashed b-b line-lg pull-in"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="input-id-1">事件类型</label>
        <div class="col-sm-10">
            <div class="btn-group" data-toggle="buttons">
                <label class="btn btn-sm btn-info" style="margin-right: 5px;margin-top: 10px;"  id="type_1" onclick="$('#response_type').val(1)">
                    <input type="radio" name="event_type" value="1"><i class="fa fa-check text-active"></i> 链接
                </label>

                <label class="btn btn-sm btn-info onclick type_2" style="margin-right: 5px;margin-top: 10px;" >
                    <input type="radio" name="event_type" value="2"><i class="fa fa-check text-active"></i> 模拟关键字
                </label>

                <label class="btn btn-sm btn-info onclick type_2" style="margin-right: 5px;margin-top: 10px;">
                    <input type="radio" name="event_type" value="3"><i class="fa fa-check text-active"></i> 扫码
                </label>

                <label class="btn btn-sm btn-info onclick type_2" style="margin-right: 5px;margin-top: 10px;">
                    <input type="radio" name="event_type" value="4"><i class="fa fa-check text-active"></i> 扫码(带等待信息)
                </label>

                <label class="btn btn-sm btn-info onclick type_2" style="margin-right: 5px;margin-top: 10px;">
                    <input type="radio" name="event_type" value="5"><i class="fa fa-check text-active"></i> 拍照发图
                </label>

                <label class="btn btn-sm btn-info onclick type_2" style="margin-right: 5px;margin-top: 10px;">
                    <input type="radio" name="event_type" value="6"><i class="fa fa-check text-active"></i> 拍照或者相册发图
                </label>

                <label class="btn btn-sm btn-info onclick type_2" style="margin-right: 5px;margin-top: 10px;">
                    <input type="radio" name="event_type" value="7"><i class="fa fa-check text-active"></i> 微信相册发图
                </label>

                <label class="btn btn-sm btn-info onclick type_2" style="margin-right: 5px;margin-top: 10px;">
                    <input type="radio" name="event_type" value="8"><i class="fa fa-check text-active"></i> 地理位置
                </label>
            </div>
            <span class="help-block m-b-none">
                      <p class="text-danger">事件类型为"链接"时，响应类型必须为跳转链接</p>
                  </span>
        </div>
    </div>

    <div class="line line-dashed b-b line-lg pull-in"></div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="input-id-1">响应类型</label>
        <div class="col-sm-10">
            <section class="panel panel-default">
                <header class="panel-heading text-right bg-light">
                    <ul class="nav nav-tabs pull-left">
                        <li id="link_type" class="active"><a href="#link_response" onclick="$('#response_type').val(1)" data-toggle="tab"><i class="fa fa-file-text-o text-muted"></i>&nbsp;&nbsp;跳转链接</a></li>
                        <li id="text_type"><a href="#text_response" onclick="$('#response_type').val(2)" data-toggle="tab"><i class="icon icon-picture text-muted"></i>&nbsp;&nbsp;关键字回复</a></li>
                    </ul>
                    <span class="hidden-sm">&nbsp;</span>
                </header>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="link_response">
                            <input type="text" class="form-control" name="response_url" value="" placeholder="跳转链接">
                            <span class="help-block m-b-none">
                                    <p>指定点击此菜单时要跳转的链接（注：链接需加http://）</p>
                                </span>
                        </div>
                        <div class="tab-pane fade in" id="text_response">
                            <select style="width:260px" name="response_keyword" class="chosen-select2">
                                <option value ="">请选择关键字</option>
                                @foreach($wechatreply as $key=>$val)
                                    <option value ="{{$val->keyword}}">{{$val->keyword}}</option>
                                @endforeach
                            </select>
                            <span class="help-block m-b-none">
                                    <p>指定点击此菜单时要执行的操作, 你可以在这里输入关键字, 那么点击这个菜单时就就相当于发送这个内容至公众号</p>
                                    <p>这个过程是程序模拟的, 比如这里添加关键字: 优惠券, 那么点击这个菜单是, 相当于接受了粉丝用户的消息, 内容为"优惠券"</p>
                                </span>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="line line-dashed b-b line-lg pull-in"></div>

    <div class="form-group">
        <div class="col-sm-12 col-sm-offset-3">
            <button type="button" class="btn btn-success" onclick="addPostForm()">添加菜单</button>
        </div>
    </div>
    <div class="line line-dashed b-b line-lg pull-in"></div>
</form>

<script>
    $(function() {
        get_menu();
    })



    function get_menu(){
        var url = $('#conditional_menu_list').val();
        var token = $('#_token').val();
        var data = {'_token':token};
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
                $('#menu').html(response);
            }
        });
    }

    function changeConditionalMenu(obj){
        var label_id = $(obj).val();
        var url = $('#conditional_menu_get').val();
        var menu_url = $('#conditional_menu_list').val();
        var token = $('#_token').val();
        var data = {'_token':token,'label_id':label_id};
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
                $('#menu_box').html(response);
            }
        });
        $.post(menu_url,data,function(response){
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
                $('#menu').html(response);
            }
        });
    }

    $(function(){
        $('.onclick').click(function(){
            $('#response_type').val(2);
        });
        $('#type_1').click(function(){
            $('#text_type').removeClass('active');
            $('#text_response').removeClass('active');
            $('#link_type').addClass('active');
            $('#link_response').addClass('active');

        });
        $('.type_2').click(function(){
            $('#link_type').removeClass('active');
            $('#link_response').removeClass('active');
            $('#text_type').addClass('active');
            $('#text_response').addClass('active');
        });
    });
    function addPostForm(){
        var target = $("#conditional_menu_add_check");
        var url = target.attr("action");
        var data = target.serialize();

        console.log(data);
//        $.post(url,data,function(json){
//            if(json.status==1){
//                swal({
//                    title: "提示信息",
//                    text: json.data,
//                    confirmButtonColor: "#DD6B55",
//                    confirmButtonText: "确定"
//                },function(){
//                    window.location.reload();
//                });
//            }else{
//                console.log(json);
////                swal({
////                    title: "提示信息",
////                    text: json.data,
////                    confirmButtonColor:"#DD6B55",
////                    confirmButtonText: "确定"
////                });
//            }
//        });
    }
</script>