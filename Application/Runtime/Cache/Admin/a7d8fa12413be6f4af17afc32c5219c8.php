<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<script src="/Public/Admin/js/jquery-3.1.0.min.js"></script>
<link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">


<body>
<a href="<?php echo U('Admin/logout');?>" class="btn btn-info pull-right">退出</a>

    <form action="<?php echo U('admin/register');?>" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">name</label>
            <input type="text" class="form-control name" name="name" placeholder="username">
            <span class="warn-span"></span>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                   placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">email</label>
            <input type="text" name="email" class="form-control email" id="exampleInputEmail1" placeholder="email">
            <span class="email-span"></span>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>



    <script>
        var date = new Date();
        console.log(date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate());
        $('span').css('color', 'red');
        /*
         验证用户名
         */
        function checkName(node) {
            var reg = /^[a-zA-Z0-9]+$/;
            var re = new RegExp(reg);
            return re.test(node);
        }
        function checkEmail(node) {
            var reg = /^[\w0-9]+@[a-zA-Z0-9]+(\.[a-zA-Z]+){1,2}$/;
            return reg.test(node);
        }
        /**
         * 实时监听输入框
         */
        $('.name').bind('input propertychange', function () {
            var val = $(this).val();
            if (val == "") {
                $(".warn-span").html("请输入");
                return;
            }
            var res = checkName(val);
            if (res) {
                $(".warn-span").html("");
            } else {
                $(".warn-span").html("数据不合法");
            }
        });

        $('.email').change(function () {
            var val = $(this).val();
            if (val == '') {
                $('.email-span').html("请输入邮箱");
                return;
            }
            var res = checkEmail(val);
            console.log($(this));
            if (res) {
                $('.email-span').html("");
            } else {
                $('.email-span').html("邮箱不合法");
            }
        })
    </script>

</html>