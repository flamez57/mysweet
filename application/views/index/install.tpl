<!DOCTYPE html>
<html>
<head>
	<title>安装</title>
    <style type="text/css">
        /*分别定义HTML中和标记之的距离样式*/
        html, body, h1, form, fieldset, legend, ol, li {
            margin: 0;
            padding: 0;
        }

        /*定义<body>标记样式*/
        body {
            background: #ffffff;
            color: #111111;
            font-family: Georgia, "Times New Roman", Times, serif;
            padding-left: 20px;
        }

        /*定义付费内容的样式*/
        form#payment {
            background: #9cbc2c;
            -webkit-border-radius: 5px;
            border-radius: 5px;
            padding: 20px;
            width: 400px;
            margin:auto;
        }

        form#payment fieldset {
            border: none;
            margin-bottom: 10px;
        }

        form#payment fieldset:last-of-type { margin-bottom: 0; }

        form#payment legend {
            color: #384313;
            font-size: 16px;
            font-weight: bold;
            padding-bottom: 10px;
            text-shadow: 0 1px 1px #c0d576;
        }

        form#payment > fieldset > legend:before {
            content: "Step " counter(fieldsets) ": ";
            counter-increment: fieldsets;
        }

        form#payment fieldset fieldset legend {
            color: #111111;
            font-size: 13px;
            font-weight: normal;
            padding-bottom: 0;
        }

        form#payment ol li {
            background: #b9cf6a;
            background: rgba(255, 255, 255, .3);
            border-color: #e3ebc3;
            border-color: rgba(255, 255, 255, .6);
            border-style: solid;
            border-width: 2px;
            -webkit-border-radius: 5px;
            line-height: 30px;
            list-style: none;
            padding: 5px 10px;
            margin-bottom: 2px;
        }

        form#payment ol ol li {
            background: none;
            border: none;
            float: left;
        }

        form#payment label {
            float: left;
            font-size: 13px;
            width: 110px;
        }

        form#payment fieldset fieldset label {
            background: none no-repeat left 50%;
            line-height: 20px;
            padding: 0 0 0 30px;
            width: auto;
        }

        form#payment fieldset fieldset label:hover { cursor: pointer; }

        form#payment input:not([type=radio]), form#payment textarea {
            background: #ffffff;
            border: #FC3 solid 1px;
            -webkit-border-radius: 3px;
            font: italic 13px Georgia, "Times New Roman", Times, serif;
            outline: none;
            padding: 5px;
            width: 200px;
        }

        form#payment input:not([type=submit]):focus, form#payment textarea:focus {
            background: #eaeaea;
            border: #F00 solid 1px;
        }

        form#payment input[type=radio] {
            float: left;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div style="margin:50px;">
        <?=\hl\HLView::img('deer.gif', ['width' => '200px']);?>
        <?=\hl\HLView::img('mysweet.png', ['width' => '200px']);?>
    </div>
    <form id="payment" action="<?=\hl\HLRoute::makeUrl('application', 'index', 'installDo')?>" method="POST">
        <fieldset>
            <legend>数据库信息</legend>
            <ol>
                <li>
                    <label for="host">IP：</label>
                    <input id="host" name="host" type="text" placeholder="localhost" required autofocus>
                </li>
                <li>
                    <label for="dbname">库  名：</label>
                    <input id="dbname" name="dbname" type="text" placeholder="default" required>
                </li>
                <li>
                    <label for="username">用户名：</label>
                    <input id="username" name="username" type="text" placeholder="root" required>
                </li>
                <li>
                    <label for="password">密  码：</label>
                    <input id="password" name="password" type="password" placeholder="******" required>
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <legend>后台管理员账号：</legend>
            <ol>
                <li>
                    <label for="adminm">管理员名称：</label>
                    <input id="adminm" name="adminm" type="text" placeholder="admin" required>
                </li>
                <li>
                    <label for="adminp">管理员密码：</label>
                    <input id="adminp" name="adminp" type="password" placeholder="******" required>
                </li>
                <li>
                    <label for="adminpt">管理员密码：</label>
                    <input id="adminpt" name="adminpt" type="password" placeholder="******" required>
                </li>
            </ol>
        </fieldset>
        <fieldset>
            <button type="submit">立即安装</button>
            <button type="submit"><a href="<?=\hl\HLRoute::makeUrl('application', 'index', 'index')?>">返回首页</a></button>
        </fieldset>
    </form>
</body>
</html>
