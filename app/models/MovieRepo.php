<?php



class MovieRepo
{

    public DatabaseConnection $dbconnection;


    public function getMovies():array
    {

        $statement = $this->dbconnection->getConnection()->prepare(
            "SELECT `id`,`name` FROM `movie`"
        );

        $statement->execute();

        $row = $statement->fetchAll();

        return $row;

    }



}