<?php
include('test.php');
session_start();
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


if(isset($_POST['report']))
{

	$postid=$_POST['postid'];
	$userid=$_SESSION['userid'];
	$reason=$_POST['reason'];
	
	$sql="INSERT INTO reports(postid,userid,reason) values('$postid','$userid','$reason')";
	if(mysqli_query($conn,$sql))
	{
		echo "inserted";
	}

	echo $postid."<br>";
	echo $_SESSION['userid'];
}


if(isset($_POST['liked']))
  {
    $userid=$_SESSION['userid'];
    $postid=$_POST['postid'];
    $sql="SELECT * FROM textposts WHERE id='$postid'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    $n=$row['likes'];
    $n=$n+1;
    $sql="UPDATE textposts SET likes='$n' WHERE id='$postid'";
    mysqli_query($conn,$sql);
   $sql="INSERT INTO likes(userid,postid) VALUES('$userid','$postid')";
   mysqli_query($conn,$sql);
   $sql="SELECT likes FROM textposts WHERE id='$postid'";

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
   echo $row['likes'];  
  }
//if user clicks unlike button
  if(isset($_POST['unlike']))
  {
    $userid=$_SESSION['userid'];
    $postid=$_POST['postid'];
    $sql="SELECT * FROM textposts WHERE id='$postid'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);	
    $n=$row['likes'];
    $n=$n-1;
    $sql="UPDATE textposts SET likes='$n' WHERE id='$postid' ";
    mysqli_query($conn,$sql);
  	 $sql="DELETE FROM likes WHERE postid='$postid'  AND userid='$userid'";
   	mysqli_query($conn,$sql);
   	   $sql="SELECT likes FROM textposts WHERE id='$postid'";

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
echo $row['likes'];
     
  }


if(isset($_POST['delete']))
{
	$postid=$_POST['postid'];
	$delete="SELECT * FROM textposts WHERE id='$postid'";
	if($delresult=mysqli_query($conn,$delete))
	{

		while($rowdel=mysqli_fetch_array($delresult))
		{
			if($rowdel['type']=="image")
			{


				$file="images/".$rowdel['post_content'];

			}
		if($rowdel['type']=="video" )
			{


				$file="images/".$rowdel['post_content'];
				echo $file;

			}

	}
	$sql="DELETE  FROM  textposts WHERE id='$postid' ";

	if(mysqli_query($conn,$sql))
	{

		if(unlink($file))
		{

			echo "all deleted";
		}
		else
		{
			echo "couldn not dlete file";
		}

	}	
$sql="DELETE FROM likes WHERE postid='$postid' ";
if(mysqli_query($conn,$sql))
{

   $comment_del="DELETE FROM comments WHERE postid='$postid'";
   if(mysqli_query($conn,$comment_del))
   {
       
   }
}

}
}

//at updateinf.php
if(isset($_POST['checkemail']))
{

$email=$_POST['email'];

$sql="SELECT * FROM user2 WHERE email='$email' ";
if($result=mysqli_query($conn,$sql))
{

	if(mysqli_num_rows($result)>0)
	{
		echo "1";

	}
}


}

//at update page
if(isset($_POST['verifypass']))
{
$userid=$_SESSION['userid'];
$currentpassword=$_POST['currentpassword'];
$currentpassword=md5(md5($userid).$currentpassword);

	$sql="SELECT password FROM user2 WHERE id='$userid' LIMIT 1";
	if($result=mysqli_query($conn,$sql))
	{	
		$row=mysqli_fetch_array($result);
		if($row['password']==$currentpassword)
		{

			echo "1";
		}
		else
		{
			echo "0";
		}
		
	}
}
//at login form
if(isset($_POST['logincheck']))
{
$email=$_POST['email'];
$password=$_POST['password'];

$sql="SELECT * FROM user2 WHERE email='$email' ";
if($result=mysqli_query($conn,$sql))	
{
	if(mysqli_num_rows($result)>0)
	{
		
		while($row=mysqli_fetch_array($result))
		{
			$id=$row['id'];
			}
			$password=md5(md5($id).$password);
			$sql2="SELECT * FROM user2 WHERE password='$password' ";


			if($result2=mysqli_query($conn,$sql2))
			{


				if(mysqli_num_rows($result2)>0)
				{
					echo "valid";
				}
				else
				{
					echo "not valid";
				}
			}


		


	}
	else
	{

		echo "invaid email";
	}

}

}


