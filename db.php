<?php 

class Database{
    private $host = "" ;
    private $user = "" ;
    private $pass = "" ;
    private $database = "" ;
    private $db ;

    public function __construct($host, $user, $pass, $database){
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->database = $database;
        $this->connect();
    }

    public function connect(){
        try{
            $dsn = "mysql:host={$this->host};dbname={$this->database}";
            $this->db = new PDO($dsn, $this->user, $this->pass);
        }catch(PDOException $e){
            echo "error connecting to server: ". $e->getMessage();
        }
    }

    public function savedata($username, $age, $gender, $email, $program){
        try{
            $query = $this->db->prepare('INSERT INTO `student`( `username`, `age`, `gender`, `email`, `program`) value(?, ?, ?, ?, ?)');
            // $query->bindParam(1, $username);
            // $query->bindParam(2, $age);
            // $query->bindParam(3, $gender);
            // $query->bindParam(4, $email);
            // $query->bindParam(5, $program);

            $query->execute([$username,$age,$gender,$email,$program]);
            return true;
            
        }catch(PDOException $e){
            echo "". $e->getMessage();
        }
    }

    public function getStudentData(){
        try{
            $query = $this->db->query("SELECT * FROM `student`");
            return $query-> fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "fetch failed".$e->getMessage();
        }
    }

     public function getStudentIdData($id){
        try{
            $query = $this->db->prepare("SELECT * FROM `student` where id = {$id}");
            return $query-> fetchAll(PDO::FETCH_ASSOC);
        }catch(PDOException $e){
            echo "fetch failed".$e->getMessage();
        }
    }




}