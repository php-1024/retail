<table class="table table-striped b-t b-light">
    <thead>
    <tr>
        <th>ID</th>
        <th>微信头像</th>
        <th>用户账号</th>
        <th>微信昵称</th>
        <th>关注公众号</th>
        <th>源头商家</th>
        <th>推荐人</th>
        <th>粉丝标签</th>
        <th>注册时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($list as $key=>$value)
        <tr>
            <td>{{$value->id}}</td>
            <td>
                @if(!$value->head_imgurl)
                    <img src="{{asset('public/Fansmanage')}}/img/m1.jpg" alt=""
                         class="r r-2x img-full" style="width: 50px; height: 50px;">
                @else
                    <img src="{{$value->head_imgurl}}" alt="" class="r r-2x img-full"
                         style="width: 50px; height: 50px;">
                @endif
            </td>
            <td>{{$value->user->account}}</td>
            <td>{{$value->nickname}}</td>
            <td><label class="label label-success">是</label></td>
            <td><label class="label label-info">
                    @if($value->userOrigin->origin_id==$organization_id)
                        {{$store_name}}
                    @else
                        零壹联盟
                    @endif</label></td>
            <td><label class="label label-primary">{{$value->recommender_name}}</label>
            </td>
            <td>
                <select style="width:100px" class="chosen-select2"
                        onchange="changeUserTag(this,'{{$value->user_id}}','{{$value->nickname}}')">
                    <option value="0">无标签</option>
                    @foreach($label as $k=>$v)
                        <option value="{{$v->id}}"
                                @if($v->id == $value->label_id) selected @endif>{{$v->label_name}}</option>
                    @endforeach
                </select>
            </td>
            <td>{{$value->created_at}}</td>
            <td>
                <button class="btn btn-info btn-xs" id="editBtn"
                        onclick="getEditForm({{$value->id}})"><i class="fa fa-edit"></i>&nbsp;&nbsp;粉丝详情
                </button>
                <button class="btn btn-primary btn-xs" id="balanceBtn"
                        onclick="getwalletForm()"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;粉丝钱包
                </button>
                @if($value->status == 1 || $value->status == -1)
                    <button class="btn btn-warning btn-xs" id="lockBtn"
                            onclick="getlockForm('{{$value->id}}','{{$value->status}}')">
                        <i class="fa fa-lock"></i>&nbsp;&nbsp;冻结
                    </button>
                @else
                    <button class="btn btn-success btn-xs" id="lockBtn"
                            onclick="getlockForm({{$value->id}},'{{$value->status}}')">
                        <i class="fa fa-lock"></i>&nbsp;&nbsp;解结
                    </button>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>