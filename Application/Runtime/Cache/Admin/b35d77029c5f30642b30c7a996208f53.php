<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<script src="/Public/Admin/js/jquery-3.1.0.min.js"></script>
<link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">


<body>

    <a href="<?php echo U('Admin/logout');?>" class="btn btn-info pull-right">退出</a>
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
        <table class="table table-bordered">
            <tr>
                <th>id</th>
                <th>name</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($datas)): $i = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr>
                    <td><?php echo ($data["id"]); ?></td>
                    <td><?php echo ($data["name"]); ?></td>
                    <td>
                        <a href="<?php echo U('Role/edit',['id'=>$data['id']]);?>" class="btn btn-info">修改</a>
                        <a href="javascript:;" class="btn btn-danger del" permission_id="<?php echo ($data["id"]); ?>">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </div>



    <script>
        $('.del').click(function () {
            var obj = $(this);
            var id = obj.attr('permission_id');
            var url = "<?php echo U('Permission/del');?>";
            $.post(url, {id: id}, function (response) {
                if (response == 'success') {
                    obj.parent().parent().fadeOut();
                }
            }, 'json')
        });
    </script>

</html>