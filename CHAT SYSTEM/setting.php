<?php

$query_insert="SELECT * FROM user_chat  WHERE USERID=:userid LIMIT 1";
$useridd=$_SESSION['user_id'];
$res=$obda->read($query_insert,['userid'=>$useridd]);
$mydata='';
if(is_array($res)){
$res=$res[0];
$image=($res->GENDER=='Male')? 'man.png':'female.png';
if(file_exists($res->IMAGE)){
    $image=$res->IMAGE;
}
$gender_male="";
$gender_female="";
if($res->GENDER=="Male"){
     $gender_male="checked";
}
else{
     $gender_female="checked";
}
$mydata='
    <style>     
        form{
           text-align:left;
           background:silver;
           width:55%;
           margin: 2em auto;
           height:80%;
           padding:1em;
                
           
        }
        input{
             margin:0.5em;          
             width:90%;
             border-radius:5%;
             padding:0.5em;
             color:black;
             transition:all 0.5s ease-in-out;
        }
       
        #btn{
            color:black;
            width:95%;
            background:#a09898;;
        }
        #btn:hover{
            background:blue;
            color:red;
        }
        .inner{
            display:flex;
            padding:0 1em;
            margin-right:10em;
        }        
        #erro{
            background:black;
            color:white;
            width:95%;
            max-width:600px;
            min-height:20px;
            text-align:center;
            padding:0.3em;
            display:none;
        }  
        .drag_style{
            border:dotted thin red;
        }    
    </style>
        
        <form id="setting_info" >
        <div id="erro"></div>
            <input type="text" name="username" placeholder="Username" value="'.$res->USERNAME.'"><br>
            <input type="email" name="email" placeholder="Email" value="'.$res->EMAIL.'"><br>       
              <div class="inner">
                     Gender:
                     <input type="radio" name="radio1" value="Male"'.$gender_male.'>Male
                     <input type="radio"  name="radio1" value="Female"'.$gender_female.'>Female
              </div>            
            <input type="text"  name="password" placeholder="Password" value="'.$res->PASSWORD.'"><br>
            <input type="text"  name="confirmpass" placeholder="Retype Password" value="'.$res->PASSWORD.'">
            <div class="image" style="display:flex;">
            <img src="'.$image.'" alt="man.png" style="width:15%" ondragover="drag_and_drop(event)" ondrop="drag_and_drop(event)" ondragleave="drag_and_drop(event)">
            <label for="file_upload" style="background:blue; width:20%; margin-left:1.5em; border-radius:10px;text-align:center;">Change</label>
            <input type="file" style="margin-top:1.5em; display:none" id="file_upload" onchange="upload_progile_image(this.files)">
            </div>
            <input type="button" value="Save Settings" id="btn" onclick="collectdata()">  
       </form> 

';
$info->massage=$mydata;
$info->data_type="sett_ings";
echo json_encode($info);
die;
}else{
    $info->massage="no contacts found";
    $info->data_type="sett_ings";
    echo json_encode($info);
}

