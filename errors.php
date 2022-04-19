<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<style>
    @media (max-width: 767.98px) { 
        
        body{
            font-size:80%;
            
            
        }
        #backlink{
            font-size:80%;
        }
        #texthere{
            font-size:90%;
        }
    }
    
    .backlink{
        margin-top:50px;
    }
    
    
    
</style>
    <title>E-mail verification</title>
  </head>
  <body>
       <div class="uk-tile uk-tile-primary">
            <center><h1 > <span class="badge badge-secondary">E-mail Verification</span></h1></center>
        </div>
<?php
session_start();
include('test.php');

if(isset($_SESSION['upemail']))
{
$email=$_SESSION['upemail'];
$a=otp($email);
echo '<input type="hidden" id="otps" value="'.$a.'">';
}

$error="";

//untill sentotp is clicked
  if(isset($_POST['sentotp']))
  {
     
  

        $name=$_SESSION['upname'];
        $email=$_SESSION['upemail'];
        $pss=$_SESSION['uppassword']; 
          unset($_SESSION['upname']);
          unset($_SESSION['upemail']);
          unset($_SESSION['uppassword']);
          signup($name,$email,$pss);
          
        

 
   
   
    
  }
  if(isset($_SESSION['upname']) && isset($_SESSION['upemail']) && $_SESSION['uppassword'])
{   

  echo '<br>';echo '<br>';echo '<br>';echo '<br>';echo '<br>';echo '<br>';
 
?>
<form method="post">
<center>
ENTER OTP<input type="text" class="uk-input uk-form-width-medium uk-form-large texthere" id="texthere" name="otp" placeholder="enter otp here">
<input type="submit" class="btn btn-success" id="button" name="sentotp" value="Go"><br><br>
<div class="error" style="width:200px"></div>
   <a href="layout.php" class="btn btn-primary btn-lg active backlink" id="backlink" role="button" aria-pressed="true" >Go back to signup</a>
</center>
</form>

<?php

}
else
{echo '<br>';echo '<br>';echo '<br>';
  echo '<center>';
  echo '<div class="link">';
  echo '<a href="layout.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Go back to signup</a>';
  echo '</div>';
  echo '</center>';
}

if(isset($_SESSION['username']) && isset($_SESSION['email']) && isset($_SESSION['password']) && isset($_SESSION['userid']))
{
    
    

             echo "<script type='text/javascript'> document.location = 'home.php'; </script>";
           
        
}
?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="css/uikit.min.css"/>
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>
        <script type="text/javascript">
            
            
            $("form").submit(function(e) {
                flag=false;
                var a=$('#texthere').val();
                if($('#texthere').val()=="")
                {
                    flag=false;
                    $('.error').html('<div class="alert alert-danger" role="alert">Enter otp</div>');
                }
                
                if($('.texthere')val()!="")
                {
                    
                    if(a==$('#otps').val())
                    {
                        flag=true;
                    }
                    else
                    {
                        flag=false;
                                            $('.error').html('<div class="alert alert-danger" role="alert">incorrect otp</div>');
                        
                    }
                }
                
                
               return flag; 
            });
        </script>
  </body>
</html>


