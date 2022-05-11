<?php
          $infor=(object)[];
          $data_values=false;      
          $data_values["password"]=$conv_obj->password;
          $pass=$conv_obj->confirmpass;
          $data_values["username"]=$conv_obj->username;   
          if(empty($conv_obj->username)){
               $rror.="please enter a valid username.<br>";
               
          }
          else{
               if(!preg_match("/^[a-z A-Z]*$/" , $conv_obj->username)){
               $rror.="username should have aphabetic letters.<br>";
               
               }
          }


          $data_values["email"]=$conv_obj->email;
          if(empty($conv_obj->email)){
          $rror.= "please enter a valid email address.<br>";

          }
          else{
               if(preg_match("/([\w\-] +\@[\w\-]+ \.[\w\-])/" , $conv_obj->email)){
                    $rror.= "please enter a valid email address.<br>";               

               }
          }


          if($conv_obj->password!=$pass){
                   $rror.= "password missmatch.<br>";
          
          }
          else{
               if(empty($pass) || empty($conv_obj->password)){
                    $rror.="please enter a valid password.<br>";
                    

               }
          }

          $data_values["gender"]=$conv_obj->radio1;
          if(empty($conv_obj->radio1)){
          $rror.="please select your gender.<br>";
               
          }         
          $data_values["userid"]= $_SESSION['user_id'];
          if($rror==""){  
             $query_insert="UPDATE user_chat SET USERNAME=:username,EMAIL=:email,PASSWORD=:password,GENDER=:gender WHERE USERID=:userid";
               $res=$obda->write($query_insert,$data_values);
                    if($res){     
                         $infor->mess="Your Profile page has been updated successfully";
                         $infor->data_type="updatemessag";
                         echo json_encode($infor);
                         
                    }
                         else{
                              
                              $infor->mess="Your Profile page has not been updated due to an error";
                              $infor->data_type="updatemessag"; 
                              echo json_encode($infor);
                         
                         }
               }
          else{
               $infor->mess=$rror;
               $infor->data_type="error";
               echo json_encode($infor);                    
               }


// validate login details
