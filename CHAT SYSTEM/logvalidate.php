<?php   
    $infor=(object)[];
    $data_values=false;
    $data_values["username"]=$conv_obj->username;       
    if(empty($conv_obj->username)){
          $rror.= "please enter a valid username.<br>";          
          }
    else{
         if(!preg_match("/^[a-z A-Z]*$/" , $conv_obj->username)){
          $rror.= "username should have aphabetic letters.<br>";          
         }
    }
    if(empty($conv_obj->password)){
               $rror.= "please enter a valid password.<br>";          
    
          }
    if($rror==""){
         $query_insert="SELECT * FROM user_chat WHERE USERNAME=:username";
         $res=$obda->read($query_insert,$data_values);
              if(is_array($res)){     
               $res=$res[0];
                 if($res->PASSWORD==$conv_obj->password){                      
                         $_SESSION['user_id']=$res->USERID;
                         $infor->data_type="info";
                         echo json_encode($infor); 

                    }
                    else{
                         $infor->mess="Wrong Password";
                         $infor->data_type="error"; 
                         echo json_encode($infor);   
                    }
                   
              }
                   else{
                        
                        $infor->mess="Wrong Username";
                        $infor->data_type="error"; 
                        echo json_encode($infor);
                   
                   }
            }
    else{
         $infor->mess=$rror;
         $infor->data_type="error";
         echo json_encode($infor);
              
         }
    