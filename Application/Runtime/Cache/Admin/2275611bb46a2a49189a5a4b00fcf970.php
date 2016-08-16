<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<script src="/Public/Admin/js/jquery-3.1.0.min.js"></script>
<link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">


<body>

    <br>
    <br>
    <br>
    <br>
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <a class="btn btn-info pull-right" href="<?php echo U('register');?>">注册</a>
        <form action="<?php echo U('login');?>" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">name</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                       placeholder="Password">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>



</html>