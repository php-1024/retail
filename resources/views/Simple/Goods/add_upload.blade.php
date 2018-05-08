<div class="table-responsive">
    @foreach($thumb as $key=>$val)
        <img src="http://develop.01nnt.com/uploads/simple/20180425104330148.jpg" />
    @endforeach
</div>


<script>
    function editDisplayorder(id,obj){
        var url = $('#thumb_edit_displayorder_url').val();
        var token = $('#_token').val();
        var displayorder = $(obj).val();

        if(id==''){
            swal({
                title: "提示信息",
                text: '数据传输错误',
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "确定",
            },function(){
                window.location.reload();
            });
            return;
        }

        var data = {'id':id,'displayorder':displayorder,'_token':token};
        $.post(url,data,function(response){
            if(response.status!='1'){
                swal({
                    title: "提示信息",
                    text: response.data,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定",
                },function(){
                    //window.location.reload();
                });
            }else{
                swal({
                    title: "温馨提示",
                    text: response.data,
                    type: "success"
                });
            }

        });
    }
</script>

