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
    <div class="box_top"><b class="pl15">菜单设置</b></div>
    <div class="box_center">
        <form action="index.php?r=menu/menu" method="post" class="jqtransform">
            <table class="form_table pt15 pb15" width="100%" border="0" cellpadding="0" cellspacing="0"  style="height: 400px">
                <tr>
                    <input type="hidden" name="_csrf" value="<?=\Yii::$app->request->csrfToken?>"/>
                    <td class="td_right">菜单名称：</td>
                    <td class="">
                        <input type="text" name="mname" class="input-text lh30" size="40" placeholder="一定要填写啊  方便以后管理">
                    </td>
                </tr>

                <tr>
                    <td class="td_right">公众号选项：</td>
                    <td class="">
                    <span class="fl">
                      <div class="select_border">
                          <div class="select_containers ">
                              <select name="aid" class="select"  onchange="g_change()">
                                  <option value="">请选择</option>
                                  <?php foreach($account_data as  $v){?>
                                      <option value="<?php echo $v['aid']?>"><?php echo $v['aname']?></option>
                                  <?php }?>
                              </select>
                          </div>
                      </div>
                    </span>
                    </td>
                </tr>
                <tbody id="add">

                </tbody>
                <tr>
                    <td class="td_right">地址名称：</td>
                    <td class="">
                        <input type="text" name="url" class="input-text lh30" size="40" placeholder="一定要填写啊  方便以后管理">
                    </td>
                </tr>
                <tr>
                    <td class="td_right">&nbsp;</td>
                    <td class="">
                        <input type="submit" class="btn btn82 btn_save2" value="保存">
                        <input type="reset" class="btn btn82 btn_res" value="重置">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    </div>
</center>
</body>
</html>
<script src="js/jq.js"></script>
<script>
    function g_change()
    {
        var aid = $("[name='aid']").val();
        $.get('index.php?r=menu/g_change',{aid:aid},function(e){
            var str = "";
           str+= "<tr>";
            str+= "<td class='td_right'>老父亲：</td>";
            str+= "<td class=''>"
            str+= '<span class="fl">';
            str+= '<div class="select_border">';
            str+= '<div class="select_containers ">';
            str+= '<select name="mgrade" class="select">';
            for(i in e) {
                str += '<option value="'+e[i]['mid']+'">'+e[i]['mname']+'</option>';
            }
            str+= '</select>';
            str+= '</div>';
            str+= '</div>';
            str+= '</span>';
            str+= '</td>';
            str+= '</tr>';
            $("#add").html(str);
        },'json');

    }
</script>