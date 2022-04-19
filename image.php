<html>
<head>
	<title>
	    
	    <?php
	    include('test.php');
	    $searchid=$_GET['request_number'];
	    $s="SELECT username FROM user2 WHERE id='$searchid'";
	        if($profile=mysqli_query($conn,$s))
{
	
	if(mysqli_num_rows($profile)>0)
	{

while($row2=mysqli_fetch_array($profile))
{
    
 $row2['username'];
 echo $row2[0];
}

}

}

	    ?>
	    
	</title>
	<style type="text/css">
		
      .complain{
          
    resize: none;
   }
    
   
@media (max-width: 575.98px) {
    
    span[id="menuicon"]{
       height:20;
    }
    #searchinput{
        width:200px;
        height:30px;
    }
    #submitsearch{
    height:32px;
       
    }
    #displaypic{
       height:25px;
        max-width:35px;
    }
    
    #username{
        
        font-size:15px;
    }

    a[class="badge badge-danger reportss"]{
        font-size:8px;
       position:relative;
       right:-30px;
    }
    .title{
        
        font-size:15px;
    }
    #timespan{
        
       font-size:06px;
        position:relative;
       right:-10px;
    }
    .textpost{
        
        font-size:10px;
    }
    
    .unlike{
        font-size:10px;
    }
    .like{
        font-size:10px;
    }
    span[id="likeno"]{
        font-size:8px;
    }
    #postall{
    
    }
    
    
    img[class="h-70 p-1 img-fluid textpost"]
    {
        max-height:200px;
       max-width:auto;
    }
    
   #usercard{
       font-size:100%;
       max-width:300px;
   }
   #cardpic{
       max-height:100px;
   }
   #username{
       font-size:20px;
   }
   span[id="dropdownMenuButton"]{
        font-size:8px;
    }
    #likepic{
        max-height:20px;
        max-width:20px;
    }
     .totalcomments{
        font-size:90%;
    }
      #soundbutton{
        position:relative;
        top:10px;
        font-size:8px;
    }
    #comment-pic{
        max-height:22px;
        max-width:22px;
    }
    #commented-name{
        font-size:80%;
    }
   
    
     }
     .username{
         font-size:50px;
     }
     .usercard{
         
         position:relative;
         top:100px;
         max-width:520px;
         max-height:auto;
     }
     .cardpic{
         max-height:200px;
         max-width:auto;
     }