//at updateinfo
if(isset($_POST['emailverify']))
{

	$em=$_POST['email'];

	$sql="SELECT * FROM user2 WHERE email='$em' ";
	if($result=mysqli_query($conn,$sql))
	{

		if(mysqli_num_rows($result)>0)
		{
			echo "found";
		}
		else
		{

			echo "notfound";
		}

	}

}


if(isset($_POST['logout']))
{


	unset($_SESSION['username']);
	unset($_SESSION['password']);
	unset($_SESSION['email']);
	unset($_SESSION['userid']);

}

//at signup
if(isset($_POST['checkemail2']))
{

$email=$_POST['email'];
	$sql="SELECT * FROM user2 WHERE email='$email' ";
	if($result=mysqli_query($conn,$sql))
	{

		if(mysqli_num_rows($result)>0)
		{
			echo "already";
		}
		else

		{
			echo "unique";
		}
	}
	else
	{
		echo mysqli_error($conn);
	}
}
// at search page
if(isset($_POST['results']))
{
	$name=$_POST['results'];

	if(!empty($name))
	{


	$sql="SELECT id,username,profile_pic FROM user2 WHERE username LIKE '%$name%' ";
	if($result=mysqli_query($conn,$sql))
	{
		if(mysqli_num_rows($result)>0)
		{


		while($row=mysqli_fetch_array($result))
		{
				$dp=$row['profile_pic'];
				if($dp=="")
				{
					$dp="deafult.png";
				}

			echo '<div class="media searcheduser " id="searcheduser" style="margin-top:20px">
  <img src="profile_pictures/'.$dp.'" class="uk-border-circle align-self-start mr-3 search-dp" id="search-dp" alt="...">

    <a href="image.php?request_number='.$row['id'].'"><h5 class="uk-text-bolder mt-0 media-heading " >'.$row['username'].'</h5></a>

</div><hr>';
		}


	}

	else
	{
		echo '<div class="alert alert-danger searchalert" id="searchalert" role="alert"   >No similar result</div>';
	}
}

	}

	
}

if(isset($_POST['sendotp']))
{
	$email=$_POST['email'];
	echo otp($email);

}

if(isset($_POST['comment']))
{
	$userid=$_SESSION['userid'];
	$message=$_POST['message'];
	$message=mysqli_real_escape_string($conn,$message);
	$postid=$_POST['postid'];
	$username=$_SESSION['username'];

	$sql="INSERT INTO comments(userid,username,postid,message) VALUES('$userid','$username','$postid','$message')";
	if($result=mysqli_query($conn,$sql))
	{
	
	$lastid = mysqli_insert_id($conn);
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
     <div class="comment-body" id="commentid'.$rowcomment['id'].'" style="margin-top:10px;">
     <article class="alert alert-info uk-comment ">
    <header class="uk-comment-header">

        <div class="uk-grid-medium uk-flex-middle" uk-grid>
            <div class="uk-width-expand">
                <h4 class="uk-comment-title uk-margin-remove comment-username">  <img class="uk-border-circle commentpic" id="comment-pic" src="profile_pictures/'.$comme_dp.'" style="margin-right:5px;" ><a class="uk-link-reset" id="commented-name" href="image.php?request_number='.$user_id_to_jump.'">'.$rowcomment['username'].'</a></h4>
                <ul class="text-dark uk-comment-meta uk-subnav  uk-margin-remove-top">
                    <li>'.time_since(time()-strtotime($rowcomment['time'])).'</li>';
                    if($rowcomment['userid']==$_SESSION['userid'])
                    {
                      echo'<li><a class="text-danger delete-comment" id="'.$rowcomment['id'].'" >DELETE</a></li>';
                     
                    }
                    
                echo '</ul>
            </div>
        </div>
    </header>
    <div class="uk-comment-body">
        <p>'.nl2br($rowcomment['message']).'</p>
    </div>

</article>
</div>'; 
  }
	}
}

}

if(isset($_POST['delete_comment']))
{

	$comment_id=$_POST['id'];
	$sql="DELETE FROM comments WHERE id='$comment_id'";
	if(mysqli_query($conn,$sql))
	{
		echo 'deleted';
	}
}

?>