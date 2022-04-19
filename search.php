<html>
<head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        
           @media (max-width: 768px) { 
            
            #username{
                font-size:15px;
            }
            
            #userpic{
                max-height:30px;
                max-width:30px;
            }
            #userheading{
                font-size:70%;
            }
            #uppertile{
                font-size:100%;
            }
            #post-number{
                font-size:50%;
            }
            #end{
                font-size:100%;
            }
            
           }
        
        
    </style>
</head>
<body class="uk-background-primary">
<?php

include('test.php');
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
echo '<center><div class="uk-tile uk-tile-secondary  " ><h1 class="uppertile" id="uppertile">Relevant results for your search : <u>'.$_GET['search'].'</u></h1></div></center>';

$s=$_GET['search'];
$sql="SELECT id,username,profile_pic FROM user2 WHERE username LIKE '%$s%'";
if($result=mysqli_query($conn,$sql))
{	

	echo '<div class="container-fluid resultall" style="background-color:;position:relative;top:40px;min-height:300px">';
if(mysqli_num_rows($result)>0)
{

 echo'<center><h3><span class="uk-heading-small badge badge-info heading userheading" id="userheading">Users</span></h3></center>';

	while($row=mysqli_fetch_array($result))
	{
//dp at every result
		$postuserid=$row['id'];
		
		$number_of_post="SELECT id FROM textposts WHERE userid='$postuserid'";
		if($ro=mysqli_query($conn,$number_of_post))
		{
			$post_number_value=mysqli_num_rows($ro);

		}
						
						$picsql="SELECT profile_pic FROM user2 WHERE id='$postuserid' LIMIT 1";
				if($picresult=mysqli_query($conn,$picsql))
				{

				  while($picrow=mysqli_fetch_array($picresult))
				  {

				    $dp=$picrow['profile_pic'];

				  }

				}

if($dp=="")
{
	$dp="deafult.png";
}


		echo '<div class="container" style="margin-top:20px;"> 



		<div class="media uk-background-default" style="padding:30 30 30 30;border-radius:10px;">
  <img class="uk-border-circle align-self-end  userpic" id="userpic" src="profile_pictures/'.$dp.'" style="max-height:100px;width:90px;" >
  <div class="media-body" style="margin-left:20">
                   <a  href="image.php?request_number='.$row['id'].'"><h3 class="mt-1 uk-card-title uk-margin-remove-bottom uk-align-left  username" id="username">'.$row['username'].'</h3></a>
      
    
  </div>
  <span class="uk-badge post-number" id="post-number">'.$post_number_value.' posts</span>
</div>



		</div>

		';
	}


	echo '<center><div class="container badge badge-warning" style="margin-top:50px">end of result</div></center>';
	
	}


	else
	{


		echo '<center><div class="alert alert-warning" style="position:relative;top:200px" role="alert"><h1>No User Found</h1></div></center>';
	}

	echo '</div>';
}




else
{
	echo mysqli_error($conn);
}



?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="css/uikit.min.css"/>
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>

    

</body>
<footer>
	  <div class=" container-fluid uk-background-secondary uk-text-bold " style=";height: 100px;position: relative;bottom: -90px;margin-top:300px; ">

<div class="container">
 <center>
 <div class="row row-cols-4 links ">
      <div class="col"><a href="" class="text-white">About</a></div>
      <div class="col"><a href="" class="text-white">Privacy</a></div>  
      <div class="col"><a href="" class="text-white">Terms</a></div> 
      <div class="col"><a href="" class="text-white">Contact</a></div>

</div>
<br>
<div class="row-cols-1">
<div class="col"><b><h4 class="text-white">A <span class="badge badge-secondary">deaDshot </span> production </h4></b></div>
  </div>

</center>
</div>
</footer>
    </html>
