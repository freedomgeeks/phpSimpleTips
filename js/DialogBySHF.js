//拖动层
(function ($) {
    $.fn.extend({
        DragBySHF: function (objMoved) {
            return this.each(function () {
                //鼠标按下时的位置
                var mouseDownPosiX;
                var mouseDownPosiY;
                //移动的对象的初始位置
                var objPosiX;
                var objPosiY;
                //移动的对象
                var obj = $(objMoved) == undefined ? $(this) : $(objMoved);
                //是否处于移动状态
                var status = false;

                //鼠标移动时计算移动的位置
                var tempX;
                var tempY;

                $(this).mousedown(function (e) {
                    status = true;
                    mouseDownPosiX = e.pageX;
                    mouseDownPosiY = e.pageY;
                    objPosiX = obj.css("left").replace("px", "");
                    objPosiY = obj.css("top").replace("px", "");
                }).mouseup(function () {
                    status = false;
                });
                $("body").mousemove(function (e) {
                    if (status) {
                        tempX = parseInt(e.pageX) - parseInt(mouseDownPosiX) + parseInt(objPosiX);
                        tempY = parseInt(e.pageY) - parseInt(mouseDownPosiY) + parseInt(objPosiY);
                        obj.css({ "left": tempX + "px", "top": tempY + "px" });
                    }
                    //判断是否超出窗体
                    //计算出弹出层距离右边的位置
                    var dialogRight = parseInt($(window).width())-(parseInt(obj.css("left"))+parseInt(obj.width()));
                    //计算出弹出层距离底边的位置
                    var dialogBottom = parseInt($(window).height())-(parseInt(obj.css("top"))+parseInt(obj.height()));
                    var maxLeft = $(window).width()-obj.width();
                    var maxTop = $(window).height()-obj.height();
                    if(parseInt(obj.css("left"))<=0){
                          obj.css("left","0px");
                    }
                    if(parseInt(obj.css("top"))<=0){
                        obj.css("top","0px");
                    }
                    if(dialogRight<=0){
                        obj.css("left",maxLeft+'px');
                    }
                }).mouseup(function () {
                    status = false;
                }).mouseleave(function () {
                    status = false;
                });
            });
        }
    })
})(jQuery);
