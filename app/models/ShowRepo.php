<?php



class ShowRepo
{

    public DatabaseConnection $dbconnection;


    public function getfilteredShows($idMovie){

        $statement = $this->dbconnection->getConnection()->prepare(
            "SELECT `id`,`idRoom`,`showDate` FROM `session` WHERE `idMovie`=? AND `showDate`>=NOW() ORDER BY showDate"
        );

        $statement->execute([$idMovie]);

        $row = $statement->fetchAll();

        return $row;

    }



}