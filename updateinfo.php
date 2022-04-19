
<?php
include('navbar.php');
include('test.php');


$error="";
$perror="";
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

//displaying pic of logged user
$userid=$_SESSION['userid'];
$sql="SELECT profile_pic FROM user2 WHERE id='$userid' limit 1";

if($result=mysqli_query($conn,$sql))
{

while($row=mysqli_fetch_array($result))
{
$dp=$row['profile_pic'];
}

}

if($dp=="")
{

  $dp="deafult.png";
}


//submiting form
if(isset($_POST['save']))
{
$newname=$_POST['newname'];
$newmail=$_POST['newemail'];
$currentpas=$_POST['currentpassword'];
$newpas=$_POST['newpassword'];
$newname=mysqli_real_escape_string($conn,$newname);
$newmail=mysqli_real_escape_string($conn,$newmail);
$currentpas=mysqli_real_escape_string($conn,$currentpas);
$newpas=mysqli_real_escape_string($conn,$newpas);

if($_POST['newemail']!="")
{


$sql="UPDATE user2 SET email='$newmail' WHERE id='$userid'";
if(mysqli_query($conn,$sql))
{

$_SESSION['email']=$newmail;
}


}


if($newname!="")
{
  $sql="UPDATE user2 SET username='$newname' WHERE id='$userid' ";
  if(mysqli_query($conn,$sql))
  {
    $sql="UPDATE textposts SET usrname='$newname' WHERE userid='$userid' ";
    mysqli_query($conn,$sql);
    $_SESSION['username']=$newname;

  }

}

if($_POST['newpassword']!="")
{

 
   $newpas=md5(md5($userid).$newpas);

   
    $sql="UPDATE user2 SET password='$newpas' WHERE id='$userid'";
    if(mysqli_query($conn,$sql))
    {
      echo "changed";
      $_SESSION['password']=$newpas;
    }
    else
    {
      echo mysqli_error($conn);
    }
  
  


}


}

if(!empty($_FILES['displaypicture']) && $_FILES['displaypicture']['error']==0)
{
  $filename=$_FILES['displaypicture']['name'];
  $filetmpname=$_FILES['displaypicture']['tmp_name'];
  $filesize=$_FILES['displaypicture']['size'];
  $fileerror=$_FILES['displaypicture']['error'];
  $fileext=explode('.', $filename);
  $fileext=strtolower(end($fileext));
  $a=uniqid('',true);
  $newname=$a.".".$fileext;
  $newname=mysqli_real_escape_string($conn,$newname);
   if($fileerror==0)
  {
    $dest='profile_pictures/'.$newname;
    $s=move_uploaded_file($filetmpname, $dest);
    if($s);
    
    $sql="UPDATE user2 SET profile_pic='$newname' WHERE id='$userid'";
    if(mysqli_query($conn,$sql))
    {
     
    }
    }

}



if(isset($_POST['deleteit']))
{
$sql="DELETE FROM user2 WHERE id='$userid'";
if(mysqli_query($conn,$sql))
{
  $sql2="DELETE FROM textposts WHERE userid='$userid'";
  if(mysqli_query($conn,$sql2))
  {

    $sql3="SELECT postid FROM likes WHERE userid='$userid'";
    if($result3=mysqli_query($conn,$sql3))
    {
        while($row3=mysqli_fetch_array($result3))
        {
            
            $postid=$row3['postid'];
            $sql4="SELECT likes FROM textposts WHERE id='$postid'";
            if($result4=mysqli_query($conn,$sql4))
            {
                while($row4=mysqli_fetch_array($result4))
                {
                  $n=$row4['likes'];
                  $n=$n-1;
                  $sql5="UPDATE textposts SET likes='$n' WHERE id='$postid' ";
                  if(mysqli_query($conn,$sql5))
                  {
                                            
                  }
                }
            }
        }

     

    }
    $sql6="DELETE FROM likes WHERE userid='$userid'";
                      if(mysqli_query($conn,$sql6))
                      {
                      unset($_SESSION['username']);
                      unset($_SESSION['email']);
                      unset($_SESSION['password']);
                      unset($_SESSION['userid']);  
                      
                      }


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
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link href='https://fonts.googleapis.com/css?family=Shadows Into Light' rel='stylesheet'>
    <title>Update info</title>
    <style type="text/css">
    @media (max-width: 575.98px) {
        #edit-table{
            font-size:12px;
        }
        
        #table-heading{
            font-size:15px;
        }
        #userdp{
            max-height:100px;
            max-width:100px;
        }
    }
      .userdp{
          max-height:200px;
          max-width:200px;
      }
      .edit-table{
          
          position: relative; 
      }
      
    </style>
  </head>


  <body class="uk-background-primary">



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation:-</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <b>Do you really wanna delete your account?</b>
      </div>
      <div class="modal-footer">
        <form method="POST">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button name="deleteit" class="btn btn-primary">yes</button>
      </form> 
      </div>
    </div>
  </div>
