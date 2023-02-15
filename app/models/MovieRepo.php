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


    public function getMovieName($idMovie)
    {

        $statement = $this->dbconnection->getConnection()->prepare(
            "SELECT `name` as nameMovie FROM `movie` WHERE `id`=?"
        );

        $statement->execute([$idMovie]);

        $row = $statement->fetch();

        return $row['nameMovie'];

    }



}