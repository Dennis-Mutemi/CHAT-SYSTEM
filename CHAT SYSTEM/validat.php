<?php
          $infor=(object)[];
          $data_values=false;
          $use_id=$obda->generate_userid(10);
          $data_values["userid"]=$use_id;
          $data_values["time"]=date("Y-m-d H:i:s");    
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

          if($rror==""){   
               $query_insert="INSERT INTO user_chat(USERNAME,EMAIL,TIME,PASSWORD,GENDER,USERID)VALUES(:username,:email,:time,:password,:gender,:userid)";
               $res=$obda->write($query_insert,$data_values);
                    if($res){     
                         $infor->mess="account created successifully";
                         $infor->data_type="info";
                         echo json_encode($infor);
                         
                    }
                         else{
                              
                              $infor->mess="Account NOT created successifully kindly try again";
                              $infor->data_type="error"; 
                              echo json_encode($infor);
                         
                         }
               }
          else{
               $infor->mess=$rror;
               $infor->data_type="error";
               echo json_encode($infor);                    
               }


// validate login details
