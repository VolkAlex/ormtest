<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 27.09.2020
 * Time: 18:58
 */

namespace models;

/**
 * Class Role
 * @package models
 */
class Role extends AbstractModel
{
    /**
     * @return bool|mixed
     */
    function getRoles() {
        return $this->db->mysql_fetch_array('Select * from role');
    }
}