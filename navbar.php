<?php
session_start();
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


if(!isset($_SESSION['userid']) && !isset($_SESSION['username']) && !isset($_SESSION['email']) && !isset($_SESSION['password']))
{

echo "<script>window.location.href='layout.php';</script>";
    exit;
}

$userid=$_SESSION['userid'];
$sql="SELECT profile_pic FROM user2 WHERE id='$userid' ";
if($result=mysqli_query($conn,$sql))
{
while($row=mysqli_fetch_array($result))
{


    $dp=$row['profile_pic'];
    if($dp=="")
{

    $dp="deafult.png";

}

}


}
else
{

    echo mysqli_error($conn);
}





?>

<head>
    
    <style>
        
        @media (max-width: 575.98px) {
            .logo{
                max-height:30px;
                max-width:30px;
            }
            
            #navpic{
                max-height:130px;
            }
          #searchinput{
        width:200px;
        height:30px;
    }
    #submitsearch{
    height:32px;
       
    }
    #searches{
        max-width:100px;
    }
        }
        .navpic{
            
            max-height:250px;
        }
        
        
    </style>
</head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">




 <nav class="uk-navbar-container fixed-top" style="background-color:#222229;max-height: 100px" uk-sticky="animation: top"  uk-navbar >

    <div class="uk-navbar-left" style="margin-right:20px;">   

        <ul class="uk-navbar-nav">
            
            <li>
                   <a href="#offcanvas-slide"  id="menu" class="text-white uk-button uk-button-default" uk-toggle ><span id="menuicon" uk-icon="menu" ></span></a>
            </li>
            
        </ul>

    </div>

   

    <div class="uk-navbar-right ">
    <div class="sp" style="display:  block"> 
        <ul class=" uk-navbar-nav"  style="display:inline;">
            <form class="form-inline" method="GET" action="search.php" id="searchbar" >
            <li>
                <input class="form-control mr-sm-2" id="searchinput" type="search" name="search" placeholder="Search" aria-label="Search" >
            </li >
            <li style="margin-right: 1px"> <input class="btn btn-outline-info my-2 my-sm-0" id="submitsearch" type="submit" value="Search"></li>
        </form>
        </ul>
         <center>
      <!--  <div class="  text-white uk-overflow-auto  alert-secondary searches" data-spy="scroll" id="searches"  >heyya</div> -->
            </center>
        </div>
    </div>

</nav>

<div id="offcanvas-slide" class="uk-overlay " uk-offcanvas>
    <div class="uk-offcanvas-bar" >
   
        <ul class="uk-nav uk-nav-default" >
            <li><h3>Cadabra<img class="logo" src="https://img.icons8.com/color/48/000000/genie.png"/></h3></li>
            <img class="uk-border-circle navpic" id="navpic"  src="profile_pictures/<?php echo $dp;?>" style="margin-top: 20px; ">
            <li class="uk-active uk-nav-header" style="margin-top: 20px; "><?php  echo $_SESSION['username'];?></li>
            <li><a href="home.php" style="margin-top: 20px; " data-toggle="tooltip" data-placement="right" title="Home Page"><span class="icons">Home <span uk-icon="home"></span></a></li>
            <li><a href="myprofile.php" style="margin-top: 10px; " data-toggle="tooltip" data-placement="right" title="Your Info & Posts"><span class="icons">Myprofile <span uk-icon="user"></span></a></li>
            <li ><a href="updateinfo.php?UPDATE-INFO" style="margin-top:20px;" data-toggle="tooltip" data-placement="right" title="Update Your Details"><span class="icons">Update Info <span uk-icon="cog"></span> </a></li>
             <li><a href="toplikes.php"  style="margin-top: 20px;" data-toggle="tooltip" data-placement="right" title="TOP 10 liked posts"><span class="icons">Top-liked <span uk-icon="heart"></span></a></li>
            <li class="uk-nav-divider" style="margin-top: 20px; "></li>
            <li><a href="#" id="logout" style="margin-top: 20px;" data-toggle="tooltip" data-placement="right" title="Get Your ass Outta here"><span class="icons">Logout <span uk-icon="sign-out"></span></a></li>
           
            
        </ul>

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script type="text/javascript">
        
$("#logout").click(function(){


    $.ajax({
        url:'actions.php',
        type:'post',
        async:false,
        data:{
            'logout':1,
                


        },
        success:function(data,status)
        {
           location.reload(true);


        }

        });
});

$("#searchbar").submit(function(e)
   {
    var sp=false;
if($('#searchinput').val()=="")
{

sp=false;
  
} 
else
{
  sp=true;
}
return sp;
   });
   
  /*
   $("#searchinput").keyup(function(){
var name=$("#searchinput").val();

$.post("actions.php",{
  results:name
},function(data,status){


      $('#searches').html(data);
});


});

*/
   
    </script>
 