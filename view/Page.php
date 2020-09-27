<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.08.2020
 * Time: 12:05
 */

namespace view;


use controllers\SiteController;
use models\Role;
use view\part\RoleTree;
use view\part\RouteTree;
use models\Route;

/**
 * Class Page
 * @package view
 */
class Page
{
    public $content, $params;

    /**
     * Page constructor.
     * @param $content
     * @param array $params
     */
    function __construct($content, $params = [])
    {
        $this->content = $content;
        $this->params = $params;
    }

    /**
     * @return string
     */
    function render()
    {
        //дерево ссылок на каждой странице
        $data = (new Route())->getRouteTree();
        $routeTree = new RouteTree($data);

        //селекты на каждой странице
        $data = (new Role())->getRoles();
        $roleTree = new RoleTree($data);

        $currentRoute = (isset($this->params['uri'])) ? $this->params['uri'] : '/';

        return <<<HTML
<html>
    <title>crm test</title>
    <head>
        <link rel="stylesheet" href="/web/css/bootstrap-reboot.css">
        <link rel="stylesheet" href="/web/css/bootstrap.css">
        <link rel="stylesheet" href="/web/css/bootstrap-grid.css">
    </head>
    <body>
    
        <div class="container">
            <p>Current route: {$currentRoute}</p>
            <div id="routeTree">
                {$routeTree->getHTML()}
            </div>
            <form id="roleForm" method="POST" action="#">
                {$roleTree->getHTML()}
            </form>
        </div>

        <script src="/web/js/jquery.js"></script>
        <script src="/web/js/bootstrap.js"></script>
        <script src="/web/js/bootstrap.bundle.js"></script>
        <script src="/web/js/scripts.js"></script>
        
    </body>
</html>
HTML;

    }
}