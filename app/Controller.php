<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.08.2020
 * Time: 13:23
 */

namespace app;

/**
 * Class Controller
 * @package app
 */
abstract class Controller
{
    public $action;
    protected $request_uri;
    //разбор входящего урла для подбора view

    /**
     * Controller constructor.
     */
    function __construct()
    {
        $this->request_uri = $_SERVER['REQUEST_URI'];
        $this->setAction();
    }

    /**
     *
     */
    private function setAction()
    {
        //если без ЧПУ
        //$this->action = (isset($_GET['a']))? $_GET['a'] : 'Default';

        //если включен ЧПУ (под nginx) try_files $uri $uri/ /index.php?$query_string;
        $requestParts = $this->getRequestParts();

        //направляем все не default и там разбираем uri
        if ($requestParts[0] !== 'ajax'){
            $this->action = 'Default';
        } else {
            //отдельный метод под ajax
            $this->action = 'ajax';
        }
    }

    /**
     * @return array
     */
    function getRequestParts() {
        $array = explode('/', $this->request_uri);
        array_shift($array);
        return $array;
    }

    /**
     * @return mixed
     */
    function getAction()
    {
        $method = 'action'.ucfirst($this->action);

        if (method_exists($this, $method)) {
            return $this->$method();
        }
        else {
            return $this->actionDefault();
        }
    }

    /**
     *
     */
    function goHome()
    {
        header("Location: //".$_SERVER['HTTP_HOST'], true, 301);
    }

    /**
     * @return mixed
     */
    abstract function actionDefault();

}