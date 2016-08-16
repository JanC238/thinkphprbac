<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<script src="/Public/Admin/js/jquery-3.1.0.min.js"></script>
<link rel="stylesheet" href="/Public/Admin/css/bootstrap.min.css">

    <link rel="stylesheet" href="/Public/ext/ztree/css/zTreeStyle/zTreeStyle.css">


<body>
<a href="<?php echo U('Admin/logout');?>" class="btn btn-info pull-right">退出</a>

    <form action="#" method="post">
        <div class="form-group">
            <label>name</label>
            <input type="text" class="form-control" name="name" value="<?php echo ($data["name"]); ?>" placeholder="name">
        </div>
        <div class="form-group">
            <input type="hidden" name="parent_id" id="parent_id">
            <label for="parent_name">请选择父级分类</label>
            <input type="text" disabled="disabled" id="parent_name" class="form-control" value="请选择">
            <ul id="permission" class="ztree"></ul>
        </div>
        <div class="form-group">
            <label>url</label>
            <input type="text" class="form-control" name="permission_url" value="<?php echo ($data["url"]); ?>" placeholder="url">
        </div>
        <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
        <button type="submit" class="btn btn-default">Submit</button>
    </form>



    <script src="/Public/ext/ztree/js/jquery-1.4.4.min.js"></script>
    <script src="/Public/ext/ztree/js/jquery.ztree.core.js"></script>
    <script>
        //>>初始化ztree插件
        var setting = {
            data: {
                simpleData: {
                    enable: true,
                    pIdKey: 'parent_id',
                }
            },
            callback: {
                onClick: function (event, tree_id, tree_node) {
                    $('#parent_name').val(tree_node.name);
                    $('#parent_id').val(tree_node.id);
                }
            }

        };
        var datas = <?php echo ($datas); ?>;
        $(document).ready(function () {
            var datasZtree = $.fn.zTree.init($("#permission"), setting, datas);
//>>展开所有节点
            datasZtree.expandAll(true);
            <?php if(isset($data)): ?>//>>获取父级分类
            var parentNode = datasZtree.getNodeByParam('id',<?php echo ($data["parent_id"]); ?>);
            datasZtree.selectNode(parentNode);
            $('#parent_name').val(parentNode.name);<?php endif; ?>
        });

    </script>

</html>