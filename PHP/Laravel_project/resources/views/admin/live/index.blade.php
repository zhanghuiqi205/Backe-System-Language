<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
<script type="text/javascript" src="/admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/admin/lib/respond.min.js"></script>
<![endif]-->
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
<script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
    <title>直播课程管理</title>
</head>

<body>
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 直播课程中心 <span class="c-gray en">&gt;</span> 直播课程管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新"><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="text-c"> 日期范围：
            <input type="text" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}' })" id="datemin" class="input-text Wdate" style="width:120px;"> -
            <input type="text" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d' })" id="datemax" class="input-text Wdate" style="width:120px;">
            <input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
            <button type="submit" class="btn btn-success radius" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜直播课程</button>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20"> 
            <span class="l">
                <a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> 
                <a href="javascript:;" onclick="member_add('添加直播课程','/admin/member/add','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加直播课程</a>
            </span> 
            <span class="r">共有数据：<strong>88</strong> 条</span> </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                    <tr class="text-c">
                        <th width="25">
                            <input type="checkbox" name="" value="">
                        </th>
                        <th width="50">ID</th>
                        <th width="100">直播名</th>
                        <th width="40">所属专业</th>
                        <th width="90">使用流</th>
                        <th width="100">封面</th>
                        <th width="50">排序</th>
                        <th width="130">开始时间</th>
                        <th width="130">结束时间</th>
                        <th width="50">状态</th>
                        <th width="100">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $val)
                    <tr class="text-c">
                        <td>
                            <input type="checkbox" value="{{$val -> id}}" name="">
                        </td>
                        <td>{{$val -> id}}</td>
                        <td>{{$val -> live_name}}</td>
                        <td>{{$val -> rel_profession -> pro_name}}</td>
                        <td>{{$val -> rel_stream -> stream_name}}</td>
                        <td><img src="{{$val -> cover_img}}" width="100px;"></td>
                        <td>{{$val -> sort}}</td>
                        <td>{{date('Y-m-d H:i:s',$val -> begin_at)}}</td>
                        <td>{{date('Y-m-d H:i:s',$val -> end_at)}}</td>
                        <td class="td-status">
                            @if($val -> status == '2')
                            <span class="label radius">已停用</span>
                            @else
                            <span class="label label-success radius">已启用</span>
                            @endif
                        </td>
                        <td class="td-manage"><a style="text-decoration:none" onClick="member_stop(this,'10001')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a> <a title="编辑" href="javascript:;" onclick="member_edit('编辑','member-add.html','4','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="change_password('修改密码','change-password.html','10001','600','270')" href="javascript:;" title="修改密码"><i class="Hui-iconfont">&#xe63f;</i></a> <a title="删除" href="javascript:;" onclick="member_del(this,'1')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--_footer 作为公共模版分离出去-->
    <script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
    <script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script>
    <script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script>
    <!--/_footer 作为公共模版分离出去-->
    <!--请在下方写此页面业务相关的脚本-->
    <script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
    <script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
    <script type="text/javascript">
    $(function() {
        $('.table-sort').dataTable({
            "aaSorting": [
                [1, "asc"]
            ], //默认第几个排序
            // "bStateSave": true, //状态保存
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                { "orderable": false, "aTargets": [0, 8, 9] } // 制定列不参与排序
            ]
        });

    });
    /*直播课程-添加*/
    function member_add(title, url, w, h) {
        layer_show(title, url, w, h);
    }
    /*直播课程-查看*/
    function member_show(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    /*直播课程-停用*/
    function member_stop(obj, id) {
        layer.confirm('确认要停用吗？', function(index) {
            $.ajax({
                type: 'POST',
                url: '',
                dataType: 'json',
                success: function(data) {
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
                    $(obj).remove();
                    layer.msg('已停用!', { icon: 5, time: 1000 });
                },
                error: function(data) {
                    console.log(data.msg);
                },
            });
        });
    }

    /*直播课程-启用*/
    function member_start(obj, id) {
        layer.confirm('确认要启用吗？', function(index) {
            $.ajax({
                type: 'POST',
                url: '',
                dataType: 'json',
                success: function(data) {
                    $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
                    $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                    $(obj).remove();
                    layer.msg('已启用!', { icon: 6, time: 1000 });
                },
                error: function(data) {
                    console.log(data.msg);
                },
            });
        });
    }
    /*直播课程-编辑*/
    function member_edit(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    /*密码-修改*/
    function change_password(title, url, id, w, h) {
        layer_show(title, url, w, h);
    }
    /*直播课程-删除*/
    function member_del(obj, id) {
        layer.confirm('确认要删除吗？', function(index) {
            $.ajax({
                type: 'POST',
                url: '',
                dataType: 'json',
                success: function(data) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!', { icon: 1, time: 1000 });
                },
                error: function(data) {
                    console.log(data.msg);
                },
            });
        });
    }
    </script>
</body>

</html>