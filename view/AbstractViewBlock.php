<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 27.09.2020
 * Time: 19:05
 */

namespace view;


/**
 * Class AbstractViewBlock
 * @package view
 */
abstract class AbstractViewBlock
{
    public $data;

    /**
     * AbstractViewBlock constructor.
     * @param $data
     */
    function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @param $name
     * @param $link
     * @return string
     */
    function htmlLiHref($name, $link) {
        return '<li><a href = "/'.$link.'">'.$name.' </a></li>';
    }

    /**
     * @return mixed
     */
    abstract function getHTML();
}