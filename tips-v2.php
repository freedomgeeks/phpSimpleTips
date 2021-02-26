<?php
tips('asd',1);
/**
 * @param string $content 提示内容
 * @param boolbean $status
 * @param number $width div容器宽度
 */
function tips($content,$status=true,$width='100'){
    $status=$status?'right_ico.png':'error_ico.png';
  
    echo <<<EOF
     <script src='./js/jquery.min.js'></script>
    
   <script language='javascript' type='text/javascript'>
    $(document).ready(
        function(){
            /**
             *1.delay函数是jquery 1.4.2新增的函数
            *2.hide函数里必须放一个0,不然延时不起作用
             */
            $('#divid').delay(1000).hide(0);
        }
    );
    
    </script>
    
   <div  id="divid" class="divid"><img src="./img/$status" style="vertical-align: middle;"/>  $content</div>
    
    <style>
    
    .divid{
    padding-left:15px;
    padding-right:15px;
         margin-top:45px;
         font-size:14px;
        font-family: "Microsoft Yahei" ! important;
        background:rgba(250,240,205,10);
        width:$width.'px';
        text-align: center;
        line-height: 30px;
        border:1px solid rgba(243,224,65,1);
        border-radius:10px/2px;
         position: absolute;
        z-index:10000000;
    
        }
    </style>
 <script>
             function g(id){
	 	return document.getElementById(id);
	 }
   	 function autoCenter(el){
	 var bodyW=document.documentElement.clientWidth;
     var bodyH=document.documentElement.clientHeight;
    
     var elW=el.offsetWidth;
     var elH=el.offsetHeight;
    
     el.style.left=(bodyW-elW)/2+'px';
      el.style.top=(bodyH-elH)/15+'px';
	 }
            	  autoCenter(g('divid'));
 </script>
EOF;
  
}

 

/**
 * @param string $title 弹窗消息标题
 * @param string $content 弹窗消息内容
 */
function dialogAutoHide($title,$content){
    
    echo <<<EOF
    <link rel='stylesheet' href='./js/jquery-ui.min.css'>
     <script src='./js/jquery.min.js'></script>
    <script src='./js/jquery-ui.min.js'></script>
    <script>

    $(function() {

        $('#dialog').dialog({
            autoOpen: false,
            show: {
                effect: 'explode',//fadeToggle,blind,slideDown
                duration: 1000
            },
            hide: {
                effect: 'explode',//可选特效：toggle,slideToggle,fadeIn,explode,slow,slideUp,fadeToggle 默认是淡出隐藏
                duration: 1000
            }
        });

            $('body').animate({'top':'0px'},4000,function(){
                $( '#dialog' ).dialog('close');
            });

                $( '#dialog' ).dialog('open');

    });
    </script>

    <div id='dialog' title='$title'>
     <p>$content</p>
    </div>

EOF;
}

 
/**
 * @param string $url 弹窗关闭后要跳转的地址
 * @param string $title 弹窗消息标题
 * @param string $content 弹窗消息内容
 */
