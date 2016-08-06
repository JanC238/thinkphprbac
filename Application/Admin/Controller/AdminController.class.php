<?php
/**
 * Created by PhpStorm.
 * User: zzzzz
 * Date: 2016-08-03
 * Time: 21:13
 */

namespace Admin\Controller;


use Admin\Common\Threads\MyMailThread;
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


    public function index()
    {
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
            $data = $this->_model->create();
            if ($data === false) {
                $this->error(getError($this->_model));
            }
            $res = $this->_model->login();
            if ($res === false) {
                $this->error(getError($this->_model));
            }
            echo '登录成功';
        }
        $this->display('login');
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

//    public function pushAd()
//    {
//
//        $thread = new MyMailThread();
//    }
}