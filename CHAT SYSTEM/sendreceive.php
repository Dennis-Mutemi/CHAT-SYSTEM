<?php

if(!isset($conv_obj->resul->id)){
    $info->massage="Kindly click on contacts to select a contact to chat with";
    $info->data_type="chats";
    echo json_encode($info);
    die;
         }   

    $current_user_id['userid']=$conv_obj->resul->id;
    $query_insert="SELECT * FROM user_chat  WHERE  USERID=:userid LIMIT 1";
    $user_acc['username']=$_SESSION['user_id'];
    $query_in="SELECT * FROM user_chat  WHERE  USERID=:username LIMIT 1";
    $res=$obda->read($query_insert,$current_user_id);
if(is_array($res)){
    $arr1['receiver_id']=$conv_obj->resul->id;
    $arr1['date']=date("Y-m-d H-i-s");
    $arr1['sender_id']=$_SESSION['user_id'];
    $arr1['massage_id']=mess_id(60);
    $arr1['massage']=$conv_obj->resul->message;   
    $arr2['receiver_id']=$conv_obj->resul->id;
    $arr2['sender_id']=$_SESSION['user_id'];
    $query_check="SELECT * FROM messages  WHERE  (RECEIVER=:receiver_id && SENDER =:sender_id)||(RECEIVER=:sender_id&& SENDER =:receiver_id )";
    $check_me=$obda->read($query_check,$arr2);
    if(is_array($check_me)){
        $check_me=$check_me[0];
        $arr1['massage_id']=$check_me->MASSAGEID;        
    }
    $query_insert_me="INSERT INTO messages (MASSAGEID,SENDER,RECEIVER,MESSAGE,DATE)  VALUES(:massage_id,:sender_id,:receiver_id,:massage,:date)";
    $send_mess=$obda->write($query_insert_me,$arr1);
                    $res=$res[0];  
                        $image=($res->GENDER=="Male")? "man.png":"female.png";
                        if(file_exists($res->IMAGE)){
                            $image=$res->IMAGE;
                        };       
                    $res->IMAGE=$image;
                    $mydata="
                    <div class='defal' style='margin:5px;background:white;color black;border:solid thick purple;'>Now chatting with:<br>
                        <img src='$image' alt=''><br>$res->USERNAME
                        </div>";       
                        $message_box_left="
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
                    .mesage_left img {
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
                <div class='message_containter' id='scroled' style='display:flex;flex-direction:column;overflow-y:scroll; height:90%'>" ;
                $arr_id['massages']= $arr1['massage_id'];               
                $query_message="SELECT * FROM messages  WHERE  MASSAGEID=:massages";
                $meas=$obda->read($query_message,$arr_id);
                if(is_array($meas)){
                    foreach ($meas as $value) {
                    $myuser=$obda->get_user($value->SENDER);                  
                    if($value->SENDER==$_SESSION['user_id']){            
                        $message_box_left.=message_right($value,$myuser);
                       }
                    else{
                         $message_box_left.=message_left($value,$myuser);
                       }
                    }
                }

                // $message_box_left.=message_left($res);
                // $message_box_left.=message_right($res);
                    
                
                
                    
                $message_box_left.=message_send_onenter();      
                $info->massage=$mydata;
                $info->message_box_design=$message_box_left;        
                $info->data_type="chats";
                echo json_encode($info);
}

else {
            $info->massage="no contacts found";
            $info->data_type="chats";
            echo json_encode($info);
            }


function mess_id($max){
    $nu_r=array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','u','v','w','x','y','z','A','B');
    $ran='';
    $max=rand(4,$max);
    for ($i=0; $i<$max; $i++) {
        $atr=rand(0,36);
        $ran.=$nu_r[$atr];
    }
    return $ran;
}
// {"massage":{"data_type":"chats","resul":{"id":"4615233162"}},"data_type":"chats"}