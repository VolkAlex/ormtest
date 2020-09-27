<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 27.09.2020
 * Time: 13:39
 */

namespace models;


/**
 * Class Route
 * @package models
 */
class Route extends AbstractModel
{
    //полное дерево ссылок
    /**
     * @param null $data
     * @return array
     */
    function getRouteTree($data = null)
    {
        if (is_null($data)) {
            $arrRoutes = $this->getRoutes();
        } else {
            $arrRoutes = $data;
        }

        $arrTreeData = [];

        foreach ($arrRoutes as $row) {
            if ($row['parent_id'] === null) {
                $arrTreeData[$row['name']] = $this->getRouteBranch($row);
            }
        }

        return $arrTreeData;
    }

    //одна ветка ссылки
    //TODO тут нужно делать рекурсию, но пока не знаю придумал как лучше
    /**
     * @param $row
     * @return mixed
     */
    function getRouteBranch($row)
    {
        $branches['children'] = $this->getRouteChildren($row['id']);
        $branches['branch'] = $row;

        return $branches;
    }

    /**
     * @return bool|mixed
     */
    function getRoutes() {
        return $this->db->mysql_fetch_array('Select * from route');
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    function getRouteById($id) {
        return $this->db->mysql_fetch_one('Select * from route where id='.$id);
    }

    /**
     * @param $ids
     * @return bool|mixed
     */
    function getRoutesByIdArray($ids) {
        return $this->db->mysql_fetch_array('Select * from route where id in ('.implode(',', $ids).')');
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    function getRouteChildren($id) {
        return $this->db->mysql_fetch_array('Select * from route where parent_id='.$id);
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    //TODO собрал mysql 5.6, так что пока не могу там собрать рекурсивный запрос, рекурсия внутри метода
    function getRoutesForRoleByRoleId($id, $routesParent = []) {
        $role = $this->db->mysql_fetch_one('Select * from role where id='.$id);

        $routesId = explode(',', $role['routes_id']);

        $routesNew = array_merge($this->getRoutesByIdArray($routesId), $routesParent);

        if ($role['parent_id'] !== null) {
            $routesNew = $this->getRoutesForRoleByRoleId($role['parent_id'], $routesNew);
        }

        return $routesNew;

    }
}