</div>



      <center><h1><span class="badge badge-dark ">UPDATE</span></h1></center>
    <form class="update" method="POST" enctype="multipart/form-data">
    <div class="container" style="position: relative;top:0px">
      <center>

      
                  <?php

                     echo '<img class="uk-border-circle userdp" id="userdp" src="profile_pictures/'.$dp.'" >';
                ?>
                
                <a name="deleteacc" class="badge badge-danger deleteacc" id="deleteacc" data-toggle="modal" data-target="#exampleModal"> DELETE ACCOUNT</a>
                <div class="uk-margin" uk-margin>
                  
        <div class="custom-file" >
    <input type="file" class="custom-file-input"  name="displaypicture" id="displaypicture" aria-describedby="inputGroupFileAddon01" onchange="file(this.value);">
    <label class="custom-file-label choosevalue" id="choosevalue" for="inputGroupFile01">choose profile picture</label>
  </div>
     <div id="img-error" style="height: 22px;"></div>
    </div>
  </center>
            
</div>
         <div class="container">
    <table class="table table-striped uk-table-divider  text-dark edit-table" id="edit-table" >
   
      
      <thead>
        <tr class="uk-text-large" id="table-heading">
            <th>Type</th>
            
            <th>Change to</th>
            
        </tr>
    </thead>
     <tbody class="">
        <tr rowspan="2">
            <td>Fullname</td>

            <td><input class="uk-input" id="newname" name="newname" type="text" placeholder="Fullname" >
            <div id="name-error"></div></td>
        </tr>
        <tr>
            <td>Email</td>

            <td><input class="uk-input "id="newemail" name="newemail" type="email" placeholder="Email...">
              <div class="emailerror"></div>
            </td>
        </tr>
        <tr>
            <td>Password</td>

            <td> <input class="uk-input " type="password"  id="currentpassword"   name="currentpassword" placeholder="current password" ><br>
                 <input class="uk-input " type="password"  id="newpassword" name="newpassword" placeholder="new password" >
                 <input class="uk-checkbox" type="checkbox" id="showpassword" onclick="showpass()">show password
            
                <div id="passworderror"></div>
              </td>

       
        <tr>
          <td colspan="3" ><center><button type="submit" class="btn btn-outline-dark save" name="save">save changes</button></center></td>
        </tr>
    </tbody>
</table>
    
