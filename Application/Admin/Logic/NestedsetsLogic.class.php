<?php
/**
 * Created by PhpStorm.
 * User: zzzzz
 * Date: 2016-08-06
 * Time: 22:22
 */

namespace Admin\Logic;


class NestedsetsLogic implements DbMysql
{
    public function connect()
    {
        // TODO: Implement connect() method.
        echo __METHOD__;
        dump(func_get_args());
        echo '<hr/>';
    }

    public function disconnect()
    {
        // TODO: Implement disconnect() method.
        echo __METHOD__;
        dump(func_get_args());
        echo '<hr/>';
    }

    public function free($result)
    {
        // TODO: Implement free() method.
        echo __METHOD__;
        dump(func_get_args());
        echo '<hr/>';
    }

    /**
     * 执行sql语句
     * @param string $sql
     * @param array $args
     * @return bool
     */
    public function query($sql, array $args = array())
    {
        //>>获取所有的实参
        $args = func_get_args();
        //>>获取sql语句
        $sql = array_shift($args);
        //>>将sql语句分割
        $params = preg_split('/\?[NFT]/', $sql);
        //>>多余的最后一个元素，将其弹出，因为是引用传值，不用赋值
        array_pop($params);
        $sql = '';
        foreach ($params as $key => $value) {
            $sql .= $value . $args[$key];
        }
        //>>执行一个写操作
        $res = M()->execute($sql);
        return $res;
    }

    /**
     * 新增一条记录
     * @param string $sql
     * @param array $args
     * @return integer|bool
     */
    public function insert($sql, array $args = array())
    {
        //>>获取所有的实参
        $args = func_get_args();
        $sql = $args[0];
        $table_name = $args[1];
        $params = $args[2];
        $sql = str_replace('?T', $table_name, $sql);
        $tmp = [];
        foreach ($params as $key => $value) {
            $tmp[] = $key . '="' . $value . '"';
        }
        $sql = str_replace('?%', implode(',', $tmp), $sql);
        if (M()->execute($sql) !== false) {
            return M()->getLastInsID();
        } else {
            return false;
        }
    }

    public function update($sql, array $args = array())
    {
        // TODO: Implement update() method.
        echo __METHOD__;
        dump(func_get_args());
        echo '<hr/>';
    }

    public function getAll($sql, array $args = array())
    {
        // TODO: Implement getAll() method.
        echo __METHOD__;
        dump(func_get_args());
        echo '<hr/>';
    }

    public function getAssoc($sql, array $args = array())
    {
        // TODO: Implement getAssoc() method.
        echo __METHOD__;
        dump(func_get_args());
        echo '<hr/>';
    }

    /**
     * 获取一行记录
     * @param string $sql
     * @param array $args
     * @return array|null
     */
    public function getRow($sql, array $args = array())
    {
        //>>获取所有的实参
        $args = func_get_args();
        //>>获取sql语句
        $sql = array_shift($args);
        //>>将sql语句分割
        $params = preg_split('/\?[NFT]/', $sql);
        //>>多余的最后一个元素，将其弹出，因为是引用传值，不用赋值
        array_pop($params);
        $sql = '';
        foreach ($params as $key => $value) {
            $sql .= $value . $args[$key];
        }
        $rows = M()->query($sql);
        return array_shift($rows);
//        dump($sql);
//        echo __METHOD__;
//        dump(func_get_args());
//        echo '<hr/>';
    }

    public function getCol($sql, array $args = array())
    {
        // TODO: Implement getCol() method.
        echo __METHOD__;
        dump(func_get_args());
        echo '<hr/>';
    }

    /**
     * 获取第一行的第一个字段值
     * @param string $sql
     * @param array $args
     * @return string
     */
    public function getOne($sql, array $args = array())
    {
        //>>获取所有的实参
        $args = func_get_args();
        //>>获取sql语句
        $sql = array_shift($args);
        //>>将sql语句分割
        $params = preg_split('/\?[NFT]/', $sql);
        //>>多余的最后一个元素，将其弹出，因为是引用传值，不用赋值
        array_pop($params);
        $sql = '';
        foreach ($params as $key => $value) {
            $sql .= $value . $args[$key];
        }
        $rows = M()->query($sql);
        //>>获取第一行
        $row = array_shift($rows);
        //>>获取第一个字段值
        return array_shift($row);
    }
}