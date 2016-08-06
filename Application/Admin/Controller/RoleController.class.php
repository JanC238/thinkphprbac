<?php
/**
 * Created by PhpStorm.
 * User: zzzzz
 * Date: 2016-08-06
 * Time: 19:05
 */

namespace Admin\Controller;


use Think\Controller;

class RoleController extends Controller
{
    /**
     * @var \Admin\Model\RoleModel
     */
    private $_model;

    protected function _initialize()
    {
        $this->_model = D('Role');
    }
    public function index()
    {
        $datas = $this->_model->select();
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
            $res = $this->_model->addRole();
            if ($res === false) {
                $this->error(getError($this->_model));
            }
            $this->success('添加成功', U('Role/index'));
        } else {
            $this->display('edit');
        }
    }

    /**
     * 删除
     * @param $id
     */
    public function del($id)
    {
        $res = $this->_model->delete($id);
        if ($res === false) {
            $this->ajaxReturn('fail');
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
            $res = $this->_model->save($data);
            if ($res === false) {
                $this->error('修改失败了');
            }
            $this->success('修改成功', U('Role/index'));
        } else {
            $data = $this->_model->find($id);
            $this->assign('data',$data);
            $this->display('edit');
        }
    }
}