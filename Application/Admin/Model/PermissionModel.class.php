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
        ['name', '', '名称唯一', self::MODEL_INSERT, 'unique'],
    ];

    /**
     * 添加角色
     * @return bool
     */
    public function addPermission()
    {
        unset($this->data['id']);
        $orm = D('Nestedsets','Logic');
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

}