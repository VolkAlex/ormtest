<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 27.09.2020
 * Time: 19:05
 */

namespace view\part;

use view\AbstractViewBlock;


/**
 * Class RoleTree
 * @package view\part
 */
class RoleTree extends AbstractViewBlock
{
    /**
     * @return string
     */
    function getHTML()
    {
        $html = '';
        $data = $this->data;

        if (is_array($data)) {
            $html  = '<label for="role"><select id="role" name="roleId">';
            foreach ($data as $row) {
                $html .= '<option value='.$row['id'].'>'.$row['name'].'</option>';
            }

            $html  .= '</select></label>';
        }
        return $html;
    }
}