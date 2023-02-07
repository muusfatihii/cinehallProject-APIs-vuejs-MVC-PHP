<?php

class Show extends Controller
{

    public function display($params=[]){

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: *');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');
        

        $idMovie = $_POST['idMovie'];


        // $idMovie = 1;




        $showRepo = $this->model('ShowRepo');

        $dbconnection = new DatabaseConnection();

        $showRepo->dbconnection =  $dbconnection;


        $shows  = $showRepo->getfilteredShows($idMovie);



        $reservationRepo = $this->model('ReservationRepo');

        $dbconnection = new DatabaseConnection();

        $reservationRepo->dbconnection =  $dbconnection;


        $roomRepo = $this->model('RoomRepo');

        $dbconnection = new DatabaseConnection();

        $roomRepo->dbconnection =  $dbconnection;



        $showsDet = [];

        
        for($i=0;$i<count($shows);$i++){

            $reservedSeats  = $reservationRepo->getReservedSeats($shows[$i]['idRoom'],$shows[$i]['showDate']);
            $showdet = new Show();
            $showdet->id = $shows[$i]['id'];
            $showdet->showDate = $shows[$i]['showDate'];
            $showdet->idRoom = $shows[$i]['idRoom'];
            $showdet->nameRoom = $roomRepo->getRoomName($shows[$i]['idRoom']);
            $showdet->reservedSeats = $reservedSeats;

            $showsDet [] = $showdet;
    

        }

        echo json_encode($showsDet);

        exit();

        
    }


    public function reserve(){

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Method: POST');
        header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorisation');
        
        $input = [];
        $idClient = $_POST['idClient'];
        $input['idClient'] = $idClient;
        $idMovie = $_POST['idMovie'];
        $input['idMovie'] = $idMovie;
        $idRoom = $_POST['idRoom'];
        $input['idRoom'] = $idRoom;
        $reservationDate = $_POST['reservationDate'];
        $input['reservationDate'] = $reservationDate;
        $seatsNbrs = $_POST['seatsNbrs'];
        $input['seatsNbrs'] = $seatsNbrs;


        $reservationRepo = $this->model('ReservationRepo');

        $dbconnection = new DatabaseConnection();

        $reservationRepo->dbconnection =  $dbconnection;

        $reservationRepo->reserve($input);

        echo "OK";
        exit();


    }
    
}