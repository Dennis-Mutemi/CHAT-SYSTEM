<?php

$current_user_id['userid']=null;
if(isset($conv_obj->resul->id)){
    $current_user_id['userid']=$conv_obj->resul->id;
}

$refresh=false;
$seen=false;
if($conv_obj->data_type=="chats_refresh"){
    $refresh=true;
    $seen=$conv_obj->resul->seen;
}
$query_insert="SELECT * FROM user_chat  WHERE  USERID=:userid LIMIT 1";
$user_acc['username']=$_SESSION['user_id'];
$query_in="SELECT * FROM user_chat  WHERE  USERID=:username LIMIT 1";
$res=$obda->read($query_insert,$current_user_id);
if(is_array($res)){
                    $res=$res[0];    
                        $image=($res->GENDER=="Male")? "man.png":"female.png";
                        if(file_exists($res->IMAGE)){
                            $image=$res->IMAGE;
                        };       
                    $res->IMAGE=$image;
                    $mydata="";  $message_box_left="";
                    if(!$refresh){ $mydata.="
                    <div class='defal' style='margin:5px;background:white;color black;border:solid thick purple;'>Now chatting with:<br>
                        <img src='$image' alt=''><br>$res->USERNAME
                            </div>"; }      
                    if(!$refresh){    $message_box_left.="
                    <style>
                    .mesage_left{
                        min-width:70px;
                        min-height:20%;
                        border-top-left-radius:30%;         
                        border-bottom-right-radius:20%;
                        border:solid thin blue;
                        background:purple;
                        margin:10px;
                        float:left;
                        overflow:auto;

                    }
                    .mesage_left img{
                        width:50px;
                        height:40px;
                        border-radius:70%;
                        float:left;
                        padding-top:1em;
                        
                    }      
                    .mesage_right{
                        min-width:70px;
                        min-height:20%;
                        border-top-right-radius:30%;          
                        border-bottom-left-radius:20%;
                        border:solid thin blue;
                        background:#ca9637;;
                        margin:10px;
                        float:right;
                            }
                    .mesage_right img{
                        width:50px;
                        height:40px;
                        border-radius:70%;
                        float:right;
                        padding-top:1em;
                        
                    }
                    .in_chat input[type=text]{
                        width:80%;
                        margin-left:1em;
                        border:none;
                        background:#4c4146;;
                        }
                    .in_chat input[type=submit]{
                            width:15%;
                            margin-left:0.5em;
                            background:#c57f65;;
                            border:none;
                            cursor:pointer;
                    }
                    </style>
                    ";
                }                   
                if(!$refresh){ $message_box_left.="<div class='message_containter' id='scroled'  onclick='set_seenstatus(event)' style='display:flex;flex-direction:column;overflow-y:scroll; height:90%'>"; }    
                $arr_id['sender']= $_SESSION['user_id'];
                $arr_id['receiver']= $conv_obj->resul->id;            
                $query_check="SELECT * FROM messages  WHERE  (RECEIVER=:receiver && SENDER =:sender)||(RECEIVER=:sender && SENDER =:receiver)";
                $meas=$obda->read($query_check,$arr_id);
                if(is_array($meas)){
                    foreach ($meas as $value) {
                    $myuser=$obda->get_user($value->SENDER);
                    if($value->RECEIVER==$_SESSION['user_id'] && $seen && $value->RECEIVED==1){
                        $obda->write("UPDATE messages SET SEEN='1' WHERE ID='$value->ID'");
                    }
                    if($value->RECEIVER==$_SESSION['user_id']){
                        $obda->write("UPDATE messages SET RECEIVED='1' WHERE ID='$value->ID'");
                    }
                    
                    if($value->SENDER==$_SESSION['user_id']){            
                        $message_box_left.=message_right($value,$myuser);
                       }
                    else{
                         $message_box_left.=message_left($value,$myuser);
                       }
                    }
                } 
                if(!$refresh){  $message_box_left.="</div>";}                            
               if(!$refresh){
               $message_box_left.="
                <input type='file' style='display:none' id='lf'>
                <div  class='in_chat'style='background:#bbb;height:10%; display:flex;'>
                    <label for='lf' for='lf' style='margin:0.1em 0.1em;font-size:1.5em;cursor:pointer;'>🎗</label>
                    <input type='text' placeholder='Type your message here' id='massage_id' onkeyup='send_onenter(event)'>
                    <input type='submit'value='Send' onclick='send_massege(event)'>
                </div>     
                "; }    
                $info->massage=$mydata;
                $info->message_box_design=$message_box_left;
                $info->data_type="chats";
                if($refresh){     
                $info->data_type="chats_refresh";
                }
                echo json_encode($info);
}

    else 
    {          
            $current_user_id['userid']=$_SESSION['user_id'];
            $query_check="SELECT * FROM messages  WHERE  (RECEIVER=:userid || SENDER =:userid) GROUP BY MASSAGEID";
            $meas=$obda->read($query_check,$current_user_id);
            $mydata="Previous Chats:<br>";
            if(is_array($meas)){
                foreach ($meas as $value) {                   
                $other_user=$value->RECEIVER;
                IF($value->SENDER==$_SESSION['user_id']){
                    $other_user=$value->RECEIVER;
                }  
                $myuse=$obda->get_user($other_user);                        
                $image=($myuse->GENDER=="Male")?"man.png":"female.png";
                if(file_exists($myuse->IMAGE)){
                    $image=$myuse->IMAGE;
                };
                $mydata.="
                <div id='scroled'>
                    <div class='defal'  style='margin:5px; background:white; color:black; border:solid thick purple; cursor:pointer;' userid='$myuse->USERID' onclick='load_chatpage(event)'>
                        <img src='$image' alt=''><br>$myuse->USERNAME
                    </div> 
                </div>";                            
                
            
            }
                $info->massage=$mydata;
                $info->message_box_design="";
                $info->data_type="chats";              
                echo json_encode($info);
                };

                  }