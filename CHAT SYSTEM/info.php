<?php
session_start();
require_once("autoload.php");
$obda=new database();
$data=file_get_contents("php://input");
$conv_obj=JSON_decode($data);
$info=(object)[];
if(!isset($_SESSION['user_id'])){
    if($conv_obj->data_type=="user_infor"){
          $info->logged_in=false;    
          echo json_encode($info);
          die;
       }
       
}
$rror="";
if(isset($conv_obj->data_type) && $conv_obj->data_type=="user_infor"){    
         include_once("user_info.php");
     }

if(isset($conv_obj->data_type) && $conv_obj->data_type=="sign_in"){
         include_once("logvalidate.php");
     }

if(isset($conv_obj->data_type) && $conv_obj->data_type=="sign"){
        include_once("validat.php");
        }
if(isset($conv_obj->data_type) && $conv_obj->data_type=="log_out"){    
        include_once("logout.php");
      }
if(isset($conv_obj->data_type) && $conv_obj->data_type=="con_tacts"){    
        include_once("contacts.php");
      }
     
if(isset($conv_obj->data_type) && $conv_obj->data_type=="sett_ings"){    
        include_once("setting.php");
      }

if(isset($conv_obj->data_type) && $conv_obj->data_type=="update"){    
        include_once("updateuserinfo.php");
      }
function message_left($data,$res){
        $image=($res->GENDER=="Male")? "man.png":"female.png";
        if(file_exists($res->IMAGE)){
            $image=$res->IMAGE;
                };  
        return "
                <div class='mesage_left'>
                        
                        <img src='$image' alt=''>$res->USERNAME<br>
                        <span style='color:yellow;text-align: center;'>$data->MESSAGE</span><br>
                        <span style='color:#999; backround:silver; text-align: left;'>".date("jS M Y H.i.s a",strtotime($data->DATE))."</span>        
        </div>
      ";
}
function message_right($data,$res){
        $image=($res->GENDER=="Male")? "man.png":"female.png";
        if(file_exists($res->IMAGE)){
            $image=$res->IMAGE;
        }; 
$result='';   
   if($data->SEEN) { 
  $result.= "
        <div class='mesage_right'>
        <div ><img src='check.png' style='width:14px;height:20px;'></div>                       
        <img src='$image' alt=''>$res->USERNAME<br>
        <span style='color:#100f0d;text-align: center;'>$data->MESSAGE</span><br>
        <span style='color:#00fff3; backround:silver; text-align: left;'>".date("jS M Y H.i.s a",strtotime($data->DATE))."</span>
           </div>
               "; 
        }  
     elseif($data->RECEIVED){
        $result.="
             <div class='mesage_right'>
             <div style=''><img src='tick.png' style='width:14px;height:20px; color:black;'></div>                       
             <img src='$image' alt=''>$res->USERNAME<br>
             <span style='color:#100f0d;text-align: center;'>$data->MESSAGE</span><br>
             <span style='color:#00fff3; backround:silver; text-align: left;'>".date("jS M Y H.i.s a",strtotime($data->DATE))."</span>
                </div>
                    "; 
            }  
     else{
         $result.="
            <div class='mesage_right'>                                  
             <img src='$image' alt=''>$res->USERNAME<br>
             <span style='color:#100f0d;text-align: center;'>$data->MESSAGE</span><br>
             <span style='color:#00fff3; backround:silver; text-align: left;'>".date("jS M Y H.i.s a",strtotime($data->DATE))."</span>
                </div>
                    "; 

     }
      return $result;
}
if(isset($conv_obj->data_type) && $conv_obj->data_type=="chats"){    
        include_once("chats.php");
      }
if(isset($conv_obj->data_type) && ($conv_obj->data_type=="chats" || $conv_obj->data_type=="chats_refresh")){    
        include_once("chats.php");
      }
if(isset($conv_obj->data_type) && $conv_obj->data_type=="sendreceive"){  
        include_once("sendreceive.php");
      }

function message_send_onenter(){
        return "</div>
                <input type='file' style='display:none' id='lf'>
                <div  class='in_chat'style='background:#bbb;height:10%; display:flex;'>
                    <label for='lf' for='lf' style='margin:0.1em 0.1em;font-size:1.5em;cursor:pointer;'>🎗</label>
                    <input type='text' placeholder='Type your message here' id='massage_id' onkeyup='send_onenter(event)'>
                    <input type='submit'value='Send' onclick='send_massege(event)'>
                </div>     
                ";
        }