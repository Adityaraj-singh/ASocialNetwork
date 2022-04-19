<?php
include('test.php');
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link href='https://fonts.googleapis.com/css?family=Shadows Into Light' rel='stylesheet'>
    <title>Forgot password</title>
    <style type="text/css">
        
        body{
            overflow-x:hidden;
        }
    </style>
  </head>
  <body class="uk-background-primary">
<center>
    <div class="uk-tile uk-tile-secondary"><h1>Theink </h1></div>
<div class="container">
   
    <h2><span class="badge badge-success">Forgot password</span></h2>      
   
</div>

</center>

 
      <?php
//finally saving password

       if(isset($_POST['savepassword']))
          {


           $email=$_POST['email'];
           $password=$_POST['password'];
           $password=$pass=mysqli_real_escape_string($conn,$password);
           $sql="SELECT * FROM user2 WHERE email='$email'";
           if($result=mysqli_query($conn,$sql))
           {

            while($row=mysqli_fetch_array($result))
            {
              $userid=$row['id'];
              $username=$row['username'];
              
            }
           }

           $password=md5(md5($userid).$password);
           $sql2="UPDATE user2 SET password='$password' WHERE email='$email' ";

           if(mysqli_query($conn,$sql2))
           {
               session_start();
            $_SESSION['email']=$email;
            $_SESSION['userid']=$userid;
            $_SESSION['username']=$username;
            $_SESSION['password']=$password;
           echo "<script type='text/javascript'> document.location = 'home.php'; </script>";


           }
          }
#changing password

      if (isset($_POST['confirm']))
       {
        echo '<center><h1 class="uk-heading-small">Set a new password</h1></center>';

        echo '<div class="container" style="background-color:;min-height: 50px">';





         $email=$_POST['email'];
       $sql="SELECT * FROM user2 WHERE email='$email' LIMIT 1";
       if($result=mysqli_query($conn,$sql))
       {

        while($row=mysqli_fetch_array($result))
         {
          $dp=$row['profile_pic'];
          if($dp=="")
          {
            $dp="deafult.png";
          }


          echo '<center><div class="border border-dark uk-card uk-card-default uk-width-1-2@m" style="position:relative;">
    <div class="uk-card-header">
        <div class="uk-grid-small uk-flex-middle" uk-grid>
            <div class="uk-width-auto">
                <span class=" uk-border-circle"  alt="..." style="max-height:100px;width:100px;"> <img class="uk-border-circle" src="profile_pictures/'.$dp.'" style="max-height:100px;width:90px;"></span>
            </div>
            <div class="uk-width-expand uk-align-left">
               <h3 class="uk-card-title uk-margin-remove-bottom uk-align-left">'.$row['username'].'</h3>
                
            </div>
        </div>
    </div>
    
    
</div></center>';
          
        }

    

       }
       else
       {
        echo mysqli_error($conn);
       }    

       //changin passwors fields
      
echo '<form class="changepassword" method="POST">
 
  <div class="form-group">
    <label for="exampleInputPassword1"><h3>Set a new password</h3></label>
    <input type="password" name="password" class="form-control password" id="password">
  </div>
  <input type="hidden" name="email" value="'.$email.'">
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input " id="exampleCheck1" onclick="showpassword();">
    <label class="form-check-label" for="exampleCheck1">show password</label>
  </div>
  <div class="passworderror" style="background-color:;"></div>

  <button name="savepassword" type="submit" class="btn btn-dark">Submit</button>
</form>';

           echo '</div>';

      }
#veryfing otp

      if(isset($_POST['sendotp']))

{
 


$email=$_POST['email'];
  $s=otp($email);
echo '<input type="hidden" id="otps" value="'.$s.'">';
  echo '<form class="varifyotp" method="POST" style="margin-bottom:100px">';
  echo '<input type="hidden" name="email" value="'.$email.'">';


echo ' <div class="container" style="position: relative;top:100px">
  <center>
     
    
    <label for="" class=" text-dark"><b>Enter Otp:</b></label>
<div class="input-group mb-3 " style="width:300px"  >

  <input type="text" class="form-control" id="otp" name="otp" placeholder="enter opt here" aria-label="Recipients username" aria-describedby="basic-addon2">
  <div class="input-group-append">

  </div>
  
    </center>
    <center><div class="error" style="position;relative;top:60px;width:200px;"></div></center>
</div>';

echo '<center><button  name="confirm" type="submit" class="btn btn-dark" style="position:relative;top:150px;">submit</button></center>';

echo '</form>';
}


