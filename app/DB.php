<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.08.2020
 * Time: 11:36
 */

namespace app;

/**
 * Class DB
 * @package app
 */
class DB
{
    private static $connection = null;

    /**
     * DB constructor.
     */
    function __construct()
    {
        self::connect();
    }

    /**
     * @return \mysqli|null
     */
    static function connect()
    {
        if (self::$connection === null) {
            $params = require __DIR__ . '/../config/db.php';

            $connection = new \mysqli($params['host'], $params['login'], $params['pass'], $params['name'], $params['port']);

            if ($connection->connect_error === null){
                $connection->set_charset("utf8");
                self::$connection = $connection;
            } else {
                die('connection error');
            }
        }

        return self::$connection;
    }

    /**
     * @return \mysqli|null
     */
    static function getConnection() {
        return self::connect();
    }

    /**
     *
     */
    function disconnect() {
        if (self::$connection instanceof \mysqli) {
            self::$connection->close();
        }
    }

    /**
     * @param $sql
     * @return bool|\mysqli_result
     */
    function query($sql) {
        $result = self::connect()->query($sql) or print('sql error');
        return $result;
    }

    /**
     * @param $sql
     * @return bool|mixed
     */
    //строка в ассоциативный массив (число элементов = числу строк)
    function mysql_fetch_array ($sql)
    {
        $query = $this->query($sql);
        $result = $query->fetch_all(MYSQLI_ASSOC);

        if (is_array($result) && count($result)>0)
        {
            return $result;
        }
        else return false;
    }

    /**
     * @param $sql
     * @return bool|mixed
     */
    //ассоциативный массив для одной строки результата
    function mysql_fetch_one ($sql)
    {
        $query = $this->query($sql);
        if ($query) {
            $result = $query->fetch_array(MYSQLI_ASSOC);

            if (is_array($result) && count($result)>0) {
                return $result;
            }
        }

        return false;
    }
}