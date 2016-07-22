<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/common.css">
    <link rel="stylesheet" href="css/main.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/colResizable-1.3.min.js"></script>
    <script type="text/javascript" src="js/common.js"></script>

    <script type="text/javascript">
        $(function () {
            $(".list_table").colResizable({
                liveDrag: true,
                gripInnerHtml: "<div class='grip'></div>",
                draggingClass: "dragging",
                minWidth: 30
            });
        });
    </script>
</head>
<body>
<center>
    <div class="box_top"><b class="pl15">用户信息列表</b></div>
    <div id="table" class="mt10" style="margin-top: 30px">
        <div class="box span10 oh">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list_table">
                <tr>
                    <th width="200">昵称</th>
                    <th width="200">性别</th>
                    <th width="200">语言</th>
                    <th width="200">城市</th>
                    <th width="200">省份</th>
                    <th width="200">国家</th>
                    <th width="200">头像</th>
                    <th width="200">添加时间</th>
                    <th width="200">备注</th>
                    <th width="200">组别</th>
                </tr>
                <?php foreach($arr_open as $k=>$v){?>
                    <tr class="tr">
                        <td align="center"><?php echo $v['nickname']?></td>
                        <td align="center">
                            <?php
                            if($v['sex']==1)
                            {
                                echo "男";
                            }
                            else if($v['sex']==2)
                            {
                                echo "女";
                            }
                            else if($v['sex']==0)
                            {
                                echo "保密";
                            }
                            ?>
                        </td>
                        <td align="center"><?php echo $v['language']?></td>
                        <td align="center"><?php echo $v['city']?></td>
                        <td align="center"><?php echo $v['province']?></td>
                        <td align="center"><?php echo $v['country']?></td>
                        <td align="center">
                            <img src="<?php echo $v['headimgurl']?>" alt="头像" width="100px">
                        </td>
                        <td align="center"><?php echo date('Y-m-d H:i:s',$v['subscribe_time'])?></td>
                        <td align="center">
                            <?php
                            if(empty($v['remark']))
                            {
                                echo "未备注";
                            }
                            else
                            {
                                echo $v['remark'];
                            }
                            ?>
                        </td>
                        <td align="center">
                            <?php
                            if(empty($v['groupid']))
                            {
                                echo "未分组";
                            }
                            else
                            {
                                echo $v['groupid'];
                            }
                            ?>
                        </td>
                    </tr>
                <?php }?>
            </table>
        </div>
    </div>
</center>
</body>
</html>
<script src="js/jq.js"></script>
<script>
</script>