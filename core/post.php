<?php

class Post{
    //db stuff
    private $conn;
    private $table = 'alcohol';

    //post properties
    public $Country;
    public $Alcohol;

    //constructor with db connection
    public function __construct($db){
        $this->conn = $db;
    }
     //getting posts from our database 
     public function read(){
        //create query
        $query = 'SELECT
            a.Country,
            a.Alcohol
            FROM
            ' .$this->table . ' a';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //execute query
        $stmt->execute();

        return $stmt;

     } 
     
     public function read_single(){
        $query = 'SELECT
            a.Country,
            a.Alcohol,
            FROM
            ' .$this->table . ' a
            LEFT JOIN 
                 WHERE a.Country = ? LIMIT 1';

        //prepare statement
        $stmt = $this->conn->prepare($query);
        //binding param
        $stmt->bindParam(1, $this->Country);
        //execute the query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->Country = $row['Country'];
        $this->Alcohol = $row['Alcohol'];
           
     }
    public function create(){
        //create query
        $query = 'INSERT INTO ' . $this->table . ' SET Country = :Country, Alcohol = :Alcohol';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->Country = htmlspecialchars(strip_tags($this->Country));
        $this->Alcohol = htmlspecialchars(strip_tags($this->Alcohol));
       //binding of parameters
       $stmt->bindParam('Country', $this->Country);
       $stmt->bindParam('Alcohol', $this->Alcohol);
       //execute the query
       if($stmt->execute()){
        return true;
       }

       //print error if something goes wrong
       printf("Error %s. \n", $stmt->error);
       return false;
    }
      //update post function
    public function update(){
        //create query
        $query = 'UPDATE ' . $this->table . ' SET Country = :Country, Alcohol = :Alcohol
        WHERE Country = :Country';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->Country = htmlspecialchars(strip_tags($this->Country));
        $this->Alcohol = htmlspecialchars(strip_tags($this->Alcohol));
       //binding of parameters
       $stmt->bindParam('Alcohol', $this->Alcohol);
       $stmt->bindParam('Country', $this->Country);
       //execute the query
       if($stmt->execute()){
        return true;
       }

       //print error if something goes wrong
       printf("Error %s. \n", $stmt->error);
       return false;
    }
    //delete function
    public function delete(){
        //create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE Country = :Country';
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //clean the data
        $this->Country = htmlspecialchars(strip_tags($this->Country));
        //binding the id parameter
        $stmt->bindParam(':Country', $this->Country);
         //execute the query
       if($stmt->execute()){
        return true;
       }

       //print error if something goes wrong
       printf("Error %s. \n", $stmt->error);
       return false;
    }
}