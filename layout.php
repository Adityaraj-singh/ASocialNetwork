<?php
session_start();
include('test.php');

if(isset($_SESSION['userid']) && isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['password']))
{

  echo "<script>window.location.href='home.php';</script>";
   
exit;

}


if(isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['password']))
{
    

  $name=$_POST['fullname'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  signup($name,$email,$password);
 echo "<script>window.location.href='home.php';</script>";
   
exit;
}  
      
         
  if(isset($_POST['loginbtn']))
  {
     


    $lemail=$_POST['loginEmail'];
    $lpassword=$_POST['LoginPassword1'];
    $sql="SELECT * FROM user2 WHERE email='$lemail'";
    if($result=mysqli_query($conn,$sql))
    {
      while($row=mysqli_fetch_array($result))
      {

   
        
        $_SESSION['username']=$row['username'];
        $_SESSION['email']=$row['email'];
        $_SESSION['password']=$row['password'];
        $_SESSION['userid']=$row['id'];
         echo "<script>window.location.href='home.php';</script>";
   
exit;

     
         
       
    
      }
      
      

      }
    }
        $pageRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) &&($_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0' ||  $_SERVER['HTTP_CACHE_CONTROL'] == 'no-cache'); 
if($pageRefreshed == 1){
  
    unset($_POST);
       echo "<script type='text/javascript'> document.location = '".$_SERVER['PHP_SELF']."'; </script>";
    
        exit();

  
}
    

  ?>
<!doctype html>
<html lang="en" >
  <head>
           
<style type="text/css">

        @media (max-width: 575.98px) {
            #otplabel{
                font-size:80%;
                max-width:80px;
            }
          .wholepage{
             font-size:80%;
             
          }
          #loginmod{
              font-size:80%;
          }
          .signupbtn{
              width:50px;
          }
          .io{
         
          }
          
          #login{
             
              max-height:470px;
          }
          .modal-header{
              height:50px;
              font-size:80px;
          }
          .form{
              position:relative;
              top:0px;
              border-bottom:50px;
          }
          .entry{
             
        
              
          }
          
          #sign{
              font-size:80%;
             width:300px;
              margin-left:10px;
              margin-right:10px;
          }
          .signup-heading{
              font-size:20px
          }
          .logo{
              max-height:30px;
              max-width:30px;
          }
           
            
        }
        
      #mailexist{
        height: 0px;
      }
      .headers{
        
        height: 100px;
      }
      
      .tagline{
        position: relative;
        left: 200px;
        height:auto;
        
       
        text-align: center;
        object-fit: fill;
      }

      .form{
        
        position: relative;
        top:  30px;
            min-height:700px;    
        background-color:
      }

      
      .one{
        position: relative;
      max-height:300px;
        top:30px;
         margin-left: 20px;
        margin-right: 20px;
              justify-content: center;
        max-width:250px;
        margin-bottom:50px;
       
      }
      .entry{
        
        position: relative;
       
      top:30px;
         
        background-color:;
    width:500px;
      margin-bottom:50px;
              
      }
      
      #email{
        height: 40px;
       
      }
      #name{
        height: 40px;
      }
      #password{
        height: 40px;

      }
      .mb-3{
        position: relative;
        top:40px;
               background-color: transparent;

      }
      .mb-4{
        position: relative;
        top:40px;
       
        background-color: transparent;
      }
      .mb-5{
        position: relative;
        
        top:40px;
        display: inline;
      }

      
      
      
      
       
       .dropdown-item{
        position: relative;
       }
       
      
       .signupbtn{
        position: relative;margin-top: -20px;
       margin-top:10px;
       width:auto;
        top: 00px;
       }
       
                  #email::placeholder { /* Firefox, Chrome, Opera */ 
    color: black; 
}          #name::placeholder { /* Firefox, Chrome, Opera */ 
    color: black; 
}
          #password::placeholder { /* Firefox, Chrome, Opera */ 
    color: black; 
}


