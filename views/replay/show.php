<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

<link rel="stylesheet" href="css/common.css">
<link rel="stylesheet" href="css/main.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/colResizable-1.3.min.js"></script>
<script type="text/javascript" src="js/common.js"></script>

<script type="text/javascript">
    $(function(){
        $(".list_table").colResizable({
            liveDrag:true,
            gripInnerHtml:"<div class='grip'></div>",
            draggingClass:"dragging",
            minWidth:30
        });
    });
</script>


<center>
    <div id="table" class="mt10">
        <div class="box span10 oh">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list_table">
                <tr>
                    <th width="200">公众号<?php echo $data['account'][0]['aid']?></th>
                    <th width="200">标题</th>
                    <th width="200">关键字</th>
                    <th width="200">图片</th>
                    <th width="200">描述</th>
                    <th width="200">管理</th>
                </tr>
                <?php foreach($data as $v){?>
                    <tr class="tr">
                        <td class="td_center"><?php echo $v['aname']?></td>
                         <td class="td_center"><?php echo $v['retitle']?></td>
                         <td class="td_center"><?php echo $v['rekeyword']?></td>
                         <td class="td_center"><img src="<?php echo $v['grurl']?>" alt="" width="50px" height="50px"/></td>
                         <td class="td_center"><?php echo $v['grdesc']?></td>
                        <td>
                            <a href="index.php?r=replay/del&gid=<?php echo $v['gid']?>">删除</a>
                        </td>
                    </tr>
                <?php }?>
            </table>
            <div class="page mt10">
                <div class="pagination">
                    <ul>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</center>

<script src="js/jq.js"></script>
<script>
    function fun(obj){
        var aid = $(obj).attr('ids');
        $.get('index.php?r=menu/sheng',{aid:aid},function(e){
          if(e=='1'){
              alert('ok');
          }else{
              alert('有点问题')
          }
        });
    }
</script>