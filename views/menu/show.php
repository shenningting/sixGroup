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
                    <th width="100">公众号<?php echo $data['account'][0]['aid']?></th>
                    <th width="100">主菜单</th>
                    <th width="100">子菜单</th>
                </tr>
                <?php foreach($data['account_data'] as $acc_val){?>
                    <tr class="tr">
                        <td class="td_center"><?php echo $acc_val['aname']?></td>

                            <td>
                                <?php foreach($data['data1'] as $v){?>
                            <?php if($acc_val['aid']==$v['aid']){?>
                                <?php echo $v['main']?>
                            <?php }?>
                                <?php }?>
                            </td>

                        <td>
                            <?php foreach($data['data1'] as $v){?>
                                <?php if($acc_val['aid']==$v['aid']){?>
                                     <?php foreach($v['brother'] as $val){?>
                                        <?php echo $val['mname']?>
                                     <?php }?>
                                <?php }?>
                            <?php }?>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="javascript:void(0)" onclick="fun(this)" ids="<?php echo $acc_val['aid']?>">生成菜单</a></td>
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
          console.log(e);
        });
    }
</script>