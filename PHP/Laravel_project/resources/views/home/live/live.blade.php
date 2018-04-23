<?php
/**
 * @Author 黑马程序员-传智播客旗下高端教育品牌 [itcast.cn]
 * @Date    2018-04-22 14:56:56
 * @Version 1.0.0
 * @Description 在此替换文件描述
 */

?>
<!DOCTYPE html>
<!-- saved from url=(0220)https://www.boxuegu.com/web/html/video.html?courseId=154&sectionId=8a9bdf305961f81f015967460e7e00f1&chapterId=8a9bdf305961f81f015967462a1900f2&vId=8a2c9bed5961f9d801596828a66c00ad&videoId=5E97E334AFAC81B59C33DC5901307461 -->
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9">
    <title>{{$data -> live_name}} - 年轻人的在线IT课堂</title>
    <link rel="shortcut icon" href="https://www.boxuegu.com/favicon.ico">
    <meta name="keywords" content="Java培训,Android培训,安卓培训,PHP培训,C++培训,iOS培训,网页设计培训,平面设计培训,UI设计培训,游戏开发培训,移动开发培训,网络营销培训,web前端培训">
    <meta name="description" content="博学谷云课堂为传智播客旗下在线教育品牌，将积累10年的实体班线下课程和教学方法引到线上。课程大纲全新优化，内容有广度、有深度，顶尖讲师全程直播授课。专注整合传智优势教学资源、打造适合在线学习并能保证教学结果的优质教学产品，同时打造和运营一整套教育生态软件体系，为用户提供满足自身成长和发展要求的有效服务。">
    <meta name="renderer" content="webkit">
    <link rel="stylesheet" href="/home/css/bootstrap.min.css">
    <link rel="stylesheet" href="/home/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/home/css/mylogin.css">
    <link rel="stylesheet" href="/home/css/componet.css">
    <link rel="stylesheet" href="/home/css/footer.css">
    <link rel="stylesheet" href="/home/css/iconfont.css">
    <link rel="stylesheet" type="text/css" href="/home/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="/home/css/simditor.css">
    <link rel="stylesheet" type="text/css" href="/home/css/video.css">
    <script src="/home/js/jquery-1.12.1.js" type="text/javascript" charset="utf-8"></script>
    <script src="/home/js/artTemplate.js" type="text/javascript" charset="utf-8"></script>
    <script src="/home/js/jquery.pagination.js"></script>
    <script type="text/javascript" src="/home/js/jquery.dotdotdot.js"></script>
    <script type="text/javascript" src="/home/js/bootstrap.js"></script>
    <script type="text/javascript" src="/home/js/layer.js"></script>
    <link rel="stylesheet" href="/home/css/layer.css" id="layui_layer_skinlayercss">
    <script type="text/javascript" src="/home/js/jquery.form.min.js"></script>
    <script type="text/javascript" src="/home/js/module.js"></script>
    <script type="text/javascript" src="/home/js/simditor.js"></script>
    <script type="text/javascript" src="/home/js/uploader.js"></script>
    <script src="/home/js/jquery.nicescroll.js"></script>
    <script src="/home/js/ajax.js" type="text/javascript" charset="utf-8"></script>
    <script src="/home/js/helpers.js"></script>
    <script src="/home/js/html5.js" type="text/javascript" charset="utf-8"></script>
</head>

<body>
    <div class="rTips"></div>
    <div class="mask"></div>
    <div class="header">
        <div class="headerBody">
            <a><img src="/home/img/fanhui.png">返回列表</a>
            <span class="headerBody-title">{{$data -> live_name}}</span>
        </div>
    </div>
    <div class="videoBody">
        <!-- 删除之前的object标签和多余的div保证显示正常 -->
        <script type="text/javascript" src="/home/ckplayer/ckplayer.js"></script>
		<div id="video" style="width:100%;height:500px;"></div>
		<script type="text/javascript">
			var videoObject = {
				container:'#video',
				variable:'player',
				autoplay:true,
				video:'rtmp://pili-live-rtmp.28sjw.com/education-zet/{{$data -> rel_stream -> stream_name}}'
			};
			var player=new ckplayer(videoObject);
		</script>
    </div>
    <script src="/home/css/z_stat.php" type="text/javascript"></script>
    <script src="/home/css/core.php" charset="utf-8" type="text/javascript"></script>
    <script src="/home/js/jquery.placeholder.min.js"></script>
    <script type="text/javascript">
    function get_cc_verification_code(video_id) {
        var verificationcode;
        $.ajax({
            url: '/online/vedio/getCcVerificationCode',
            type: 'POST',
            async: false,
            data: {
                video_id: video_id,
                id: $.getUrlParam("vId")
            },
            success: function(data) {
                if (data.success) {
                    verificationcode = data.resultObject.verificationcode;
                } else {
                    //						alert(data.errorMessage)
                    if (data.errorMessage == "请登陆！") {
                        $('#login').modal('show');
                    }
                }
            }
        });
        return verificationcode;
    };
    $.getUrlParam = function(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]);
        return null;
    };

    //验证不通过的回调
    function onlinePlayCallbak(video_id) {
        //弹出我们自己的提示框
        //						$(".videomodal1").removeClass("hide");
        //						$(".backgrounds1").removeClass("hide");
        //			window.location.href="/web/html/payCourseDetailPage.html?id="+$.getUrlParam("courseId")+"&courseType=1&free=0";
    };
    //播放失败
    //		function on_player_playerror(video_id){
    //			alert(1)
    //			alert(code)
    //		};
    function on_spark_player_start(video_id) {
        RequestService("/video/updateStudyStatus", "POST", {
            studyStatus: 2,
            videoId: $.getUrlParam("vId")
        }, function(data) {
            console.log(data);
        });
    };

    function on_spark_player_stop(video_id) {
        RequestService("/video/updateStudyStatus", "POST", {
            studyStatus: 1,
            videoId: $.getUrlParam("vId")
        }, function(data) {
            console.log(data);
        });
        if ($(".freeTable-list .hoverBorder").next().length == 0 && $(".freeTable-list .hoverBorder").parent().next().length == 0) {
            $(".videomodal3").removeClass("hide");
            $(".backgrounds2").removeClass("hide");
        } else {
            $(".videomodal2").removeClass("hide");
            $(".backgrounds2").removeClass("hide");
        }
    }

    function countChar(textareaName, spanName) {
        var num = 200 - $(".textStatus").val().length;
        if (num >= 0) {
            $("#textCounter").html(num);
        } else {
            $("#textCounter").html(0);
        }
    }
    //去掉Loding
    function on_spark_player_ready() {
        $(".loadImg").css("display", "none");
        $(".shadowJiaZai").css("display", "none");
    }
    </script>
    <script src="/home/js/placeHolder.js"></script>
    <script type="text/javascript">
    $(function() {
        $('input').placeholder();
    });
    </script>
</body>

</html>