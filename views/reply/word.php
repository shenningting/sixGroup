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
<div class="box_top"><b class="pl15">文字回复</b></div>
<div class="box_center">
<h2 style="float: left"><a href="">回复规则管理</a></h2>
    <form action="index.php?r=reply/addword" method="post" class="jqtransform">
        <table class="form_table pt15 pb15" width="100%" border="0" cellpadding="0" cellspacing="0"  style="height: 400px">
            <tr>
                <input type="hidden" name="_csrf" value="<?=\Yii::$app->request->csrfToken?>"/>
                <td class="td_right">回复规则名称：</td>
                <td class="">
                    <input type="text" name="rename" class="input-text lh30" size="40" placeholder="一定要填写啊  方便以后管理">
                </td>
            </tr>
            <tr>
                <td class="td_right">公众号选项：</td>
                <td class="">

                    <span class="fl">
                      <div class="select_border">
                          <div class="select_containers ">
                              <select name="aid" class="select">
                                  <?php foreach($account_data as  $v){?>
                                  <option value="<?php echo $v['aid']?>"><?php echo $v['aname']?></option>
                                  <?php }?>
                              </select>
                          </div>
                      </div>
                    </span>
                </td>
            </tr>
            <tr>
                <td class="td_right">触发关键字：</td>
                <td class="">
                    <input type="text" name="rekeyword" class="input-text lh30" size="40" placeholder="多个关键字用‘，’分隔">
                </td>
            </tr>
            <tr>
                <td class="td_right">回复内容：</td>
                <td class="">
                    <textarea name="trcontent[]" id="" cols="30" rows="10" class="textarea"></textarea>
                </td>
            </tr>
            <tr>
                <td><input type="button" name="button" class="btn btn82 btn_add" value="追加回复" id="addContent" size="50px"></td>
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
    $("#addContent").click(function(){
        var str = "<tr>";
            str+= "<td class='td_right'>回复内容：</td>";
            str+= "<td class=''>";
            str+= "<textarea name='trcontent[]' id='' cols='30' rows='10' class='textarea'></textarea>";
            str+= "</td>";
            str+= "</tr>";
        var obj = $(this).parents("tr").prev().after(str);
        //alert(obj);
    });
</script>