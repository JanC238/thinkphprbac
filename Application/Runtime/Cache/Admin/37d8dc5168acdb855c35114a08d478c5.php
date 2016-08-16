<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<script src="/Public/Admin/js/jquery-3.1.0.min.js"></script>
<link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">

    <link href="/Public/ext/treegrid/css/jquery.treegrid.css" rel="stylesheet" type="text/css" />


<body>

    <a href="<?php echo U('add');?>" class="btn btn-info pull-right">添加</a>
    <div class="col-lg-4"></div>
    <div class="col-lg-4">
        <table class="table table-bordered tree">
            <tr>
                <th>id</th>
                <th>name</th>
                <th>url</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($datas)): $i = 0; $__LIST__ = $datas;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><tr class="treegrid-<?php echo ($data["id"]); ?> <?php if(($data["parent_id"]) != "0"): ?>treegrid-parent-<?php echo ($data["parent_id"]); endif; ?>">
                    <td><?php echo ($data["id"]); ?></td>
                    <td><?php echo ($data["name"]); ?></td>
                    <td><?php echo ($data["permission_url"]); ?></td>
                    <td>
                        <a href="<?php echo U('Permission/edit',['id'=>$data['id']]);?>" class="btn btn-info">修改</a>
                        <a href="javascript:;" class="btn btn-danger del" role_id="<?php echo ($data["id"]); ?>">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
    </div>




    <script src="/Public/ext/treegrid/js/jquery.treegrid.js"></script>

    <script>
        $(function () {
            $('.tree').treegrid();
            $('.del').click(function () {
                var obj = $(this);
                var id = obj.attr('role_id');
                var url = "<?php echo U('Permission/del');?>";
                $.post(url, {id: id}, function (response) {
                    if (response == 'success') {
                        obj.parent().parent().fadeOut();
                    }
                }, 'json')
            });
        });
    </script>

</html>