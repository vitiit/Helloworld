<?php
/**
 * Created by PhpStorm.
 * User: hieuapp
 * Date: 05/05/2016
 * Time: 15:50
 */
require_once ("../models/ListProductModel.php");
include_once "../serverconfig.php";
class RestAPI{
    private $ACTION_LOAD_MORE = 1;
    private $model;
    public function __construct()
    {
        if(isset($_GET["action"])){
            $action = $_GET["action"];
            $this->handleAction($action);
        }
    }

    public function handleAction($action = -1){
        $start = $_GET["start"];
        $size = $_GET["size"];
        $type = $_GET["type"];
        $this->model = new ListProductModel();
        switch($action){
            case $this->ACTION_LOAD_MORE:
                $res =  $this->model->loadMoreItem($type,$start,$size);
                header('Content-type: application/json');
                echo $res;
                break;
        }

    }
}

$rest = new RestAPI();