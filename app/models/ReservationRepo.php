<?php



class ReservationRepo
{

    public DatabaseConnection $dbconnection;


    public function getReservedSeats($idRoom,$showDate):array
    {

        $statement = $this->dbconnection->getConnection()->prepare(
            "SELECT `seatNbr` FROM `reservation` WHERE `room`=? AND `reservationDate`=?"
        );

        $statement->execute([$idRoom,$showDate]);

        $row = $statement->fetchAll();

        $reservedSeats = [];

        for($i=0;$i<count($row);$i++){

            $reservedSeats [] = $row[$i]['seatNbr'];

        
        }

        return $reservedSeats;

    }


    public function reserve($input)
    {
        
        for($i=0;$i<count(['seatsNbrs']);$i++){

            $statement = $this->dbconnection->getConnection()->prepare(
                "INSERT INTO `reservation`(`client`, `room`, `movie`, `reservationDate`, `seatNbr`) VALUES (?,?,?,?,?)"
            );
    
            $statement->execute([$input['idClient'],$input['idRoom'],$input['idMovie'],$input['reservationDate'],$input['seatsNbrs'][$i]]);


        }

    }


    public function getReservations($idClient){

        $statement = $this->dbconnection->getConnection()->prepare(
            "SELECT `id`,`client`, `room`, `movie`, `reservationDate`, `seatNbr` FROM `reservation` WHERE client=? ORDER BY `reservationDate`"
        );

        $statement->execute([$idClient]);

        $row = $statement->fetchAll();

        return $row;

    }



}