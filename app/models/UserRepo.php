<?php



class UserRepo
{

    public DatabaseConnection $connectiondb;

    public function addUser($ref)
    {

        $statement = $this->connectiondb->getConnection()->prepare(
            "INSERT INTO `user` (`ref`) VALUES (?)"
        );

        $affectedLines = $statement->execute([$ref]);

        return ($affectedLines > 0);

    }



    public function checkUser($ref)
    {

        $statement = $this->connectiondb->getConnection()->prepare(
            "SELECT `id` FROM `user` WHERE `ref` = ?"
        );

        $statement->execute([$ref]);

        $row = $statement->fetch();


        if(!$row){

            return false;

        }else{

            return true;

        }

        
    }


   public function getIdAdmin(string $email):string
   {

    $statement = $this->connectiondb->getConnection()->prepare(
        "SELECT `id` FROM `admin` WHERE `email` = ?"
    );

    $statement->execute([$email]);

    $row = $statement->fetch();

    return $row['id'];
    
   }


}