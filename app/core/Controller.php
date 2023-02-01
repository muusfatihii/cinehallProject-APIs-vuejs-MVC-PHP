<?php


spl_autoload_register(function($class){

    require_once('../app/lib/'.$class.'.php');

});

class Controller{

    public function model($model){

        require_once '../app/models/'.$model.'.php';

        return new $model;

    }

    public function view($view,$data=[]){


        require_once '../app/views/'.$view.'.php';

    }

}