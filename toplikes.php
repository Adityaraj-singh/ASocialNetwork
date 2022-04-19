<?php

include('test.php');
include('navbar.php');
$userid=$_SESSION['userid'];

$servername="localhost";
$username="root";
$psswd="sherlock007#";
$dbname="test";        
$conn=mysqli_connect($servername,$username,$psswd,$dbname);
if(!$conn)
{
 echo "error in connection";
 echo   mysqli_error($conn);
  }


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <link href='https://fonts.googleapis.com/css?family=Shadows Into Light' rel='stylesheet'>
    <title>Top liked posts</title>
  <style type="text/css">
      @media (max-width: 768px) { 

        body{
          font-size:60%;
        }
        #userpic{
            max-height:20px;
            max-width:20px;
        }
       }
    .slide{
      max-width:1000px;
      position: relative;
      top:100px;


    }
    .imgpost{
      max-height: 400px;
    }
    .main-carsoul{
        min-height: 500px;
       }
#carouselExampleIndicators{
   
    top:100px;
    margin-bottom:150px;
}
div[class=" container-fluid uk-section-secondary bottoms"]
{
  height:100px;position: relative;top:100px;  
}
img[class="uk-border-circle userpic"]{
       max-height:40px;
      max-width:40px;
      margin-left: 10px;
}

  </style>
  </head>
  <body class="uk-background-primary">
  <center><h1><span class="badge badge-dark" style="position: relative;top:50px">Top 10 liked posts</span></h1></center>
 <center>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" >
 
<div class="navigations">
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next " href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only text-dark" style="color: red;">Next</span>
  </a>
  
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
    <div class="main-carsoul" ><center><h2>TOP 10 likes sliding</h2></center>

    </div>
    </div>

    <?php

    
$userid=$_SESSION['userid'];
          $sql="SELECT * FROM textposts ORDER BY likes DESC  LIMIT 10";
          if($result=mysqli_query($conn,$sql))
          {
             $a=1;

            while($row2=mysqli_fetch_array($result))
            {
              $postid=$row2['id'];
             
              echo '<div class="carousel-item ">';

            echo '<div class=" card text-center uk-card-secondary " id="card">
  <div class="card-header" id="card-header">
   Rank#'.$a.'
  </div>
  <div class="card-body" id="card-body">';
echo '<a href="image.php?request_number='.$row2['userid'].'#postid'.$row2['id'].'" >go to post</a>';
echo'  <h5 class="card-title "><b>'.$row2['post_title'].'</b></h5>';

       if($row2['type']=="text")
    {
    echo '    <p class="card-text">'.nl2br( $row2['post_content']).'</p>';      
    }
    if($row2['type']=="video")
    {
  echo '<div class="uk-inline">

  <video src="images/'.$row2['post_content'].'" id="video'.$row2['id'].'" class="video-post" frameborder="0" automute="true" audio="off" uk-video="autoplay: inview" ></video>
  <div class="uk-overlay uk-light uk-position-bottom">
        <a class="badge badge-info uk-align-right sound sound'.$row2['id'].'" id="soundbutton" postid="'.$row2['id'].'">audio</a>
    </div>
</div>

 ';
  
    }
    if($row2['type']=="image")
    {
       echo '<img src="images/'.$row2['post_content'].'"  id="imgpost" class="h-70 p-1 img-fluid" alt="Responsive image" style="max-height:650px;">';
    }

    $postuserid=$row2['userid'];
    $sql2="SELECT profile_pic FROM user2 WHERE id='$postuserid' ";
    $result3=mysqli_query($conn,$sql2);
     while($picrow=mysqli_fetch_array($result3))
  {

    $dp=$picrow['profile_pic'];

  }
  if($dp=="")
  {
      $dp="deafult.png";
  }


    
 echo '</div>
  <div class="dropdown-divider"></div>
  <div class="card-body">
  <blockquote cite="#" class="uk-column-span uk-align-left">

            <footer>By : <cite><a href="myprofile.php">'.$row2['usrname'].'</a><img  src="profile_pictures/'.$dp.'" class="uk-border-circle userpic" id="userpic"></cite></footer>
    </blockquote>


  </div>
  <div class="card-footer text-muted">';

echo '<span class="uk-badge  uk-align-left">Likes:'.$row2['likes'].'</span>';
echo' </div>
</div>';

              echo '</div>';
              $a++;
            }
          }
          


    echo '</div>';
    ?>
    
  </div>
  
</div>


</center>
                
 <div class=" container-fluid uk-section-secondary bottoms" id="bottoms" >
    <center>
    <div class="container">
 <div class="row row-cols-3 links">
      <div class="col"><a href="about.php"  target="_blank" class="text-white">About</a></div>
      <div class="col"><a href="privacy.php"  target="_blank" class="text-white">Privacy</a></div>  
      <div class="col"><a href="contact.php" target="_blank" class="text-white">Contact</a></div>

</div>
</div>
<div class="row-cols-1">
<div class="col" style="margin-top: 5px;"><h4 class="uk-text-lead text-white">A <span class="badge badge-secondary" style="font-family:Shadows Into Light">deaDshot </span> production </h4></div>
  </div>
  </center>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/lib
    s/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



      <link rel="stylesheet" href="css/uikit.min.css"/>
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>
        <script type="text/javascript">
          
          $('.carousel').carousel({
  interval: 3000
});

$('.sound').click(function(){


var id=$(this).attr("postid");

var v=document.getElementById("video"+id);
if($("#video"+id).attr("audio")=="on")
{
  v.muted=true;
  $("#video"+id).attr("audio","off");
  $(".sound"+id).html("audio");
}
else
{
  v.muted=false;
  $("#video"+id).attr("audio","on");
  $(".sound"+id).html("mute");

}
});
        </script>
  </body>
</html>

