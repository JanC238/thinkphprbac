<?php
/**
 * Created by PhpStorm.
 * User: zzzzz
 * Date: 2016-08-06
 * Time: 21:23
 */

namespace Admin\Controller;


use Think\Controller;

class PermissionController extends Controller
{
    /**
     * @var \Admin\Model\PermissionModel
     */
    private $_model;

    protected function _initialize()
    {
        $this->_model = D('Permission');
    }

    /**
     * 显示权限
     */
    public function index()
    {
        $datas = $this->_model->order('lft asc')->select();
        $this->assign('datas', $datas);
        $this->display('index');
    }

    /**
     * 添加角色
     */
    public function add()
    {
        if (IS_POST) {
            $data = $this->_model->create();
            if ($data === false) {
                $this->error(getError($this->_model));
            }
            $res = $this->_model->addPermission();
            if ($res === false) {
                $this->error(getError($this->_model));
            }
            $this->success('添加成功', U('Permission/index'));
        } else {
            $datas = $this->_model->select();
            array_unshift($datas, ['id' => 0, 'name' => '顶级分类', 'parent_id' => 0]);
            $this->assign('datas', json_encode($datas));
            $this->display('edit');
        }
    }

    /**
     * 删除
     * @param $id
     */
    public function del($id)
    {
        $res = $this->_model->deletePermission($id);
        var_dump($res);
        exit;
        if ($res == false) {
            $this->ajaxReturn('fail');
            exit;
        }
        $this->ajaxReturn('success');
    }

    /**
     * 修改
     * @param $id
     */
    public function edit($id)
    {
        if (IS_POST) {
            $data = $this->_model->create();
            $res = $this->_model->updatePermission($data);
            if ($res === false) {
                $this->error('修改失败了');
            }
            $this->success('修改成功', U('Permission/index'));
        } else {
            $cond = array(
                'id' => ['neq', $id],
                'parent_id' => ['neq', $id],
                '_logic' => 'and'
            );
            $datas = $this->_model->order('lft asc')->where($cond)->select();
            $data = $this->_model->find($id);
            $this->assign('data', $data);
            array_unshift($datas, ['id' => 0, 'name' => '顶级分类', 'parent_id' => 0]);
            $this->assign('datas', json_encode($datas));
            $this->display('edit');
        }
    }
}