function dialog($title,$content,$url=false){
     
    $go="window.location='$url'";//;
    $back='window.history.back()';
    if(strstr($url,'http')){
        $is_url=$go;
    }else if($url=='back'){
        $is_url=$back;
    }else{
        $is_url=$url;
    }
    echo <<<EOF
    <link rel="Stylesheet" type="text/css" href="./css/DialogBySHF.css" />
 <script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/DialogBySHF.js"></script>
<input type="hidden" value="弹出提示框" id="btnAlert" />
 <script type='text/javascript'>
 
    function test() {
    $is_url
    //$.DialogBySHF.Alert({ Width: 350, Height: 200, Title: '确认后执行方法', Content: '确认后执行的方法' });
}
;(function ($) {
//默认参数
var PARAMS;
var DEFAULTPARAMS = { Title: 'test', Content: '', Width: 400, Height: 300, URL: '', ConfirmFun: new Object, CancelFun: new Object };
var ContentWidth = 0;
var ContentHeight = 0;
$.DialogBySHF = {
//弹出提示框
Alert: function (params) {
Show(params, 'Alert');
},

//关闭弹出框
Close: function () {
$is_url
    $('#DialogBySHFLayer,#DialogBySHF').remove();
}

     };
    //初始化参数
      function Init(params) {
            if (params != undefined && params != null) {
                PARAMS = $.extend({},DEFAULTPARAMS, params);
            }
            ContentWidth = PARAMS.Width - 10;
            ContentHeight = PARAMS.Height - 40;
        };
        //显示弹出框
        function Show(params, caller) {
            Init(params);
            var screenWidth = $(window).width();
            var screenHeight = $(window).height();
            //在屏幕中显示的位置（正中间）
            var positionLeft = (screenWidth - PARAMS.Width) / 2 + $(document).scrollLeft();
            var positionTop = (screenHeight - PARAMS.Height) / 2 + $(document).scrollTop();
            var Content = [];
            Content.push("<div id=\"DialogBySHFLayer\"></div>");
            Content.push("<div id=\"DialogBySHF\" style=\"width:" + PARAMS.Width + "px;height:" + PARAMS.Height + "px;left:" + positionLeft + "px;top:" + positionTop + "px;\">");
            Content.push("    <div id=\"Title\"><span>" + PARAMS.Title + "</span><span id=\"Close\">&#10005;</span></div>");
            Content.push("    <div id=\"Container\" style=\"width:" + ContentWidth + "px;height:" + ContentHeight + "px;\">");
            if (caller == "Dialog") {
                Content.push("<iframe frameborder=\"0\" marginwidth=\"0\" marginheight=\"0\" src=\"" + PARAMS.URL + "\" ></iframe>");
            }
            else {
                var TipLineHeight = ContentHeight - 60;
                Content.push("        <table>");
                Content.push("            <tr><td id=\"TipLine\" style=\"height:" + TipLineHeight + "px;\">" + PARAMS.Content + "</td></tr>");
                Content.push("            <tr>");
                Content.push("                <td id=\"BtnLine\">");
                Content.push("                    <input type=\"button\" id=\"btnDialogBySHFConfirm\" value=\"确定\" />");
                if (caller == "Confirm") {
                    Content.push("                    <input type=\"button\" id=\"btnDialogBySHFCancel\" value=\"取消\" />");
                }
                Content.push("                </td>");
                Content.push("            </tr>");
                Content.push("        </table>");
            }
            Content.push("    </div>");
            Content.push("</div>");
            $("body").append(Content.join(""));
            SetDialogEvent(caller);
        }
        //设置弹窗事件
        function SetDialogEvent(caller) {
            //添加按钮关闭事件
            $("#DialogBySHF #Close").click(function () { $.DialogBySHF.Close();});
             //添加ESC关闭事件
            $(window).keydown(function(event){
                var event = event||window.event;
                if(event.keyCode===27){
                    $.DialogBySHF.Close();
                }
            });
            //添加窗口resize时调整对话框位置
            $(window).resize(function(){
                var screenWidth = $(window).width();
                var screenHeight = $(window).height();
                var positionLeft = parseInt((screenWidth - PARAMS.Width) / 2+ $(document).scrollLeft());
                var positionTop = parseInt((screenHeight - PARAMS.Height) / 2+ $(document).scrollTop());
                $("#DialogBySHF").css({"top":positionTop+"px","left":positionLeft+"px"});
            });
            $("#DialogBySHF #Title").DragBySHF($("#DialogBySHF"));
            if (caller != "Dialog") {
                $("#DialogBySHF #btnDialogBySHFConfirm").click(function () {
                    $.DialogBySHF.Close();
                    if ($.isFunction(PARAMS.ConfirmFun)) {
                        PARAMS.ConfirmFun();
                    }
                })
            }
            if (caller == "Confirm") {
                $("#DialogBySHF #btnDialogBySHFCancel").click(function () {
                    $.DialogBySHF.Close();
                    if ($.isFunction(PARAMS.CancelFun)) {
                        PARAMS.CancelFun();
                    }
                })
            }
        }
    })(jQuery);
    $("#btnAlert").html(function () {
     $.DialogBySHF.Alert({ Width: 350, Height: 200, Title: "$title", Content: "$content", ConfirmFun: test });
 });
  </script>
EOF;
}
