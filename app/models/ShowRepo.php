<?php



class ShowRepo
{

    public DatabaseConnection $dbconnection;


    public function getfilteredShows($idMovie){

        $statement = $this->dbconnection->getConnection()->prepare(
            "SELECT `room`,`dateShow` FROM `show` WHERE `movie`=? AND `dateShow`>=NOW()"
        );

        $statement->execute([$idMovie]);

        $row = $statement->fetchAll();

        return $row;

    }



}