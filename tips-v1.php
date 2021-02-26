<?php
 
/**
 * @param string $content 提示内容
 * @param boolbean $status
 * @param number $width div容器宽度
 */
function tips($content,$status=true,$width='100'){
    $status=$status?'right_ico.png':'error_ico.png';
    echo <<<EOF
    <script>content='$content';status='$status';width='$width';</script>
EOF;
     //更简单的可以把目标html代码直接附在EOF内输出
     echo  file_get_contents('tips-theme1.html');
  
}
  
/**
 * @param string $title 弹窗消息标题
 * @param string $content 弹窗消息内容
 */
function dialogAutoHide($title,$content){
  
    echo"<script>title='$title';content='$content';</script>";
  
    echo  file_get_contents('tips-theme2.html');
}

 
/**
 * @param string $title 弹窗消息标题
 * @param string $content 弹窗消息内容
 * @param string $action 关闭弹窗后执行的操作，1:跳转，需要传url；2返回，空或其他为无操作
 */

function dialog($title,$content,$action='',$url=''){
     

    echo"<script>title='$title';content='$content';action='$action';url='$url';</script>";
    
    echo  file_get_contents('tips-theme3.html');
}