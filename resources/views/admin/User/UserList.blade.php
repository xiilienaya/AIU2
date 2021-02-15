@extends('admin.layout')
@section('content')
    <style type="text/css">
        .layui-table-cell{
            text-align:center;
            height: auto;
            white-space: normal;
        }
        .layui-table img{
            max-width:100px
        }
    </style>
    <div style="padding: 15px;">
        <table class="layui-hide" id="demo"></table>
    </div>
    <script type="text/html" id="toolbarDemo">
    </script>
    <script>
        $(function(){
            layui.use(['table','laydate'], function(){
                var table = layui.table;
                var laydate = layui.laydate;
                laydate.render({
                    elem: '#test1' //指定元素
                });

                //展示已知数据
                table.render({
                    elem: '#demo'
                    ,toolbar: '#toolbarDemo' //开启头部工具栏，并为其绑定左侧模板
                    ,defaultToolbar: ['filter', 'exports', 'print', { //自定义头部工具栏右侧图标。如无需自定义，去除该参数即可
                        title: '提示'
                        ,layEvent: 'LAYTABLE_TIPS'
                        ,icon: 'layui-icon-tips'
                    }]
                    ,cols: [[
                        {field: 'user_id', title: '用户ID', width: 100, sort: true}
                        ,{field: 'user_name', title: '用户名称', width: 110}
                        ,{field: 'user_tel', title: '用户手机号', width: 200}
                        ,{field: 'user_img', title: '用户头像',width: 200 , height:100}
                        ,{field: 'user_sex', title: '用户性别', width: 90}
                        ,{field: 'user_zctime', title: '加入时间',align:'center',width: 200}
                        ,{field: 'user_signature', title: '用户个人签名 ',align:'center',width: 150}
                        ,{fixed: 'right', align:'center',width:'230',field: 'operate', title: '操作'}


                    ]]
                    ,data: [
                            <?php foreach($data as $k=>$v) { ?>
                        {
                            "user_id": "{{$v->user_id}}"
                            ,"user_name": "{{$v->user_name}}"
                            ,"user_tel": "{{$v->user_tel}}"
                            ,"user_signature": "{{$v->user_signature}}"
                            ,"user_sex": "<?php if($v->user_sex=='1') {echo "<a class='layui-btn layui-btn-sm layui-bg-black'>男</a>";}else if($v->user_sex=='2'){ echo "<a class='layui-btn layui-btn-normal layui-btn-sm'>女</a>";}else{ echo "<a class='layui-btn layui-btn-danger layui-btn-sm'>???</a>";}?>"
                            ,"user_img": "<?php if($v->user_img=='') {}else{ echo "<img  src='{$v->user_img}'>";}?>"
                            ,"user_zctime": "{{date('Y-m-d H:i:s',$v->user_zctime)}}"
                            ,"operate": "<a class='layui-btn layui-btn-danger layui-btn-sm del' company_id='{$v->user_id}'>删除</a>"
                        },
                        <?php } ?>
                    ]
                    //,skin: 'line' //表格风格
                    // ,even: true
                    ,page: true //是否显示分页
                    //,limits: [5, 7, 10]
                    ,limit: 10 //每页默认显示的数量
                });
                //删除
                $('tbody').on('click',".del",function() {
                    var company_id=$(this).attr('company_id');

                    layer.confirm('确定删除吗?', {icon: 3, title:'温馨提示'}, function(index){
                        $.ajax({
                            url: "/admin/user/" + company_id,
                            type: "POST",
                            data: {_method: "DELETE"},
                            dataType: "json",
                            success: function (msg) {
                                layer.msg(msg.msg,{icon:msg.code});
                                setTimeout(function(){
                                    window.parent.location.reload();
                                },1000);//刷新父页面
                            }
                        });
                    });
                });
            })
        });
    </script>
@endsection