</style>





    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href='https://fonts.googleapis.com/css?family=Shadows Into Light' rel='stylesheet'>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Welcome</title>
    <!--
      <style type="text/css">
        
        body{
background: linear-gradient(skyblue , teal,black) no-repeat center center fixed;

      </style>
    -->
  </head>
  <body class="uk-background-primary wholepage">


<!-- OTP MODAL -->


<div class="modal fade" id="otpmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div class="hiddenot"></div>
        <div class="modaltitle" id="modaltitle"><h3>Check your email</h3></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<div class="otpform">
  <div class="row">
   
    <div class="col">
      <input type="text" class="form-control" id="otpinput" placeholder="Enter OTP here...">
    </div>
    <div class="col">
     <button type="button" class="btn btn-success" id="otpsubmit">GO</button>
    </div>
  </div>
      <center><div class="otperror" style="margin-top:20px;margin-left:20px;margin-right:20px"></div></center>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>

<!-- OTP MODAL -->


<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content uk-background-secondary text-white">
   <form class="px-4 py-3 login" id="loginform" method="POST">
      <div class="modal-header">
     <div class="container">
      <center>
        <h3 class="text-white">Login</h3>
      </center>
     </div>
      </div>
      <div class="modal-body">

   <center>
  <div class="form-group" >
    <label for="exampleDropdownFormEmail2"><b>Email address</b></label>
    <input type="email" name="loginEmail" class="form-control"  id="loginEmail" placeholder="email@example.com" required>
  </div>
  <div class="form-group" >
    <label for="exampleDropdownFormPassword2"><b>Password</b></label>
    <input  type="password" name="LoginPassword1" class="form-control" id="LoginPassword1" placeholder="Password" required>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input  type="checkbox" class="form-check-input" id="dropdownCheck" onclick="showloginp();">
      <label class="form-check-label" for="dropdownCheck2">
        <b>Show password</b>
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary" name="loginbtn">Sign in<span class="loginloader"></span></button>
   <div class=" invalid-error" ></div>
   <a href="forgot.php">forgot password</a>
</center>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Button trigger modal -->

<!-- Modal -->



    <div class="container-fluid img uk-background-secondary" >
      <div class="container ">
        <center>
  
   <h1 class="uk-heading-line text-white uk-text-center" >Cadabra<img class="logo" src="https://img.icons8.com/color/48/000000/genie.png"/></h1>
    <div  class="text-white">its time to show your art</div>
 </center>

</div>
</div>
    
    <div class="container form uk-background-primary" >
        
      <center>
    <div class="row" >
      <div class="row 0">
          <div class="col"></div>
          </div>
    <div class=" col one " >

<center>

     <ul class="border border-dark uk-card-body uk-box-shadow-xlarge" style=" border-radius: 20px;">
      <b>
<li class=" text-dark list-group-item">Share your art</li>
<li class="text-dark list-group-item"><button  class="btn btn-primary" id="loginmod" data-toggle="modal" data-target="#login" data-whatever="@mdo">Login</button> if already a user</li>
<li class="text-muted text-dark list-group-item">Go through the <a href="privacy.php" class="text-reset"><u>privacy</u></a> section</li>
  </b>
</ul>
</center>
    </div>



      <div class="border border-dark  col entry uk-card-primary  uk-card-hover uk-card-body" id="sign" style=" border-radius: 20px;">
        <form class="form1" method="POST">
       <center><h1 class=" text-dark signup-heading">Let's get Started</h1></center>
       
      <div class="input-group  mb-3">
   <label for="" class=" text-dark"><b>Full name</b></label>
  <input type="text"  id="name"  name="fullname" class="uk-input uk-form-width-large" placeholder="Enter your name here..." autofocus>
</div>
<div class="name-error" id="name-error" style="position: relative;top:25px;"></div>
  <div class="input-group  mb-4">
   <label for="" class=" text-dark"><b>E-mail</b></label>
  <input type="email" id="email" class="uk-input uk-form-width-large"  name="email" placeholder=" Enter your email here..." >
</div>
<div class="email-error" id="email-error" style="position: relative;top:17px;"></div>

  <div class="input-group input-group-sm mb-5">
   <label for="" class=" text-dark"><b>Password</b></label>
  <input type="password" id="password" class="uk-input uk-form-width-large" placeholder="Should contain 8 characters" name="password" >
</div>

  <div class="password-error" id="password-error" style="position: relative;top:-8px;"> </div>


<div class="form-group form-check" style="position: relative;margin-bottom: 20px;">
    <input type="checkbox" class="uk-checkbox" id="exampleCheck1" onclick="showpassword();">
    <label class="form-check-label" for="exampleCheck1">Show Password</label>
  </div>
<button type="button" name="signupbtn" class="btn  btn-outline-dark btn-lg signupbtn" >Agree & Join</button>
</form>


     </div>
 

 </div>
 </center>
</div>


  <div class=" container-fluid uk-section-secondary " style="height:100px;position: relative;top:75px;margin-top: 0px">
    <center>
    <div class="container">
     <div class="row row-cols-4 links">
      <div class="col"><a href="about.php" target="_blank" class="text-white uk-text-bold">About</a></div>
      <div class="col"><a href="privacy.php"  target="_blank" class="text-white uk-text-bold">Privacy</a></div>  
      
      <div class="col"><a href="" class="text-white uk-text-bold">Contact</a></div>
</div>
</div>
<div class="row-cols-1">
<div class="col" style="margin-top: 5px;"><h4 class="uk-text-lead text-white">A <span class="badge badge-secondary" style="font-family:Shadows Into Light">deaDshot </span> production </h4></div>
  </div>
  </center>
</div>





<!--alert on incorrect uername or password modalt-->


<!-- uikit-->

    <link rel="stylesheet" href="css/uikit.min.css"/>
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>

  

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>



    <script type="text/javascript">

      function showloginp()
      {

       var p=document.getElementById('LoginPassword1');
       if(p.type=="text")
       {
        p.type="password";

       }
       else
       {
        p.type="text";
       }

      }
      function showpassword()
          {
           var a=document.getElementById('password');
            
             if(a.type=="text")
             {
              a.type="password";
             }             
            else
            {
              a.type="text";
            }
            


          }
      
     $(".signupbtn").click(function(){

          

        var txtvalue=$("#name").val();
        var nameerror="";
        var emailerror="";
        var passworderror="";
        var flag=false;
        var bc;
          function isValid(str)
          {
          regex=/^[a-zA-Z ]*$/;
          bc=regex.test(str);
        }

        
        if(nameerror=="")
        {

        $("#name-error").html(''); 
        
        }

        if(emailerror=="")
        {

         $("#email-error").html(''); 
        
        }

        if(passworderror=="")
        {

          $("#password-error").html('');
          
        }


        if($("#name").val()=="")
        {

          nameerror+="your name is required";
           
            flag=false;
        }
        //checking for  speacial characters
        else if($("#name").val!="")
        {
         isValid(txtvalue);
         if(bc!=true)
         {  
          nameerror+="upper case n lower case alphabets allowed";
          flag=false;
         }
         else
         {
          nameerror+="";
         }

        }

        if($("#email").val()=="")
        {
          emailerror+="your email is required";
          
          flag=false;
         
        }
//check if email is already registered

        if($("#email").val()!="")
              {
                
                var email=$("#email").val();
             
                   $.ajax({
        url:'actions.php',
        type:'post',
        async:false,
        data:{
            'checkemail2':1,
            'email':email
            
            
            

        },
        success:function(data,status){
          
            data=data.trim();
         if(data=="already")
         {
          emailerror+="email already exist";
          flag=false;
         }


        }
  });

     }
        if($("#password").val()=="")
        {
          passworderror+="password field is empty";
          
        }

        if($("#password").val()!="")
        {

        if(($("#password").val().length)<=8)
        {

          passworderror+="your password should contain atleast 8 digits";
          $("#password-error").html('<div class="alert alert-danger" role="alert" >' + passworderror + '</div>');
          flag=false;
        }


      }
        if(nameerror!="")
        {
        $("#name-error").html('<div class="alert alert-danger namedanger" role="alert" style >' + nameerror + '</div>'); 

        flag=false;
        }


        if(emailerror!="")
        {
         $("#email-error").html('<div class="alert alert-danger emaildanger" role="alert" style="height:40px;text-align:top">' + emailerror + '</div>'); 
        }

        if(passworderror!="")
        {

          $("#password-error").html('<div class="alert alert-danger passworddanger" role="alert"  >' + passworderror + '</div>');
        }



      if(nameerror=="" && emailerror=="" && passworderror=="")
      {
          
//sending otp to email
                      $.ajax({
        url:'actions.php',
        type:'post',
        async:false,
        data:{
            'sendotp':1,
            'email':email
            
            

        },
        success:function(data,status){
                  data=data.trim();
         $(".hiddenot").html('<input type="hidden" id="hidddenotp" value="">');
         $('#hidddenotp').val(data);
        
        
        
        }
  });
       jQuery.noConflict();
    $('#otpmodal').modal('show');

      }

        
      });
      
      $("#otpsubmit").click(function()
        {

    var otpvalue=$("#otpinput").val();
    if(otpvalue=="") 
    {
      $(".otperror").html('<div class="alert alert-danger emaildanger" role="alert"   >Enter OTP</div>');
    }

    if(otpvalue!="")
    {

      if(otpvalue==$("#hidddenotp").val())
      {

        $(".form1").submit();
      }
      else
      {
          $(".otperror").html('<div class="alert alert-danger emaildanger" role="alert"   >incorrect otp</div>');
      }
    }


        });




            $("#loginform").submit(function(e)
             {

            
var email=$('#loginEmail').val();
var password=$('#LoginPassword1').val();
var fag=false;
             


      if(email!="" && password!="")
      {

 $.ajax({
        url:'actions.php',
        type:'post',
        async:false,
        data:{
            'logincheck':1,
            'email':email,
            'password':password,


        },
        success:function(data,status)
        {
          data=data.trim();
        if(data=="valid")
        {
          fag=true;
          

        }
        else
        {
        $(".invalid-error").html('<div class="alert alert-danger emaildanger" role="alert">' + 'invalid emailaddress or password' + '</div>'); 
          fag=false;
        }        
          
        }

        });

               }
               if(fag==false)
               {
                   $('.loginloader').html('');
               }
        

        return fag;
            });

    </script>
  </body>
</html>

