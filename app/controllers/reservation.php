<?php


class Reservation extends Controller{


    public function show($params=[]){

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: *');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        $dbconnection = new DatabaseConnection();


        $reservationRepo = $this->model('ReservationRepo');
        $reservationRepo->dbconnection =  $dbconnection;

        $roomRepo = $this->model('RoomRepo');
        $roomRepo->dbconnection =  $dbconnection;


        $movieRepo = $this->model('MovieRepo');
        $movieRepo->dbconnection =  $dbconnection;



        $myReservation = $reservationRepo->getReservations(18);


        $reservations = [];

        for($i=0;$i<count($myReservation);$i++){

            $reservation = new Reservation();

            $reservation->idReservation = $myReservation[$i]['id'];
            $reservation->movieName =  $movieRepo->getMovieName($myReservation[$i]['movie']);
            $reservation->reservationDate = $myReservation[$i]['reservationDate'];
            $reservation->roomName = $roomRepo->getRoomName($myReservation[$i]['room']);
            $reservation->seatNbr = $myReservation[$i]['seatNbr'];

            $reservations [] = $reservation;

        }

        echo json_encode($reservations);

        exit();

    }

    public function cancel($idRes){

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: *');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');

        $dbconnection = new DatabaseConnection();


        $reservationRepo = $this->model('ReservationRepo');
        $reservationRepo->dbconnection =  $dbconnection;


        $success = $reservationRepo->cancelReservation($idRes);

        if($success){

            $this->show();

        }

    }


}
