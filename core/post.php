<?php

class Post{
    private $conn;
    private $table = 'alcohol';

    public $Country;
    public $Alcohol;

    public function __construct($db){
        $this->conn = $db;
    }
     public function read(){
        $query = 'SELECT
            a.Country,
            a.Alcohol
            FROM
            ' .$this->table . ' a ORDER BY a.Alcohol DESC';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;

     } 
     
     public function read_single(){
        $query = 'SELECT
            a.Country,
            a.Alcohol
            FROM
            ' .$this->table . ' a
            WHERE a.Country = ? LIMIT 1';
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->Country);
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $this->Country = $row['Country'];
        $this->Alcohol = $row['Alcohol'];
    }
    
    public function create(){
        $query = 'INSERT INTO ' . $this->table . ' SET Country = :Country, Alcohol = :Alcohol';
        $stmt = $this->conn->prepare($query);
        $this->Country = htmlspecialchars(strip_tags($this->Country));
        $this->Alcohol = htmlspecialchars(strip_tags($this->Alcohol));
       $stmt->bindParam('Country', $this->Country);
       $stmt->bindParam('Alcohol', $this->Alcohol);
       if($stmt->execute()){
        return true;
       }
       printf("Error %s. \n", $stmt->error);
       return false;
    }
    public function update(){
        $query = 'UPDATE ' . $this->table . ' SET Country = :Country, Alcohol = :Alcohol
        WHERE Country = :Country';
        $stmt = $this->conn->prepare($query);
        $this->Country = htmlspecialchars(strip_tags($this->Country));
        $this->Alcohol = htmlspecialchars(strip_tags($this->Alcohol));
       
       $stmt->bindParam('Alcohol', $this->Alcohol);
       $stmt->bindParam('Country', $this->Country);

       if($stmt->execute()){
        return true;
       }

       printf("Error %s. \n", $stmt->error);
       return false;
    }
    public function delete(){
        $query = 'DELETE FROM ' . $this->table . ' WHERE Country = :Country';
        $stmt = $this->conn->prepare($query);
        $this->Country = htmlspecialchars(strip_tags($this->Country));
        $stmt->bindParam(':Country', $this->Country);
       if($stmt->execute()){
        return true;
       }
       printf("Error %s. \n", $stmt->error);
       return false;
    }
}