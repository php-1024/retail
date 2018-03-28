<section class="panel panel-default">
    <header class="panel-heading font-bold">
        选择商品
    </header>
    <table class="table table-striped table-bordered ">
        <thead>
        <tr>
            <th>商品ID</th>
            <th>商品标题</th>
            <th>商品价格</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
    @foreach($goods as $key=>$val)
        <tr id="{{$val->id}}">
            <td class="id">{{$val->id}}</td>
            <td class="name">{{$val->name}}</td>
            <td class="price">{{$val->price}}</td>
            <td>
                <button onclick="goodsSelect({{$val->id}});" class="btn btn-info btn-xs" type="button">
                    <i class="fa fa-plus"></i>&nbsp;&nbsp;选择
                </button>
            </td>
        </tr>
    @endforeach
        </tbody>
    </table>
    <div style="clear: both;"></div>
</section>