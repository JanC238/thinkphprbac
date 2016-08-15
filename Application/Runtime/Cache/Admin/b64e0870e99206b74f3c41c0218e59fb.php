<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<script src="/Public/Admin/js/jquery-3.1.0.min.js"></script>
<link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">


<body>
<a href="<?php echo U('Admin/logout');?>" class="btn btn-info pull-right">退出</a>

    <form action="<?php echo U('admin/edit');?>" method="post">
        <div class="form-group">
            <label>name</label>
            <input type="text" class="form-control" name="name" value="<?php echo ($data["name"]); ?>"  placeholder="username">
        </div>

        <div class="form-group">
            <label>email</label>
            <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
            <input type="text" name="email" class="form-control" value="<?php echo ($data["email"]); ?>" id="exampleInputEmail1" placeholder="email">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>



</html>