#finding account via email
      if(!isset($_POST['sendotp']) && !isset($_POST['confirm']) && !isset($_POST['savepassword']))
      {
       
       
       
        echo '<form class="email" method="POST">';
        echo ' <div class="container" style="position: relative;top:100px">
      <h3  style="margin-bottom: 50px">Enter your email below </h3>
<div class="input-group mb-3">
  <input type="email" class="form-control" name="email" id="email" placeholder="enter your email " aria-label="Recipients username" aria-describedby="basic-addon2">
  <div class="input-group-append">
    
  </div>
</div>
<div class="email-error" style="background-color:;"></div>
<center><button  name="sendotp" type="submit" class="btn btn-danger">Send otp</button></center>
</div>';
echo '</form>';
      }
  ?>

  
</div>
    <center>
	<div class="welcme-page" style="position:relative;top:150px">
	    <a href="layout.php" class="badge badge-secondary">Back to signup page</a>

</div>
</center>

      <div class=" container-fluid uk-section-secondary " style="height:100px;position: relative;margin-top:390px;">
    <center>
    <div class="container">
     <div class="row row-cols-3 links">
      <div class="col"><a href="about.php" target="_blank" class="text-white uk-text-bold">About</a></div>
      <div class="col"><a href="privacy.php"  target="_blank" class="text-white uk-text-bold">Privacy</a></div>  
      <div class="col"><a href="contact.php" target="_blank" class="text-white uk-text-bold">Contact</a></div>
</div>
</div>
<div class="row-cols-1">
<div class="col" style="margin-top: 5px;"><h4 class="uk-text-lead text-white">A <span class="badge badge-secondary" style="font-family:Shadows Into Light">deaDshot </span> production </h4></div>
  </div>
  </center>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/uikit.min.css"/>
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>
        <script type="text/javascript">
          function showpassword()
          {

                    var cp=document.getElementById('password');
                    if(cp.type=="password")
                    {
                      cp.type="text";
                    }
                    else
                    {
                      cp.type="password";
                    }
          }
 
          //email form validation
          $(".email").submit(function(e) {
            var flag=false;


if($("#email").val()=="")
{
$(".email-error").html('<div class="alert alert-danger" role="alert" ><center>' +'enter email above' + '</center>  </div>');
flag=false;   

}

  
  if($("#email").val()!="")
  {
    var em=$("#email").val();

    $.ajax({
        url:'actions.php',
        type:'post',
        async:false,
        data:{
            'emailverify':1,
            'email':em,
          


        },
        success:function(data,status)
        {
            data=data.trim();
       if(data=="found")
       {
        flag=true;
       }

       else
       {
               $(".email-error").html('<div class="alert alert-danger" role="alert" ><center>' +'no account with such email found' + ' </center> </div>');
        flag=false;
       }    
          
        }

        });


  }
  



return flag;
});

            //otp form validation
             $(".varifyotp").submit(function(e){
              var flag=false;
              var a=document.getElementById('otps');
    var otp=a.value;
              if($("#otp").val()=="")
              {
                flag=false;
                $('.error').html('<div class="alert alert-danger" role="alert" >' +'enter otp' + '  </div>');

              }

              if($("#otp").val()!="")
              {

                if($("#otp").val()==otp)
                {
                  flag=true;
                }
                else
                {
                  $('.error').html('<div class="alert alert-danger" role="alert" >' +'incorrect otp' + '  </div>');
                  flag=false;
                }



              }



              

return flag;
});
        
         $(".changepassword").submit(function(e) {
         var flag;
         var password_error="";


         if($('#password').val()=="")
         {
          password_error="its empty";
         $('.passworderror').html('<div class="alert alert-danger" role="alert" ><b><center>' +'enter password' + ' </center></b> </div>');
          flag=false;
         }      

         if($('#password').val()!="")
         {
          if($('#password').val().length<8)
          {
            password_error="less than 8";
             $('.passworderror').html('<div class="alert alert-danger" role="alert" ><b><center>' +'password should be atleas 8 digit long' + ' </center></b> </div>');
            flag=false;
          }
          else
          {
            flag=true;
          }


         }

         if(password_error=="")
         {
          flag=true;
         }
         

return flag;
       });
        </script>
  </body>
</html>