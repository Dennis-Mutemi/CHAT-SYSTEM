<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
    <style>
        .wrapper{
            max-width:400px;           
            margin:6em auto;
        }
        form{
           text-align:center;
           background:silver;        
           
        }
        input{
             margin:0.5em;          
             width:90%;
             border-radius:5%;
             padding:0.5em;
             color:grey;
             transition:all 0.5s ease-in-out;
        }
        .heade{
            background:red;
            color:white;
            text-align:center;
            height:3em;
            padding-top:1.5em;
        }
        #Signin{
            color:black;
            width:95%;
            background:#a09898;;
        }
        #Signin:hover{
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
            max-width:600px;
            min-height:20px;
            text-align:center;
            padding:0.5em;
            display:none;
        } 
        #succ{
            background:#bed4a5;;
            color:white;
            max-width:600px;
            min-height:15px;
            text-align:center;
            padding:0.5em;
            position:relative;
            display:none;
                      
        } 
        .exit{
           font-size:1em;
           position:absolute;
           top:0;
           right:0;
           color:red;
           cursor: pointer;
        }  
    </style>
</head>
<body>
    <div class="wrapper">
        <div id="succ">
            <div class="exit">x</div>
        </div>
        <div class="heade">My Chat</div>
        <div id="erro"></div>
        <form id="main">
            <input type="text" name="username" placeholder="Username"><br>              
            <input type="password"  name="password" placeholder="Password"><br>           
            <input type="button" value="Sign In" id="Signin">
            <a href="model.php" style="display:block;text-align:center;text-decoration:none;">Don't have an account sign up here</a>
        </form>
    </div>
    <script>
    function _(elemen){
        return document.getElementById(elemen);
          }
    let elem=_("main");
    let elements=elem.getElementsByTagName("INPUT");
    let data={}
    function collectdata(e){        
        for (let index = 0; index < elements.length; index++) {
        let element = elements[index].name;
        switch (element) {
            case "username":
                data.username= elements[index].value;       
                break;                      
            case "password":
                data.password= elements[index].value;      
                break;
                
        }
        
        }
        senddata(data,"sign_in");
    }  
    let kk=_("Signin");
    kk.addEventListener("click",collectdata);
    function senddata(data,type){
        let ajax = new XMLHttpRequest()
        ajax.onload=function(){
            if(ajax.status==200||ajax.readystate==4){
                disp(ajax.responseText);
             }
        }
        data.data_type=type;
        let dat_string=JSON.stringify(data);
        ajax.open("post","info.php",true);
        ajax.send(dat_string);
    }    
    function disp(result){                    
        let erro=_("erro");       
        let obj=JSON.parse(result);
        if(obj.data_type=="info"){
           window.location="chatpage.php";
                
                }
        else{          
           
                 erro.innerHTML=obj.mess;
                 erro.style.display="block";
                       
        }

    }
   
</script>
</body>
</html>
