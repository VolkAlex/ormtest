<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 27.09.2020
 * Time: 18:59
 */

namespace models;


use app\DB;

/**
 * Class AbstractModel
 * @package models
 */
class AbstractModel
{
    protected $db, $connection;

    /**
     * AbstractModel constructor.
     */
    function __construct()
    {
        $this->db = new DB();
        $this->connection = DB::getConnection();
    }
}