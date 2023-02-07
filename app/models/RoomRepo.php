<?php



class RoomRepo
{

    public DatabaseConnection $dbconnection;


    public function getRoomName($idRoom){

        $statement = $this->dbconnection->getConnection()->prepare(
            "SELECT `name` FROM `room` WHERE `id`=? "
        );

        $statement->execute([$idRoom]);

        $row = $statement->fetch();

        return $row['name'];

    }



}