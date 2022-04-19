<?php
session_start();
$error = "";
$successMessage = "";
$servername="localhost";
$username="holmes";
$psswd="sherlock007#";
$dbname="myTesting-3135391362";     
$conn=mysqli_connect($servername,$username,$psswd,$dbname);
if(!$conn)
{
 echo "error in connection";
 echo   mysqli_error($conn);
          }

  

    if ($_POST) {
        
      if($error=="")
      { 
        if(isset($_SESSION['email']))
        {
          $_POST['email']=$_SESSION['email'];
        }
            
            $email=$_POST['email'];
            
            $subject = $_POST['subject'];
            
            $content = $_POST['content'];
            
            $headers =$_POST['email'];
          $sql="INSERT INTO feedback(email,subject,content) values('$email','$subject','$content')";
          if(mysqli_query($conn,$sql))
          {
            $successMessage='<div class="alert alert-success" role="alert">We have taken your feedback</div>';


          }

            
        }
        
        
        
    }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    unset($_POST);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Contact Us</title>
    <style type="text/css">
       @media (max-width: 575.98px) {
            .logo{
                max-height:40px;
                max-width:40px;
            }

          }
    </style>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
 <link rel="stylesheet" href="css/uikit.min.css"/>
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>
    <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
     <link href='https://fonts.googleapis.com/css?family=Indie Flower' rel='stylesheet'>
  </head>
  <body class="uk-tile-primary">
    <center><div class="uk-tile uk-tile-secondary">

       <center><h1 class="uk-heading-medium  uk-margin-remove"> <a  href="layout.php">Cadabra</a><img class="logo" src="https://img.icons8.com/color/48/000000/genie.png"/></h1>
              A perfect place to put you art on display
            </center>

    </div></center>      
      <div class="container text-dark">
      <div  style="position: relative;top: 0px;"><h3 class="text-dark"><center>Any query?,i'll look at it asap.</center></h3></div>

      <div id="error" style="margin-top: 10px;"></div>
      
      <form class="" method="post" style="position: relative;top:20px;margin-bottom: 200px ;">
        <?php
        if(!isset($_SESSION['email']))
        {
          echo'<fieldset class="form-group ">
      <label for="subject" style="color:black"><b>E-mail address</b></label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
    <small class="" style="color:black">i will never share your email with anyone else.</small>
  </fieldset>';
        }
 
  ?>
  <fieldset class="form-group">
    <label for="subject" style="color:black"><b>Subject</b></label>
    <input type="text" class="form-control" id="subject" name="subject" >
  </fieldset>
  <fieldset class="form-group">
    <label for="exampleTextarea" style="color:black"><b>What would you like to ask/suggest us?</b></label>
    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
  </fieldset>
  <button type="submit" id="submit" class="btn btn-danger" style="color:black">Submit</button>
</form>
          
        </div>



  <div class=" container-fluid uk-section-secondary " style="height:100px;position: relative;top: 20px;margin-top:350px;">
    <center>
    <div class="container">
     <div class="row row-cols-3 links">
      <div class="col"><a href="about.php" target="_blank" class="text-white uk-text-bold">About</a></div>
      <div class="col"><a href="privacy.php"  target="_blank" class="text-white uk-text-bold">Privacy</a></div>  
       <div class="col"><a href="contact.php" class="text-white uk-text-bold">Contact</a></div>
</div>
</div>
<div class="row-cols-1">
<div class="col" style="margin-top: 5px;"><h4 class="uk-text-lead text-white">A <span class="badge badge-secondary" style="font-family:Shadows Into Light">deaDshot </span> production </h4></div>
  </div>
  </center>
</div>



    <!-- jQuery first, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>


    <script type="text/javascript">
          
          $("form").submit(function(e) {
              
              var error = "";
              
              if ($("#email").val() == "") {
                  
                  error += "The email field is required.<br>"
                  
              }
              
              if ($("#subject").val() == "") {
                  
                  error += "The subject field is required.<br>"
                  
              }
              
              if ($("#content").val() == "") {
                  
                  error += "The content field is required.<br>"
                  
              }
              
              if (error != "") {
                  
                 $("#error").html('<div class="alert alert-danger" role="alert"><p><strong>There were error(s) in your form:</strong></p>' + error + '</div>');
                  
                  return false;
                  
              } 

              if(error=="") {
                                    $("#error").html('<div class="alert alert-success" role="alert">Your feedback has been recorded..</div>');
                 
                  alert("jii");
                   return true;
                  
              }


          });
          
    </script>
          
  </body>
</html>