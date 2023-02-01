<?php


spl_autoload_register(function($class){

    require_once('../app/lib/'.$class.'.php');

});

class Movie extends Controller{


    

    public function all($params=[]){


        $movieRepo = $this->model('MovieRepo');

        $dbconnection = new DatabaseConnection();

        $movieRepo->dbconnection =  $dbconnection;

        $movies  = $movieRepo->getMovies();

        echo json_encode($movies);

        exit();


    }


}