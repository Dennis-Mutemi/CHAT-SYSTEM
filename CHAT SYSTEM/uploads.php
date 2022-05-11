<?php
require_once("info.php");
$datatype="";
if(isset($_POST['data_type'])){
    $datatype=$_POST['data_type'];
}
$destinat="";
if(isset($_FILES['user_profile_image'])){
       if($_FILES['user_profile_image']['error']==0){
           $folde="uploads/";
           if(!file_exists($folde)){
               mkdir("uploads",0777,true);
           }
           $destinat=$folde . $_FILES['user_profile_image']['name'];
           move_uploaded_file($_FILES['user_profile_image']['tmp_name'],$destinat);
            $info->massage="user image updated successifully";
            $info->data_type=$datatype;
            echo json_encode($info);
       }
}

if( $datatype=="user_image"){
    if($destinat!=""){
        $id=$_SESSION['user_id'];
        $query="UPDATE user_chat SET IMAGE='$destinat' WHERE USERID='$id' LIMIT 1";
        $obda->write($query,[]);
    }
}

// Array
// // (
// //     [user_profile_image] => Array
// //         (
// //             [name] => 2019-08-20-08-58-11-050.jpg
// //             [type] => image/jpeg
// //             [tmp_name] => C:\xampp\phpMyAdmin\xampp\tmp\php7922.tmp
// //             [error] => 0
// //             [size] => 1107809
// //         )

// // )

// Array
// (
//     [data_type] => user_image
// )