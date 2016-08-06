<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<script src="/Public/Admin/js/jquery-3.1.0.min.js"></script>
<link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">


<body>


    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>status</th>
            <th>lastLoginIp</th>
            <th>操作</th>
        </tr>
        <?php if(is_array($admins)): $i = 0; $__LIST__ = $admins;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$admin): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($admin["id"]); ?></td>
                <td><?php echo ($admin["name"]); ?></td>
                <td><?php echo ($admin["email"]); ?></td>
                <td><?php echo ($admin["status"]); ?></td>
                <td><?php echo ($admin["last_login_ip"]); ?></td>
                <td>
                    <a href="<?php echo U('Admin/edit',['id'=>$admin['id']]);?>" class="btn btn-info">修改</a>
                    <a href="javascript:;" class="btn btn-danger del" admin_id="<?php echo ($admin["id"]); ?>">删除</a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    </table>



    <script>
        $('.del').click(function () {
            var obj = $(this);
            var id = obj.attr('admin_id');
            var url = "<?php echo U('Admin/del');?>";
            $.post(url,{id:id},function (response) {
                if(response == 'success'){
                    obj.parent().parent().fadeOut();
                }
            },'json')
        });
    </script>

</html>