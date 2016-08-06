<?php
/**
 * Created by PhpStorm.
 * User: zzzzz
 * Date: 2016-08-06
 * Time: 10:29
 */

namespace Admin\Common\Threads;


class MyMailThread extends \Thread
{
    public $title;
    public $content;
    public $address;
    public $host;
    public $name;

    /**
     * MyMailThread constructor.
     * @param $address     地址
     * @param $title       标题
     * @param $content     内容
     * @param string $host 发件人邮箱
     * @param string $name 发件人名
     */
    public function __construct($address, $title, $content, $host = 'zzzzzzz2zzzzzzz@foxmail.com', $name = 'Jan')
    {
        $this->title = $title;
        $this->content = $content;
        $this->address = $address;
        $this->host = $host;
        $this->name = $name;
    }

    public function run()
    {
        return sendMail($this->address, $this->title, $this->content, $this->host, $this->name);
    }
}