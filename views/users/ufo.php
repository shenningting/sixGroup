<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>个人资料</title>
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
    <h3>微信开发个人页面</h3>
    <table>
        <tr>
            <td>
                <p><b>昵称:</b><?php echo $list_open['nickname']; ?></p>
                <p><b>性别:</b>
                    <?php
                    if($list_open['sex']==1)
                    {
                        echo "男";
                    }
                    else if($list_open['sex']==2)
                    {
                        echo "女";
                    }
                    else
                    {
                        echo "保密";
                    }
                    ?>
                </p>
                <p><b>所在国家:</b><?php echo $list_open['country']; ?></p>
                <p><b>省:</b><?php echo $list_open['province']; ?></p>
                <p><b>市:</b><?php echo $list_open['city']; ?></p>
                <p><b>头像:</b><img src="<?php echo $list_open['headimgurl']; ?>" width="100px" alt="头像"></p>
            </td>
        </tr>
    </table>
</center>
</body>
</html>