<?php


spl_autoload_register(function($class){

    require_once('../app/lib/'.$class.'.php');

});

class Movie extends Controller{


    

    public function all($params=[]){

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: *');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');
        



        $movieRepo = $this->model('MovieRepo');

        $dbconnection = new DatabaseConnection();

        $movieRepo->dbconnection =  $dbconnection;

        $results  = $movieRepo->getMovies();
        
        $movies = [];

        for($i=0;$i<count($results);$i++){

            $movie = new Movie();
            $movie->id = 'M'.$results[$i]['id'];
            $movie->name = $results[$i]['name'];

            $movies [] = $movie;
        }

        echo json_encode($movies);

        exit();


    }


}