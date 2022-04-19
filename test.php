<?php
use phpmailer\PHPMailer\PHPMailer;
$servername="localhost";
$username="root";
$psswd="sherlock007#";
$dbname="test";        
$conn=mysqli_connect($servername,$username,$psswd,$dbname);
if(!$conn)
{
 echo "error in connectionsaaa";
 echo   mysqli_error($conn);
          }



function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'min'),
            array(1 , 'sec')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }


function otp($mailto) {
    
    $length = 6;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $randomString=strtoupper($randomString);
    
    

   

    $name = "Cadabra";
    $email = "send@tempoo.com";
    $subject = "testing phpmailer";
    $body = "Your OTP is  : ".$randomString;

    require_once "phpmailer/PHPMailer.php";
    require_once "phpmailer/SMTP.php";
    require_once "phpmailer/Exception.php";

    $mail = new PHPMailer();
    //smtp settings
    $mail->isSMTP();
    $mail->Host = " smtp.stackmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "send@tempoo.com";
    $mail->Password = 'aditya9151';
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    //email settings
    $mail->isHTML(true);
    $mail->setFrom($email, $name);
    $mail->addAddress($mailto);
    $mail->Subject = ("$email ($subject)");
    $mail->Body = $body;

    if($mail->send()){
        $status = "success";
        $response = "Email is sent!";
    }
    else
    {
        $status = "failed";
        $response = "Something is wrong: <br>" . $mail->ErrorInfo;
    }

    
    
    
    return $randomString;
}


function checkemail($mail)
{ 


  global $error;
          global $conn;
          $mail=mysqli_real_escape_string($conn,$mail);
          
          if(!$conn)
          {
            echo "error in connection";
          echo   mysqli_error($conn);
          }

          //check if email is already registered
         $sql="SELECT * FROM user2 WHERE email='$mail'";
          if($result=mysqli_query($conn,$sql))
          {
          if(mysqli_num_rows($result)>0)
               {    $row=mysqli_fetch_array($result);
                    $error.="email already exist by:".$row['username'];
                   
                    
                    
                }
                
          }

}          
      



      function signup($name,$mail,$pass)
      {
        global $conn;
          $name=mysqli_real_escape_string($conn,$name);
          $mail=mysqli_real_escape_string($conn,$mail);
          $pass=mysqli_real_escape_string($conn,$pass);
         $sql="insert into user2(username,email,password) values('$name','$mail','$pass')";
            if(mysqli_query($conn,$sql))
            {
              session_start();
                
              
              $_SESSION['username']=$name;
              $_SESSION['email']=$mail;
            
              //declaring session id 
              $sql2="select id from user2 where email='$mail'";
              if($result2=mysqli_query($conn,$sql2))
              {
                $row2=mysqli_fetch_array($result2);
                $_SESSION['userid']=$row2['id'];
                
               $id=$_SESSION['userid'];
              }
              $encryption=md5(md5($_SESSION['userid']).$pass);
                $_SESSION['password']=$encryption;
              $sql="UPDATE user2 SET password ='$encryption' WHERE id='$id' ";
              mysqli_query($conn,$sql); 

            }


      }
// text type post

function textpost($texttitle,$textpost,$type,$align)
{


global $conn;
if(isset($_SESSION['userid']))
{


$userid=$_SESSION['userid'];
$textpost=mysqli_real_escape_string($conn,$textpost);
$name=mysqli_real_escape_string($conn,$_SESSION['username']);
$texttitle=mysqli_real_escape_string($conn,$texttitle);
$userid=mysqli_real_escape_string($conn,$userid);
$type=mysqli_real_escape_string($conn,$type);
$sql="insert into textposts(userid,usrname,post_title,type,post_content,align) values('$userid','$name','$texttitle','$type','$textpost','$align')";
if($result=mysqli_query($conn,$sql))
{

}
else
{
  echo mysqli_error($conn);

}
}


}


//image type post
function imagepost($title,&$arr,$type){
  
  global $conn;
  $userid=$_SESSION['userid'];
  $name=mysqli_real_escape_string($conn,$_SESSION['username']);
  $title=mysqli_real_escape_string($conn,$title);
  $type=mysqli_real_escape_string($conn,$type);

  $filename=$arr['name'];
  $filetmpname=$arr['tmp_name'];
  $filesize=$arr['size'];
  $fileerror=$arr['error'];
  $fileext=explode('.', $filename);
  $fileext=strtolower(end($fileext));
  $a=uniqid('',true);
  $newname=$a.".".$fileext;
  $newname=mysqli_real_escape_string($conn,$newname);
    if($fileerror==0)
  {
    $dest='images/'.$newname;
    $s=move_uploaded_file($filetmpname, $dest);
   
   
    
    $sql="insert into textposts(userid,usrname,post_title,type,post_content) values('$userid','$name','$title','$type','$newname')";
    if(mysqli_query($conn,$sql))
    {
      
    }
  } 
  




}



