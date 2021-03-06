<?php
/**
 * Created by PhpStorm.
 * User: zzzzz
 * Date: 2016-08-03
 * Time: 21:13
 */

namespace Admin\Controller;


use Think\Controller;

class AdminController extends Controller
{
    /**
     * @var \Admin\Model\AdminModel
     */
    private $_model;

    protected function _initialize()
    {
        $this->_model = D('Admin');
    }

    /**
     * 会员列表
     */
    public function index()
    {
        echo session('USER_INFO')['name'];
        $admins = $this->_model->select();
        $this->assign('admins', $admins);
        $this->display('index');
    }

    /**
     * 注册
     */
    public function register()
    {
        if (IS_POST) {
            $data = $this->_model->create('', 'register');
            if ($data === false) {
                $this->error(getError($this->_model));
            }
            $res = $this->_model->reg();
            if ($res === false) {
                $this->error(getError($this->_model));
            }
            $this->success('注册成功,请注意查收激活邮件', U('login'));
        } else {
            $this->display('register');
        }
    }

    /**
     * 登录界面
     */
    public function login()
    {
        if (IS_POST) {
            $data = $this->_model->create('','login');
            if ($data === false) {
                $this->error(getError($this->_model));
            }
            $res = $this->_model->login();
            if ($res === false) {
                $this->error(getError($this->_model));
            }
            $this->success('登录成功', U('Admin/index'));
        } else {
            $this->display('login');
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
     * 验证令牌，激活账号
     * @param $token 令牌
     */
    public function activate($token)
    {
        $res = $this->_model->activate($token);
        if ($res === false) {
            $this->error(getError($this->_model), U('Admin/login'));
        }
        $this->success('激活成功', U('Admin/login'));
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
            $this->success('修改成功', U('Admin/index'));
        } else {
            $data = $this->_model->find($id);
            $this->assign('data',$data);
            $this->display('edit');
        }
    }

    /**
     * 退出
     */
    public function logout()
    {
        session('USER_INFO',null);
        $this->success('已退出', U('Admin/login'));
    }

//    public function pushAd()
//    {
//
//        $thread = new MyMailThread();
//    }
}