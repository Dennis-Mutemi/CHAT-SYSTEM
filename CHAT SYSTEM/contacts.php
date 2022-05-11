<?php
$myid=$_SESSION['user_id'];
 $query_insert="SELECT * FROM user_chat  WHERE  USERID!='$myid'";
 $res=$obda->read($query_insert,[]);
 $mydata='
 <div class="conta">';
 if(is_array($res)){
 foreach($res as $row ){
    $image=($row->GENDER=="Male")? "man.png":"female.png";
    if(file_exists($row->IMAGE)){
        $image=$row->IMAGE;
    }
   $mydata.= "
   <div class='defal' userid='$row->USERID' onclick='load_chatpage(event)' style='cursor:pointer;'>
       <img src='$image' alt=''><br>$row->USERNAME
    </div>"; 
     };
    }                           
    $mydata.='</div>';
$info->massage=$mydata;
$info->data_type="con_tacts";
echo json_encode($info);
die;
$info->massage="no contacts found";
$info->data_type="con_tacts";
echo json_encode($info);