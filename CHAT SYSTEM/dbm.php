<?php
class database{
    private $con;
    function __construct(){
         $this->con=$this->connect();
    }
    private function connect(){
        $strin="mysql:host=localhost;dbname=mychat";
        try {
            $con=new PDO($strin,DBUSER,DBPASS);
             return $con;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
         return false;
    }
    public function write($query,$data=[]){
        $con=$this->connect();
        $stateme=$con->prepare($query);
        $check=$stateme->execute($data);
        if($check){
            return true;
        }
           return false;
    }
    public function read($query,$data_arr=[]){
        $con=$this->connect();
        $stateme=$con->prepare($query);
        $resu=$stateme->execute($data_arr);
        if($resu){
           $check=$stateme->fetchAll(PDO::FETCH_OBJ);//returns an array of objects          
           if(is_array($check) && count($check)>0){
               return $check;
           }
           else{
             return false;
           }
        }
             return false;
    }
    public function get_user($user_id){
        $con=$this->connect();
        $ar['user']=$user_id;
        $query="SELECT * FROM user_chat WHERE USERID=:user";
        $stateme=$con->prepare($query);
        $resu=$stateme->execute($ar);
        if($resu){
           $check=$stateme->fetchAll(PDO::FETCH_OBJ);//returns an array of objects          
           if(is_array($check) && count($check)>0){
               return $check[0];
           }
           else{
               return false;
           }
        }
              return false;
    }
    public function generate_userid($max){
        $rand="";
       for ($i=0; $i<$max ; $i++) { 
           $random_num=rand(0,9);
           $rand.=$random_num;
       }
            return $rand;

    }

}