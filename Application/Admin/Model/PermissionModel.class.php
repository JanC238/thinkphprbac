<?php
/**
 * Created by PhpStorm.
 * User: zzzzz
 * Date: 2016-08-06
 * Time: 21:24
 */

namespace Admin\Model;


use Admin\Logic\NestedSets;
use Think\Model;

class PermissionModel extends Model
{
    protected $patchValidate;
    protected $_validate = [
        ['name', 'require', '名称必填'],
//        ['name', '', '名称唯一', self::MODEL_INSERT, 'unique'],
    ];

    /**
     * 添加角色
     * @return bool
     */
    public function addPermission()
    {
        unset($this->data['id']);
        $orm = D('Nestedsets', 'Logic');
//>>创建nestedsets对象
        $nestedsets = new NestedSets($orm, $this->trueTableName, 'lft', 'rght', 'parent_id', 'id', 'lvl');
        $res = $nestedsets->insert($this->data['parent_id'], $this->data, 'bottom');
        if (!$res) {
            $this->error = '添加出错';
            return false;
        }
//        if ($this->add($this->data) === false) {
//            $this->error = '添加错误';
//            return false;
//        }
    }

    public function updatePermission()
    {
        $this->startTrans();
        //>>判断是否修改了父级分类，如果没修改就不创建nestedsets
        //>>获取原来的父级分类,要使用getFieldById因为find会将数据放到data属性中
        $parent_id = $this->getFieldById($this->data['id'], 'parent_id');
        if ($this->data['parent_id'] !== $parent_id) {
            //>>获取当前的父级分类
            $orm = D('Nestedsets', 'Logic');
//>>创建nestedsets对象
            $nestedsets = new NestedSets($orm, $this->trueTableName, 'lft', 'rght', 'parent_id', 'id', 'lvl');
            //>>moveUnder只计算左右节点和层级，不保存其他数据
            if ($nestedsets->moveUnder($this->data['id'], $this->data['parent_id'], 'bottom') === false) {
                $this->error = '不能将分类移动带后代分类下面';
                $this->rollback();
                return false;
            };
        }

        if ($this->save() === false) {
            $this->rollback();
            return false;
        };
        $this->commit();
    }

    /**
     * 删除权限
     * @param $id
     * @return bool
     */
    public function deletePermission($id)
    {
        $orm = D('Nestedsets', 'Logic');
        //>>创建nestedsets对象
        $nestedsets = new NestedSets($orm, $this->trueTableName, 'lft', 'rght', 'parent_id', 'id', 'lvl');
        if ($nestedsets->delete($id) == false) {
            $this->error = $this->getError();
            return false;
        }
    }

}