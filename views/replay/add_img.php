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

    <style>

        tr{

            margin-top:100px;

        }

    </style>

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

<form action="index.php?r=replay/add_img" method="post"  enctype="multipart/form-data"  class="jqtransform">

    <table class="insert-tab" width="70%" height="470">

        <input type="hidden" name="_csrf" value="<?=\Yii::$app->request->csrfToken?>"/>

        <tr>

            <th><i class="require-red">*</i>标题：</th>

            <td>
                <input type="hidden" name="aid" value="<?php echo $aid?>">

                <input class="input-text lh30" id="title" name="retitle" size="50" value="" type="text" placeholder="回复标题">

                <span style="color: red"><?php if(!empty($error_data))echo $error_data['aname'][0]?></span>

                <input type="hidden" name="_csrf" value="<?= yii::$app->request->getCsrfToken()?>">

            </td>

        </tr>

        <tr>

            <th>添加作者</th>

            <td>

                <input class="input-text lh30" name="rename" size="50"  type="text" value="<?php echo  $re;?>">

                <span style="color: red"><?php if(!empty($error_data))echo $error_data['appid'][0]?></span>

            </td>

        </tr>

        <tr>

            <th><i class="require-red">*</i>关键字：</th>

            <td>

                <input class="input-text lh30" id="title" name="rekeyword" size="50" value="" type="text" placeholder="回复标题">

                <span style="color: red"><?php if(!empty($error_data))echo $error_data['aname'][0]?></span>

            </td>

        </tr>

        <tr>

            <th>图片</th>

        <tr>

            <td class="td_right">图片：</td>

            <td class=""><input type="file" name="grurl" class="input-text lh30" size="10"></td>

        </tr>

        </tr>

        <tr>

            <th>描述：</th>

            <td>

                <textarea name="grdesc" class="common-textarea" id="content" cols="30" style="width: 98%;" rows="10"></textarea>

                <span style="color: red"><?php if(!empty($error_data))echo $error_data['account'][0]?></span>

            </td>

        </tr>

        <tr>

            <th></th>

            <td>

                <input type="submit"  class="btn btn82 btn_save2" value="提交">

                <input type="button" value="返回" onclick="location.href='javascript:history.go(-1)'"

                       class="ext_btn">

            </td>

        </tr>

    </table>

</form>

</body>

</html>