</div>

 </form>


  <div class=" container-fluid uk-section-secondary " style="height: 110px;position: relative;bottom:-40px;margin-top:0px;padding-top:20px;padding-bottom: 50px;">
      <center>
    <div class="container">
     <div class="row row-cols-4 links">
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
          function showpass()
          {

            var cp=document.getElementById('currentpassword');
            var np=document.getElementById('newpassword');
            if(cp.type=="password" && np.type=="password")
            {
              cp.type="text";
              np.type="text";
            }

            else
            {
              cp.type="password";
              np.type="password";
            }
          }
          window.flag=false;
          window.img_error="";
          function showpassword()
          {
            alert('checkboc clicked');
            var a=document.getElementById('currentpassword');
            var b=document.getElementById('newpassword');
            if(a.type=="password" && b.type=="password")
            {

              a.type="text";
              b.type="text";
            }

            else
            {

              a.type="password";
              b.type="password";
            }

          }

          function file(a)
          {

           var oFile = document.getElementById("displaypicture").files[0];
           var size=oFile.size;


            $("#choosevalue").html(a);
    var allowed_extensions=Array("jpg","png","gif","jpeg");
    window.file_extension = a.split('.').pop().toLowerCase();
    
for(var i = 0; i<allowed_extensions.length; i++)
    {
        if(file_extension==allowed_extensions[i])
        {
            flag=true;
            img_error="";
            if(size>5242880)
           {

            img_error="size should be less than 5 MB"
            flag=false;
           }
            break;
        }
        else
        {
          img_error="not valid format(only images allowed)";
          flag =false;
        }

    }


 

if(img_error!="")
{


  $("#img-error").html('<center><div class="uk-alert-danger" uk-alert><p>' + img_error + '</p></div></center>');
}
else
{
 $("#img-error").html(""); 
 flag=true;
}


}




 $("form").submit(function(e)
 {

  window.passworderror="";
          window.nameerror="";
          window.lenerror="";
//checking name errors
   var bc;
          function isValid(str)
          {
          regex=/^[a-zA-Z ]*$/;
          bc=regex.test(str);
        }

if($('#newname').val()!="")
{

if($('#newname').val().length<3)
  {

lenerror="should be greater than 3";
    $("#name-error").html('<center><div class="uk-alert-danger" uk-alert style="" ><p>' + lenerror + '</p></div></center>');
   flag=false;


}


isValid($('#newname').val());


         if(bc!=true)
         {  
          nameerror="only alphabets allowed";
          $("#name-error").html('<center><div class="uk-alert-danger" uk-alert><p>' + nameerror + '</p></div></center>');
          flag=false;
         }
         


}



if(nameerror=="" && lenerror=="")
{
 $("#name-error").html(''); 
}
//check for password error

if($('#newpassword').val()!="")
{

  if($('#currentpassword').val()=="")
  {

    passworderror="enter current password";
    $("#passworderror").html('<center><div class="uk-alert-danger" uk-alert><p>' + passworderror + '</p></div></center>');
    flag=false;
  }

}



if($('#currentpassword').val()!="")
{

if($('#newpassword').val().length<8)
{
  passworderror="length insufficient";
$("#passworderror").html('<center><div class="uk-alert-danger" uk-alert><p><b>' + passworderror + '</b></p></div></center>');
  flag=false;
}

    //check if entered password matches or not  
if(passworderror=="")
{
  var currentpassword=$('#currentpassword').val();

   $.ajax({
        url:'actions.php',
        type:'post',
        async:false,
        data:{
            'verifypass':1,
            'currentpassword':currentpassword,      


        },
        success:function(data,status)
        {
          if(data=="0")
          {
            passworderror="incorrect password";
            $("#passworderror").html('<center><div class="uk-alert-danger" uk-alert><p>' + passworderror + '</p></div></center>');
            
          }
          if(data=="1")
          {
            passworderror="";
            alert('correct password');
          }


        }

        });
}




}






if(passworderror=="")
{
$("#passworderror").html('');

}


if(passworderror=="" && lenerror=="" && nameerror=="" && img_error=="")
  {
    flag=true;
  }



if($('#newemail').val()!="")
{

  //check if entered email is already taken or not
var email=$('#newemail').val();
   $.ajax({
        url:'actions.php',
        type:'post',
        async:false,
        data:{
            'checkemail':1,
            'email':email


        },
        success:function(data,status)
        {
          if(data==1)
          {

            $('.emailerror').html('<div class="uk-alert-danger" uk-alert>'+
    '<a class="uk-alert-close" uk-close></a>'+
    '<p>email already taken</p>'+
'</div>');
              flag=false;
          }
          else
          {
            flag=true;
          }
        
          
        }

        });


}


return flag;
 });



        </script>
  </body>
</html>