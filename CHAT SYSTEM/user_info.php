<?php  
  
    $data_values=false;
    $data_values["user_id"]=$_SESSION['user_id'];   
         $query_insert="SELECT * FROM user_chat WHERE USERID=:user_id LIMIT 1";
         $res=$obda->read($query_insert,$data_values);
              if(is_array($res)){     
                   $res=$res[0];
                   $image=($res->GENDER=='Male')? 'man.png':'female.png';
                    if(file_exists($res->IMAGE)){
                          $image=$res->IMAGE;
                    }
                   $res->img=$image;
                   $res->data_type="user_info";
                   echo json_encode($res);               
                 }
                  
            
    
    