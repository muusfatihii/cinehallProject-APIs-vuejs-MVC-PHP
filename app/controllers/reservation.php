<?php


class Reservation extends Controller{


    public function show($params=[]){

        $dbconnection = new DatabaseConnection();

        $reservationRepo = $this->model('ReservationRepo');
        $reservationRepo->dbconnection =  $dbconnection;

        $roomRepo = $this->model('RoomRepo');
        $roomRepo->dbconnection =  $dbconnection;


        $movieRepo = $this->model('MovieRepo');
        $movieRepo->dbconnection =  $dbconnection;


        $myReservation = $reservationRepo->getReservations();


        

        for($i=0;$i<count($myReservation);$i++){

            $reservation = new Reservation();

            $reservation->idReservation = $myReservation[$i]['id'];
            $reservation->movieName = $myReservation[$i]['movie'];
            $reservation->reservationDate = $myReservation[$i]['reservationDate'];
            $reservation->roomName = $myReservation[$i]['room'];
            $reservation->seatNbr = $myReservation[$i]['seatNbr'];



        }



    }


}
