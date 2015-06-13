<?php
//A class to connect to database dynamically
//Joseph Malaba
// 1st October 2014

class DynamicConnection {
    //properties
    private $dsn ;
    private $user;
    private $password;
    private $pdo;
    private $result;
    
    
    public function DynamicConnection($host,$usr,$pwd,$db){
         $dsn = "mysql:dbname=$db;host=".$host;
         $user = $usr;
         $password = $pwd;
    
    
        try{
            $this->pdo = new PDO($dsn,$user,$password);
        }catch(PDOException $e){
           echo  "Connection Failed : ". $e->getMessage();
        }
    }
    
    public function execute_query($qr){
        $this->result = $this->pdo->query($qr);
    }
    
    public function get_result(){
        return $this->result;
    }
}

?>