.like {
  box-shadow:inset 0px 1px 0px 0px #ffffff;
  background:linear-gradient(to bottom, #f9f9f9 5%, #e9e9e9 100%);
  background-color:#f9f9f9;
  border-radius:6px;
  border:1px solid #dcdcdc;
  display:inline-block;
  cursor:pointer;
  color:#666666;
  font-family:Arial;

  font-weight:bold;

  text-decoration:none;
  text-shadow:0px 1px 0px #ffffff;
}
.like:hover {
  background:linear-gradient(to bottom, #e9e9e9 5%, #f9f9f9 100%);
  background-color:#e9e9e9;
}
.like:active {
  position:relative;
  top:1px;
}


.unlike {
  box-shadow: 0px 10px 14px -7px #276873;
  background:linear-gradient(to bottom, #599bb3 5%, #408c99 100%);
  background-color:#599bb3;
  border-radius:8px;
  display:inline-block;
  cursor:pointer;
  color:#ffffff;
  font-family:Arial;

  font-weight:bold;
 
  text-decoration:none;
  text-shadow:0px 1px 0px #3d768a;
}
.unlike:hover {
  background:linear-gradient(to bottom, #408c99 5%, #599bb3 100%);
  background-color:#408c99;
}
.unlike:active {
  position:relative;
  top:1px;
}
img[class="uk-border-circle commentpic"]{
  max-height: 30px;
  max-width:30px;

}

img[class="uk-border-circle likepic"]{
    max-height:30px;
    max-width:30px;
}
	</style>
</head>
<body class="uk-background-primary">

<?php

include('navbar.php');

$servername="shareddb-y.hosting.stackcp.net";
$username="holmes";
$psswd="sherlock007#";
$dbname="myTesting-3135391362";          
$conn=mysqli_connect($servername,$username,$psswd,$dbname);
if(!$conn)
{
 echo "error in connection";
 echo   mysqli_error($conn);
          }


$searchid=$_GET['request_number'];




$sql="SELECT username,profile_pic FROM user2 WHERE id='$searchid'";
if($profile=mysqli_query($conn,$sql))
{
	
	if(mysqli_num_rows($profile)>0)
	{


while($row2=mysqli_fetch_array($profile))
{   

  $dpsql="SELECT profile_pic FROM user2 WHERE id='$searchid' LIMIT 1";
if($dpresult=mysqli_query($conn,$dpsql))
{

  while($pic=mysqli_fetch_array($dpresult))
  {
    //storing profile pin in $s
$dp=$pic['profile_pic'];    

  }

  if($dp=="")
  {

    $dp="deafult.png";
  }
  
}

 echo '<center><div class="uk-card uk-card-default usercard" id="usercard" style="border-radius:20px">
    <div class="uk-card-header">
        <div class="uk-grid-small uk-flex-middle" uk-grid>
            <div class="uk-width-auto">
                <img class="uk-border-circle cardpic" id="cardpic"  src="profile_pictures/'.$dp.'">
            </div><br>
            <div class="uk-width-expand">
                <h3 class="uk-card-title uk-margin-remove-bottom username" id="username">'.$row2['username'].'</h3>
                <p class="uk-text-meta uk-margin-remove-top"><time datetime="2016-04-01T19:00">joined April 01, 2016</time></p>
            </div>
        </div>
    </div>';

	   echo '<div class="uk-card-body">
	       <p>USER</p>
	    </div>
    <div class="uk-card-footer">
     
    </div>
</div></center>';
echo "<br>";echo "<br>";echo "<br>";
echo "<br>";echo "<br>";echo "<br>";
}
}
}


$userid=$_SESSION['userid'];

       
    $sql="SELECT * FROM textposts WHERE userid='$searchid' ORDER BY time DESC";
        if($postresult=mysqli_query($conn,$sql))
        {
        if(mysqli_num_rows($postresult)>0)
        {
          while($row2=mysqli_fetch_array($postresult))
          {
              
              
//profile pic at every picture
            /*
            echo '<head>
  
  <style type="text/css">
    #ppic{
   background-image: url("profile_pictures/'.$dp.'");
   object-fit: contain;
   background-color:red;
   background-repeat: no-repeat;
 background-size: 100% 100%;
  }
  </style>
</head>';
*/
    echo '<form class="complainbox"><div class="modal fade " id="exampleModal'.$row2['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog "> us 
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">WHY are you reporting this id : '.$row2['id'].'</h5>
      </div>
      <div class="modal-body">
       <div class="input-group">
  <textarea class="form-control complain" id="reason'.$row2['id'].'"  placeholder="Write the reason over here" ></textarea>
</div>
      </div>
      <div class="modal-footer">
        <input type="submit" id="'.$row2['id'].'" class="btn btn-primary reportbtn" name="report" data-dismiss="modal" value="report">
        </div>
    </div>
  </div>
</div></form>';

$postid=$row2['id']; 


//comment section
echo '
<div class="modal fade " id="comments'.$row2['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content uk-background-secondary">
      <div class="modal-header">
    

        <span type="button" id="comment-close" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" id="commen-close">&times;</span>
        </span>

      </div>
      <div class="modal-body" >
       
   <div class="row" >
    <div class="col-8">
      <input type="text" class="form-control commentfield" id="commentfield-id'.$row2['id'].'" placeholder="Write here....">
    </div>
   
    <div class="col">
      <input type="button" class="btn btn-outline-success commentbutton" id="'.$row2['id'].'" value="comment">

    </div>

  </div>
  <center> <div class="comment-error'.$row2['id'].'">heyya</div></center>';
  echo '<div class="all-comments" id="all-comments'.$row2['id'].'">';
$sqlcomment="SELECT * FROM comments WHERE postid='$postid' ORDER BY time DESC";
$resultcomment=mysqli_query($conn,$sqlcomment);
if(mysqli_num_rows($resultcomment)>0)
{
  
  while($rowcomment=mysqli_fetch_array($resultcomment))
  {
      $commeid=$rowcomment['userid'];
    $commentdp="SELECT id,profile_pic FROM user2 WHERE id='$commeid'";
    if($result_comment_dp=mysqli_query($conn,$commentdp))
    {

      while($comment_dp=mysqli_fetch_array($result_comment_dp))
      {
        $comme_dp=$comment_dp['profile_pic'];
        $user_id_to_jump=$comment_dp['id'];
      }


    }
    
    if($comme_dp=="")
    {
      $comme_dp="deafult.png";
    }
     echo '
     <div class="comment-body" id="commentid'.$rowcomment['id'].'">
     <article class="alert alert-info uk-comment ">
    <header class="uk-comment-header">
        <div class="uk-grid-medium uk-flex-middle" uk-grid>
            <div class="uk-width-expand">
                <h4 class="uk-comment-title uk-margin-remove comment-username"> <img class="uk-border-circle commentpic" id="comment-pic" src="profile_pictures/'.$comme_dp.'" style="margin-right:5px;" ><a class="uk-link-reset" id="commented-name" href="image.php?request_number='.$user_id_to_jump.'">'.$rowcomment['username'].'</a></h4>
                <ul class="text-dark uk-comment-meta uk-subnav  uk-margin-remove-top">
                    <li><span class="comment-time" id="comment-time">'.time_since(time()-strtotime($rowcomment['time'])).'</span></li>';
                    if($rowcomment['userid']==$_SESSION['userid'])
                    {
                      echo'<li ><a class="text-danger delete-comment" id="'.$rowcomment['id'].'" >DELETE</a></li>';
                    }
                    
                echo '</ul>
            </div>
        </div>
    </header>
    <div class="uk-comment-body">
        <p class="comment-message">'.nl2br($rowcomment['message']).'</p>
    </div>

</article>
</div>'; 
  }

}
else
{
  echo '<center><div class="alert alert-warning no-comments" role="alert" style="margin-top:15px">NO COMMENTS YET</div></center>';
}

      echo '</div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-secondary" data-dismiss="modal">Close</a>
        
      </div>
    </div>
  </div>
</div>';

//comments modal upto here

     echo '
        <center>
<div class="shadow-lg p-3 mb-5 bg-white rounded uk-container-small card text-center " id="postid'.$postid.'" style="margin-top:50px">

  <div class="card-header">

<div class="container">
  <div class="row">
   <li class="media">
    
    <img class="uk-border-circle " id="displaypic" src="profile_pictures/'.$dp.'" class="mr-3" alt="..." style="max-height:100px;max-width:100px">

<div class="col-md-auto">
    <div class="media-body">';
if($row2['userid']==$userid)

{
echo '<a href="myprofile.php"><h4 class="mt-0" id="username" style="margin-top: 5px">'.$row2['usrname'].'</h4></a>';  
}
else
{
echo '<a href="image.php?request_number='.$row2['userid'].'"><h4 class="mt-0" id="username" style="margin-top: 5px">'.$row2['usrname'].'</h4></a>';
}

      
echo'</div>
</div>      
  </li>
    
    <div class="col" align="right">
      <a href="" class="badge badge-danger reportss" id="'.$postid.' reportss" data-toggle="modal" data-target="#exampleModal'.$row2['id'].'" align="Left">Report</a>
    </div>
  </div>
 
</div>
  </div>
  <div class="card-body">

      <div class="row">
    <div class="col">
    </div>
    <div class="col-9">
  <h4 class="text-dark uk-text-capitalize uk-heading-line uk-text-center title"><span>'.$row2['post_title'].'</span></h6>
    </div>
    <div class="col" >
      <span class="badge badge-warning uk-align-right" id="timespan">'.time_since(time()-strtotime($row2['time'])).' ago</span>
    </div>
  </div>';

if($row2['type']=="text")
{
   echo '<p class="font-weight-bold card-text textpost" align="'.$row2['align'].'">';
    echo nl2br($row2['post_content']);


    echo '</p>';

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


  echo '<img src="images/'.$row2['post_content'].'"  id="imgpost" class="h-70 p-1 img-fluid textpost" alt="Responsive image" style="max-height:600px;width:auto">';
}
 
    
 echo '</div>
  <div class="card-footer text-muted">';
$likesql="SELECT * FROM likes WHERE userid=$userid AND postid=$postid " ;
    $likeresult=mysqli_query($conn,$likesql);
if(mysqli_num_rows($likeresult)>0)
{
echo '<div class="uk-align-left">

<button type="button"  class="unlike" id="'.$postid.'">unlike</button><span class="badge badge-pill badge-danger btn btn-danger dropdown-toggle '.$row2['id'].'" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left:5px"> <b>'.$row2['likes'].'</b></span>';


echo ' <div class="dropdown-menu uk-overflow-auto uk-height-small" aria-labelledby="dropdownMenuButton" style="max-height:100px">';
echo ' <center> <h6 class="dropdown-header">Likes</h6></center>';

//getting people who liked
$like="SELECT userid FROM likes where postid='$postid'";
$likeret=mysqli_query($conn,$like);
if(mysqli_num_rows($likeret)>0)
{
while($likerow=mysqli_fetch_array($likeret))
{
  $i=$likerow['userid'];
  $name="SELECT username,profile_pic FROM user2 where id='$i'";
  $nameresult=mysqli_query($conn,$name);
  while($namerow=mysqli_fetch_array($nameresult))
  {
   $likepic=$namerow['profile_pic'];
   if($likepic=="")
   {
    $likepic="deafult.png";
   }

  echo '<a class="dropdown-item" href="image.php?request_number='.$i.'"><img class="uk-border-circle likepic" style="margin-right:5px" id="likepic" src="profile_pictures/'.$likepic.'" ><span class="likeusername">'.$namerow['username'].'</span></a>';
  }


}


}

else
{
  echo '<center><a class="dropdown-item" href="">No Likes Yet</a></center>';
}

echo '</div>';
  echo '</div>';
 $comm="SELECT * FROM comments WHERE postid='$postid'";
  if($commresult=mysqli_query($conn,$comm))
  {
  $comments_number=mysqli_num_rows($commresult);
  if($comments_number>0)
  {
     echo '<div class="uk-align-right">
         <a data-toggle="modal" data-target="#comments'.$row2['id'].'" ><h4 class="totalcomments" ><b>'.$comments_number.' comment</b></h4></a>

     </div>';
  }
  else
  {
    echo '<div class="uk-align-right">
 <a  data-toggle="modal" data-target="#comments'.$row2['id'].'" ><h4 class="totalcomments"><b>comment+</b></h4></a>
    </div>';
  }

  }

}

else
{

echo '<div class="uk-align-left"><button type="button"   class="like" id='.$postid.'>like</button><span class="badge badge-pill badge-danger btn btn-danger dropdown-toggle '.$row2['id'].'" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-left:5px"> <b>'.$row2['likes'].'</b></span>';
echo ' <div class="dropdown-menu uk-overflow-auto uk-height-small" aria-labelledby="dropdownMenuButton" style="max-height:100px">';
echo ' <center> <h6 class="dropdown-header">Likes</h6></center>';
//getting people who liked
$like="SELECT userid FROM likes where postid='$postid'";
$likeret=mysqli_query($conn,$like);
if(mysqli_num_rows($likeret)>0)
{

  while($likerow=mysqli_fetch_array($likeret))
{
  $i=$likerow['userid'];
  $name="SELECT username,profile_pic FROM user2 where id='$i'";
  $nameresult=mysqli_query($conn,$name);
  while($namerow=mysqli_fetch_array($nameresult))
  {
    $likepic=$namerow['profile_pic'];
   if($likepic=="")
   {
    $likepic="deafult.png";
   }

  echo '<a class="dropdown-item" href="image.php?request_number='.$i.'"><img id="likepic" class="uk-border-circle" src="profile_pictures/'.$likepic.'" ><span class="likeusername">'.$namerow['username'].'</span></a>';
  }


}
}

else
{

   echo '<center><a class="dropdown-item" href="">No likes Yet</a></center>';
}


echo '</div>';
  echo '</div>';
  $comm="SELECT * FROM comments WHERE postid='$postid'";
  if($commresult=mysqli_query($conn,$comm))
  {
  $comments_number=mysqli_num_rows($commresult);
  if($comments_number>0)
  {
     echo '<div class="uk-align-right">
    <a  data-toggle="modal" data-target="#comments'.$row2['id'].'" ><h4 class="totalcomments"><b>'.$comments_number.' comment</b></h4></a>

     </div>';
  }
  else
  {
    echo '<div class="uk-align-right">
 <a class="totalcomments" data-toggle="modal" data-target="#comments'.$row2['id'].'" ><h4 class="totalcomments"><b>comment+</b></h4></a>
    </div>';
  }

  }

}



echo' </div>
</div>
</center>';
 
  
   
   


          }
echo '<div class=" container-fluid " style="height: 30px;position: relative;bottom: -80px;margin-bottom:100px "></div>';  
echo ' <div class="container-fluid uk-background-secondary"><div class=" container " style="height: 100px;background-color:;position: relative;bottom:0px;margin-top:30px;">
 <center>
 <div class="row row-cols-3 links">
      <div class="col"><a href="about.php"  target="_blank" class="text-white">About</a></div>
      <div class="col"><a href="privacy.php"  target="_blank" class="text-white">Privacy</a></div>  
      <div class="col"><a href="contact.php" target="_blank" class="text-white">Contact</a></div>

</div>
<br>
<div class="row-cols-1">
<div class="col"><b><h4 class="text-white">A <span class="badge badge-secondary" style="font-family:Shadows Into Light">deaDshot </span> production </h4></b></div>
  </div>

</center>
</div></div>';


        }
    else

    {
     
  echo '<center><h1><span class="badge  badge-danger  badge-secondary" style="position:relative;margin-top:100px;">NO POSTS YET</span></h1></center>';
  echo '<div class="container-fluid  uk-background-secondary" style="height:100px;margin-top:90px">
  <div class="container">
   <center>
 <div class="row row-cols-3 links">
      <div class="col"><a href="about.php"  target="_blank" class="text-white">About</a></div>
      <div class="col"><a href="privacy.php"  target="_blank" class="text-white">Privacy</a></div>  
      <div class="col"><a href="contact.php" target="_blank" class="text-white">Contact</a></div>

</div>
<br>
<div class="row-cols-1">
<div class="col"><b><h4 class="text-white">A <span class="badge badge-secondary" style="font-family:Shadows Into Light">deaDshot </span> production </h4></b></div>
  </div>

</center>
</div>
  </div>';
  echo '<head><style> body{overflow-y:}</style></head>';  

    }
          
         
        }





?>

 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
     <link href='https://fonts.googleapis.com/css?family=Shadows Into Light' rel='stylesheet'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
      <link rel="stylesheet" href="css/uikit.min.css"/>
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>

</body>
</html>


<script type="text/javascript">
  
$('button').click(function(){
var postid=$(this).attr('id');
var clas=$(this).attr('class');
//if it is unliked then like it
if(clas=="like")
{
$(this).addClass('unlike').removeClass('like');
$(this).html('unlike');

 $.ajax({
        url:'actions.php',
        type:'post',
        async:false,
        data:{
            'liked':1,
            'postid':postid,
            
            

        },
        success:function(data,status){
          
          $('.'+postid).html(data);
        


        }
  });

}
else
    {
      //if it is liked then unlike it
  var postid=$(this).attr('id');
 $(this).addClass('like').removeClass('unlike');
 $(this).html('like');

 $.ajax({
        url:'actions.php',
        type:'post',
        async:false,
        data:{
            'unlike':1,
            'postid':postid,      


        },
        success:function(data,status){
        
          $('.'+postid).html(data);
          
        }

        });
  }

});


   $(".reportbtn").click(function(){

var postid=$(this).attr('id');
var s=$('#reason'+postid).val();
if(s=="")
{
UIkit.notification({message: 'An error occured,could not file report', status: 'danger'})
}
else
{

$.ajax({
        url:'actions.php',
        type:'post',
        async:false,
        data:{
            'report':1,
            'postid':postid,      
            'reason':s
        },
        success:function(data,status){
         UIkit.notification({message: '<span uk-icon=\'icon: check\'></span>your report has been filed,we will take action soon',status: 'success'})
          
        }

        });  
}


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
$(".commentbutton").click(function(){
var postid=$(this).attr("id");
var message=$("#commentfield-id"+postid).val();

if(message=="")
{
  $(".comment-error"+postid).html('<div class="alert alert-danger imgerror" role="alert" style="margin-top:5px;" >field should not be empty</div>');

}
else
{
  $.ajax({
        url:'actions.php',
        type:'post',
        async:false,
        data:{
           'comment':1,
            'message':message,
           'postid':postid
          
        },
        success:function(data,status){
      $("#all-comments"+postid).html(data);
      $('.comment-error'+postid).html('');
      $("#commentfield-id"+postid).val('');
          
             }

        });

}

});

$(".totalcomments").click(function(){
var s=$(this).attr("id");
 $(".comment-error"+s).html('');
});


$(".delete-comment").click(function(){

 var id=$(this).attr("id");

  $("#commentid"+id).html('<div class="alert alert-danger namedanger" role="alert" style >Deleted</div>');

    $.ajax({
        url:'actions.php',
        type:'post',
        async:false,
        data:{
           'delete_comment':1,
            'id':id,
                   
        },
        success:function(data,status){
    
     
        }

        });
});
 

    </script>