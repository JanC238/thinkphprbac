<?php
/**
 * Created by PhpStorm.
 * User: zzzzz
 * Date: 2016-08-03
 * Time: 21:19
 */

namespace Admin\Model;


use Admin\Common\Threads\MyMailThread;
use Think\Model;

class AdminModel extends Model
{
    protected $patchValidate = true;
    protected $_validate = array(
        ['name', 'require', '用户名必填'],
        ['name', '', '用户名已存在', self::EXISTS_VALIDATE, 'unique', 'register'],
        ['password', 'require', '密码必填'],
        ['email', 'require', '邮箱必填'],
        ['email', 'email', '邮箱错误'],
    );

    protected $_auto = array(
        ['last_login_ip', 'get_client_ip', self::MODEL_UPDATE, 'function',],
        ['salt', '\Org\Util\String::RandString', 'register', 'function'],
        ['status', 0, 'register']
    );

    /**
     * 注册
     * @return bool
     */
    public function reg()
    {
        $data = $this->data;
        $this->data['password'] = saltEncrypt($this->data['salt'], $this->data['password']);
        //>>生成一个token存入数据库，验证状态
        $token = \Org\Util\String::randString(32);
        $this->data['token'] = $token;
        if ($this->add($this->data) === false) {
            $this->error = '注册失败';
            return false;
        };
        $title = '验证并激活您的账号';
        $content = "点击<a href='" . U('Admin/activate', ['token' => $token], true, true) . "'>链接</a>激活您的账号或复制以下链接到浏览器" . U('Admin/activate', ['token' => $token], true, true);
        $address = $data['email'];
//        sendMail($address, $title, $content);
        $obj = new MyMailThread($address, $title, $content);
        $obj->start();
    }

    /**
     * 登录验证
     * @return bool
     */
    public function login()
    {
        $data = $this->data;
        $name = $data['name'];
        $res = $this->where(['name' => $name])->find();
        if (!$res) {
            $this->error = '用户名不存在';
            return false;
        }
        $password = saltEncrypt($res['salt'], $data['password']);
        if ($password != $res['password']) {
            $this->error = '密码错误';
            return false;
        }
        //>>登录成功时将最后登录ip录入
        $ip = get_client_ip();
        $this->where(['id' => $res['id']])->save(['last_login_ip' => $ip]);

        session('USER_INFO', $res);
    }

    /**
     * 邮箱验证
     * @param $token 令牌
     * @return bool
     */
    public function activate($token)
    {
        $userInfo = $this->where(['token' => $token])->find();
        if ($userInfo['status'] == 1) {
            $this->error = '邮箱已激活';
            $this->where(['id' => $userInfo['id']])->setField(['token' => '']);
            return false;
        }
        if ($userInfo) {
            if (!$this->where(['id' => $userInfo['id']])->setField(['status' => 1])) {
                $this->error = '激活失败,请重试';
                return false;
            };
        } else {
            $this->error = '令牌错误';
            return false;
        }
    }
}