//showing postss

      function showPosts()
      {

       $userid=$_SESSION['userid'];
        global $conn;
       
    $sql="SELECT * FROM textposts ORDER BY time DESC";
        if($postresult=mysqli_query($conn,$sql))
        {
        if(mysqli_num_rows($postresult)>0)
        {
          while($row2=mysqli_fetch_array($postresult))
          {
            //profile picture before every post
          
$postuserid=$row2['userid'];

$picsql="SELECT profile_pic FROM user2 WHERE id='$postuserid' LIMIT 1";
if($picresult=mysqli_query($conn,$picsql))
{

  while($picrow=mysqli_fetch_array($picresult))
  {

    $dp=$picrow['profile_pic'];

  }

}
else

{
  mysqli_error($conn);
}
if($dp=="")
{

  $dp="deafult.png";
}


 

$postid=$row2['id']; 
                                  // report of the current post

echo '<form class="complainbox"><div class="modal fade" id="exampleModal'.$row2['id'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">WHY are you reporting this id :</h5>
      </div>
      <div class="modal-body">
       <div class="input-group">
  <textarea class="form-control complain" id="reason'.$row2['id'].'"  placeholder="Write the reason over here" ></textarea>
</div>
      </div>
      <div class="modal-footer">
      <input type="button" id="'.$row2['id'].'" class="btn btn-primary" data-dismiss="modal" value="close">
        <input type="submit" id="'.$row2['id'].'" class="btn btn-primary reportbtn" name="report" data-dismiss="modal" value="report">
        </div>
    </div>
  </div>
</div>
</form>';

  
//upto modal here

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
  echo '<div class="all-comments" id="all-comments'.$row2['id'].'" style="margin-top:10px">';
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
                <h4 class="uk-comment-title uk-margin-remove comment-username"> <img class="uk-border-circle commentpic" id="commentpic" src="profile_pictures/'.$comme_dp.'" style="margin-right:5px;" ><a class="uk-link-reset" id="comment-user-name" href="image.php?request_number='.$user_id_to_jump.'">'.$rowcomment['username'].'</a></h4>
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
/*
echo '<head><style>
  #ppic'.$row2['id'].'{

    background:url("profile_pictures/'.$dp.'") center center no-repeat;
    -webkit-background-size: cover;
    background-color:white
   

  }
</style>
</head>
';
*/
//individual posts


   echo '
        <center>
<div class="shadow-lg p-3 mb-5 bg-white rounded uk-container-small card text-center style="margin-top:50px ">

  <div class="card-header">

<div class="container">
  <div class="row">
   <li class="media">
    
    <img class="uk-border-circle " id="displaypic" src="profile_pictures/'.$dp.'" class="mr-3" alt="..." style="max-height:60px;max-width:60px">

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

  <video src="images/'.$row2['post_content'].'" id="video'.$row2['id'].'" class="video-post" frameborder="0" automute="false" audio="on" uk-video="autoplay: inview" ></video>
  <div class="uk-overlay uk-light uk-position-bottom">
        <a class="badge badge-info uk-align-right sound sound'.$row2['id'].'" id="soundbutton" postid="'.$row2['id'].'">mute</a>
    </div>
</div>

 ';
  
 
}
if($row2['type']=="image")
{


  echo '<img src="images/'.$row2['post_content'].'"  id="imgpost" class="h-70 p-1 img-fluid textpost" alt="Responsive image" style="max-height:500px;max-width:auto">';
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

  echo '<a class="dropdown-item" href="image.php?request_number='.$i.'"><img class="uk-border-circle likepic"style="margin-right:5px"  id="likepic" src="profile_pictures/'.$likepic.'" ><span class="likeusername">'.$namerow['username'].'</span></a>';
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
         <a data-toggle="modal" data-target="#comments'.$row2['id'].'" ><h4 id="'.$row2['id'].'" class="totalcomments" ><b>'.$comments_number.' comment</b></h4></a>

     </div>';
  }
  else
  {
    echo '<div class="uk-align-right">
 <a  data-toggle="modal"  data-target="#comments'.$row2['id'].'" ><h4 id="'.$row2['id'].'" class="totalcomments"><b>comment+</b></h4></a>
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
    <a  data-toggle="modal" data-target="#comments'.$row2['id'].'" ><h4 id="'.$row2['id'].'" class="totalcomments"><b>'.$comments_number.' comment</b></h4></a>

     </div>';
  }
  else
  {
    echo '<div class="uk-align-right">
 <a data-toggle="modal" data-target="#comments'.$row2['id'].'" ><h4  id="'.$row2['id'].'"class="totalcomments"><b>comment+</b></h4></a>
    </div>';
  }

  }

}


echo' </div>
</div>
</center>
';
 


          }
        }
          
         
        }

      }
    
?>

