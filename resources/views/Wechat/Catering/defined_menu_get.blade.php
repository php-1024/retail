@if(!empty($list))
<div class="dd" id="nestable1">
    <ol class="dd-list">
        @foreach($defined_menu as $key=>$val)
        <li class="dd-item" data-id="2">
            <div class="dd-handle">
                  <span class="pull-right">
                    <button type="button" class="btn btn-success btn-xs" onclick="editForm()"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                    <button type="button" class="btn btn-success btn-xs delete_btn" onclick="deleteForm()"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
                  </span>
                {{$val['menu_name']}}
            </div>
            <ol class="dd-list">
                @foreach($val['so_menu'] as $kk=>$vv)
                <li class="dd-item" data-id="3">
                    <div class="dd-handle">
                          <span class="pull-right">
                            <button type="button" class="btn btn-success btn-xs" onclick="editForm()"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>
                            <button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>
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
@else
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title">
                <h1 style="color:#FF0000">请在右侧添加菜单</h1>
            </div>
        </div>
    </div>
@endif

{{--<div class="dd" id="nestable1">--}}
    {{--<ol class="dd-list">--}}
        {{--<li class="dd-item" data-id="2">--}}
            {{--<div class="dd-handle">--}}
                  {{--<span class="pull-right">--}}
                    {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                    {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                  {{--</span>--}}
                {{--主菜单1--}}
            {{--</div>--}}
            {{--<ol class="dd-list">--}}
                {{--<li class="dd-item" data-id="3">--}}
                    {{--<div class="dd-handle">--}}
                          {{--<span class="pull-right">--}}
                            {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                            {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                          {{--</span>--}}
                        {{--子菜单1--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li class="dd-item" data-id="3">--}}
                    {{--<div class="dd-handle">--}}
                          {{--<span class="pull-right">--}}
                            {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                            {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                          {{--</span>--}}
                        {{--子菜单1--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li class="dd-item" data-id="3">--}}
                    {{--<div class="dd-handle">--}}
                          {{--<span class="pull-right">--}}
                            {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                            {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                          {{--</span>--}}
                        {{--子菜单1--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li class="dd-item" data-id="3">--}}
                    {{--<div class="dd-handle">--}}
                          {{--<span class="pull-right">--}}
                            {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                            {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                          {{--</span>--}}
                        {{--子菜单1--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li class="dd-item" data-id="3">--}}
                    {{--<div class="dd-handle">--}}
                          {{--<span class="pull-right">--}}
                            {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                            {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                          {{--</span>--}}
                        {{--子菜单1--}}
                    {{--</div>--}}
                {{--</li>--}}
            {{--</ol>--}}
        {{--</li>--}}
        {{--<li class="dd-item" data-id="2">--}}
            {{--<div class="dd-handle">--}}
                  {{--<span class="pull-right">--}}
                    {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                    {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                  {{--</span>--}}
                {{--主菜单2--}}
            {{--</div>--}}
            {{--<ol class="dd-list">--}}
                {{--<li class="dd-item" data-id="3">--}}
                    {{--<div class="dd-handle">--}}
                          {{--<span class="pull-right">--}}
                            {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                            {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                          {{--</span>--}}
                        {{--子菜单1--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li class="dd-item" data-id="3">--}}
                    {{--<div class="dd-handle">--}}
                          {{--<span class="pull-right">--}}
                            {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                            {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                          {{--</span>--}}
                        {{--子菜单1--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li class="dd-item" data-id="3">--}}
                    {{--<div class="dd-handle">--}}
                          {{--<span class="pull-right">--}}
                            {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                            {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                          {{--</span>--}}
                        {{--子菜单1--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li class="dd-item" data-id="3">--}}
                    {{--<div class="dd-handle">--}}
                          {{--<span class="pull-right">--}}
                            {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                            {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                          {{--</span>--}}
                        {{--子菜单1--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li class="dd-item" data-id="3">--}}
                    {{--<div class="dd-handle">--}}
                          {{--<span class="pull-right">--}}
                            {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                            {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                          {{--</span>--}}
                        {{--子菜单1--}}
                    {{--</div>--}}
                {{--</li>--}}
            {{--</ol>--}}
        {{--</li>--}}
        {{--<li class="dd-item" data-id="2">--}}
            {{--<div class="dd-handle">--}}
                  {{--<span class="pull-right">--}}
                    {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                    {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                  {{--</span>--}}
                {{--主菜单3--}}
            {{--</div>--}}
            {{--<ol class="dd-list">--}}
                {{--<li class="dd-item" data-id="3">--}}
                    {{--<div class="dd-handle">--}}
                          {{--<span class="pull-right">--}}
                            {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                            {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                          {{--</span>--}}
                        {{--子菜单1--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li class="dd-item" data-id="3">--}}
                    {{--<div class="dd-handle">--}}
                          {{--<span class="pull-right">--}}
                            {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                            {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                          {{--</span>--}}
                        {{--子菜单1--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li class="dd-item" data-id="3">--}}
                    {{--<div class="dd-handle">--}}
                          {{--<span class="pull-right">--}}
                            {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                            {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                          {{--</span>--}}
                        {{--子菜单1--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li class="dd-item" data-id="3">--}}
                    {{--<div class="dd-handle">--}}
                          {{--<span class="pull-right">--}}
                            {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                            {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                          {{--</span>--}}
                        {{--子菜单1--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li class="dd-item" data-id="3">--}}
                    {{--<div class="dd-handle">--}}
                          {{--<span class="pull-right">--}}
                            {{--<button type="button" class="btn btn-success btn-xs" id="edit_btn"><i class="fa fa-edit"></i>&nbsp;&nbsp;编辑</button>--}}
                            {{--<button type="button" class="btn btn-success btn-xs delete_btn" id="edit_btn"><i class="fa fa-times"></i>&nbsp;&nbsp;删除</button>--}}
                          {{--</span>--}}
                        {{--子菜单1--}}
                    {{--</div>--}}
                {{--</li>--}}
            {{--</ol>--}}
        {{--</li>--}}
    {{--</ol>--}}
{{--</div>--}}