<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 27.09.2020
 * Time: 14:45
 */

namespace view\part;

use view\AbstractViewBlock;


/**
 * Class RouteTree
 * @package view\part
 */
class RouteTree extends AbstractViewBlock
{
    /**
     * @return string
     */
    function getHTML()
    {
        $html = '';
        $data = $this->data;
        if (is_array($data)) {

            $html  = '<ul>';
            foreach ($data as $name => $branch) {

                if ($branch['children']) {
                    $html .= '<li>';
                    $html .= '<a href="#">'.$branch['branch']['name'].'</a>';
                    $html .= '<ul>';
                    foreach ($branch['children'] as $row) {
                        $link = $row['uri'];
                        $name = $row['name'];
                        $html .= $this->htmlLiHref($name, $branch['branch']['uri'].'/'.$link);
                    }
                    $html .= '</li>';
                    $html .= '</ul>';
                } else {
                    $link = $branch['branch']['uri'];
                    $name = $branch['branch']['name'];
                    $html .= $this->htmlLiHref($name, $link);
                }
            }

            $html  .= '</ul>';
        }
        return $html;
    }

}