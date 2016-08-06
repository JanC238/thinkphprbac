<?php
/**
 * Created by PhpStorm.
 * User: zzzzz
 * Date: 2016-08-06
 * Time: 19:09
 */

namespace Admin\Model;


use Think\Model;

class RoleModel extends Model
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
    public function addRole()
    {
        unset($this->data['id']);
        if ($this->add($this->data) === false) {
            $this->error = '添加错误';
            return false;
        }
    }

}