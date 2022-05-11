<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat System</title>
</head>
<style>
    .wrapper{  
        max-width:70%;
        min-height:80%;
        margin:auto;
        display:flex;
        text-align:center; 
    }
    .left_panel{       
        background:blue;
        flex:1;       
   
    }
    .right_panel{     
        flex:3;
    
    }
    .upper{
        background:red;
        height:70px;
        padding:4px;
    }
    .container{
        display:flex;        
        transition:all .5s ease;
        max-height: 450px;       

    }
    .inner_right_panel{
        overflow-y:scroll;
        background:maroon;
        min-height:430px;
        flex:1;
        
    }
    .outer_right_panel{
        height:430px;       
        background:#ff00c8;;
        flex:2;
       
       

        
    }
    img{
        width:30%;        
        border-radius:50%;
        padding:6px;
    }
    .left_panel label{
        display:block;
        line-height:1.5;
        background:#fff5;
        width:96%;
        border-bottom:solid thin red;
        transition:all 2s ease;
        margin:auto;
        cursor:pointer;
    }
    .left_panel label:hover{
        background:silver;
    }
    .dis{
        display:none;
    } 
  #contact:checked ~.outer_right_panel{            
    flex:0;
    display:none;       
          }
  #setting:checked ~.outer_right_panel{            
     flex:0;
     display:none;   
          
    }
    
    .conta{
        column-count:3;
        vertical-align:top;               
       }   
      .defal{
        border:solid thin blue;
        break-inside: avoid;
      }
</style>
<body>
    <div class="wrapper">
        <div class="left_panel">
                <img src="man.png" alt="you" id="user_profile">
                <p> <span id="name">Username</span><br><span id="email">Email@gmail.com</span></p>
                <label id="chatt" for="chat">chats</label>
                <label id="cont" for="contact">Contacts</label> 
                <label id="sett" for="setting">Setting</label>
                <label id="LogOut">LogOut</label>
        </div>
        <div class="right_panel">
            <div class="upper">                
               <p>my chat</p>
            </div>
            <div class="container">
                
                <div class="inner_right_panel" id="outer_right">
                       
                </div>
              
                    <input type="radio" id="chat" name="rd" class="dis">
                    <input type="radio" id="contact" name="rd" class="dis" checked>
                    <input type="radio" id="setting" name="rd" class="dis">         
                    
                <div class="outer_right_panel" id="inner_right">

                </div>                               
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT CODE -->
    <script>
        let SEEN_STATUS=false;
        function _(elem){
            return document.getElementById(elem);
        }
        let logot=_("LogOut");
        logot.addEventListener('click',signout);
        _('cont').addEventListener('click',deal_contacts);
        _('chatt').addEventListener('click',chats);
        _('sett').addEventListener('click',settings);
        function colectdata(resul,type){
            let ajax = new XMLHttpRequest();
        ajax.onload=function(){
            if(ajax.status==200||ajax.readystate==4){
                hundle_result(ajax.responseText,type);
             }
        }
        let data={};
        data.data_type=type;
        data.resul=resul;
        let dat_string=JSON.stringify(data);
        ajax.open("post","info.php",true);
        ajax.send(dat_string);
    }    
    function hundle_result(res){    
       if(res.trim!=""){        
            let obj=JSON.parse(res);
            if(typeof(obj.logged_in!="undefined") && obj.logged_in==false){      
                 window.location="login.php";
            }           
          else{
             switch (obj.data_type){
                case 'user_info':                   
                    _('name').innerHTML=obj.USERNAME;
                    _('email').innerHTML=obj.EMAIL;
                    _('user_profile').src=obj.img;
                     break;
                case 'con_tacts':                                                                                    
                    _('outer_right').innerHTML=obj.massage;
                     break;
               case 'chats_refresh':
                    SEEN_STATUS=false;                                                                                    
                    _('scroled').innerHTML=obj.message_box_design;
                    _('scroled').scrollTo(0,_('scroled').scrollHeight)   
                                        
                    break;
                case 'chats': 
                     SEEN_STATUS=false;                                                                                    
                    _('outer_right').innerHTML=obj.massage;
                    _('inner_right').innerHTML=obj.message_box_design;                                                
                    _('scroled').scrollTo(0,_('scroled').scrollHeight);
                    _('massage_id').focus();              
                     break;
                case 'sett_ings':                                                                                                  
                    _('outer_right').innerHTML=obj.massage;                  
                      break;  
             }
                 }
             }
        }       
         
    colectdata({},"con_tacts");
     function signout(){
         let con=confirm("Are you sure you want to log out???");
         if(con){
        colectdata({},"log_out"); 
          }
             }
    function deal_contacts(e){
        colectdata({},"con_tacts");
             }
   
    function chats(){
        colectdata({},"chats");
        }    
    function settings(){
        colectdata({},"sett_ings"); 
    }
   colectdata({},"user_infor");

    </script>
    
