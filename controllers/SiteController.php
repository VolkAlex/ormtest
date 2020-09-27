<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.08.2020
 * Time: 12:21
 */

namespace controllers;

use app\Controller;
use view\Page;
use models\Route;
use view\part\RouteTree;

/**
 * Class SiteController
 * @package controllers
 */
class SiteController extends Controller
{
    public $view = 'main';

    /**
     * @param $key
     * @param bool $unset
     * @return string|null
     */
    static function post($key, $unset = true)
    {
        if (isset($_POST[$key]) && strlen(trim($_POST[$key])) > 0) {
            $val = $_POST[$key];
            if ($unset) unset($_POST[$key]);
            return $val;
        }
        else return null;
    }

    function actionDefault()
    {
        return $this->render('', ['uri' => $this->request_uri]);
    }

    /**
     * @return false|string
     */
    function actionAjax()
    {
        $requestParts = $this->getRequestParts();
        $status = false;
        $html = '';

        // ajax/routes
        if (isset($requestParts[1])) {

            if ($requestParts[1] == 'routes') {
                $roleId = $this->post('roleId');

                $Route = new Route();
                $data = $Route->getRoutesForRoleByRoleId($roleId);
                $roleTreeData = $Route->getRouteTree($data);

                $html = (new RouteTree($roleTreeData))->getHTML();
                $status = true;
            }
        }

        echo json_encode([
            'status' => $status,
            'html' => $html
        ]);

    }

    function actionTest()
    {
        $this->render('test');
    }

    /**
     * @param $content
     * @param array $params
     */
    function render($content, $params = [])
    {
        $page = new Page($content, $params);
        echo $page->render();
    }
}