</body>
</html>

<!-- update user settings -->
<script>        
    let data={};
    function collectdata(){
        let elem=_("setting_info");
        let elements=elem.getElementsByTagName("input");
        for (let index = 0; index < elements.length; index++) {
        let element = elements[index].name;
        switch (element) {
            case "username":
                data.username= elements[index].value;       
                break;
            case "email":
                data.email= elements[index].value;       
                break;
            case "radio1":
                if(elements[index].checked){
                 data.radio1= elements[index].value;
                 }                                  
                break;
            case "password":
                data.password= elements[index].value;       
                break;
            case "confirmpass":
                data.confirmpass= elements[index].value;       
                break;        
        }
        
        }
        senddata(data,"update");
    }  
    let kk=_("btn");   
    function senddata(data,type){
        let ajax = new XMLHttpRequest();
        ajax.onload=function(){
            if(ajax.status==200||ajax.readystate==4){
                hundle_updateinfo(ajax.responseText);
             }
        }
        data.data_type=type;
        let dat_string=JSON.stringify(data);
        ajax.open("post","info.php",true);
        ajax.send(dat_string);
    } 
    function hundle_updateinfo(update_infor){             
        let update_data="";
        if(update_infor!=""){
           update_data=JSON.parse(update_infor);
            switch(update_data.data_type){
                case "updatemessag":
                    alert(update_data.mess);                    
                    colectdata({},"user_infor");
                    settings();       
                    break;
                case "error":
                    _("erro").innerHTML=update_data.mess;
                    _("erro").style.display="block";
                    break;


            }
         }
        

    } 
    // updtae user image  
    function upload_progile_image(files){
        
        let myfile=new FormData();        
        let ajax = new XMLHttpRequest();
        ajax.onload=function(){
            if(ajax.status==200||ajax.readystate==4){
                // alert(ajax.responseText);
                colectdata({},"user_infor");
                settings(); 
             }
        }
        myfile.append("data_type","user_image");
        myfile.append("user_profile_image",files[0]);
        ajax.open("post","uploads.php",true);
        ajax.send(myfile);
     
    }
// drag and drop code
function drag_and_drop(e){
    if(e.type=="dragover"){
        e.preventDefault();
        e.target.className="drag_style";
    }
    else if(e.type=="drop"){
        e.preventDefault();
        e.target.className="";
        upload_progile_image(e.dataTransfer.files);

    }
    else if(e.type=="dragleave"){
        e.preventDefault();
        e.target.className="";
   }
    else{
        e.target.className="";
    }
}
 let receiver_id='';
function load_chatpage(e){
    let userid=e.target.getAttribute('userid');
    if(userid==""){
        userid=e.target.parentNode.getAttribute('userid');
     }
     receiver_id=userid;
     let new_user={};
     new_user.id=userid;
     colectdata(new_user,"chats");
    _("chat").checked=true;

}
// send  massege function
function send_massege(e){
   
    let mes_conte=_("massage_id");   
    if(mes_conte.value.trim()=="" ){
        alert("you cannot send an empty text");        
       
        }
    else{
            let sender_info={};
            sender_info.id=receiver_id;
            sender_info.message=_('massage_id').value;
            colectdata(sender_info,"sendreceive");

        }
}
function send_onenter(e){
       if(e.keyCode==13){
        send_massege(e);
    }
    SEEN_STATUS=true;
}
function set_seenstatus(e){
    SEEN_STATUS=true;
}
setInterval(() => {
    if(receiver_id!=''){  
        console.log(SEEN_STATUS);     
        let new_user={};
        new_user.id=receiver_id;
        new_user.seen =SEEN_STATUS
        colectdata(new_user,"chats_refresh");
     }
},2500);

</script>