<?php
include('test.php');
include('navbar.php');
$servername="localhost";
$username="root";
$psswd="sherlock007#";
$dbname="test";        
$conn=mysqli_connect($servername,$username,$psswd,$dbname);
if(!$conn)
{
 echo "error in connectionsaaaa";
 echo   mysqli_error($conn);
          }

//session variables just for test          

//functions file

  //posting data





if(isset($_POST['postdata']))
{

 
  if(isset($_POST['texttitle']) && isset($_POST['textpost']) && !empty($_POST['texttitle']) && !empty($_POST['textpost']))
  {
    $texttile=$_POST['texttitle'];
    $textpost=$_POST['textpost'];
    $type="text";

    if(isset($_POST['aligns']))
    {
      $align=$_POST['aligns']; 
    }
    else
    {
      $aligns="";
    }
   
       textpost($texttile,$textpost,$type,$align);
      

  }

  if(!empty($_FILES['imagepost']) && $_FILES['imagepost']['error']==0)
  {
$allowed = array('mp4', '3gp', 'avi');
$filename = $_FILES['imagepost']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
$ext=strtolower($ext);

if (in_array($ext, $allowed)) 
{
 //   a video format
  $type="video";
 
}
else
{
 $type="image" ; 
}
  
   
   $title=$_POST['imagetitle'];
  
   imagepost($title,$_FILES['imagepost'],$type);
   
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
   
<style>


@media (max-width: 575.98px) {
    #likepic{
        max-height:20px;
        max-width:20px;
    }
    
    .totalcomments{
        font-size:90%;
    }
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
        
        font-size:80%;
    }
   span[class="badge badge-warning uk-align-right"]{
        
       font-size:40%;
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
    span[id="dropdownMenuButton"]{
        font-size:8px;
    }
    
    
    
    img[class="h-70 p-1 img-fluid textpost"]
    {
      height:auto;
       max-width:auto;
    }
    
    
   
   
     #texttitle{
         
        max-width:200px;
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
     
      
     
     #displaypic{
         
          max-height:100px;
          max-width:100px;
     }

    #textposts{
      position: relative;
      resize: none;
      
    }
    button{
      position: relative;
      right: 00px;
      top: 0px;

    }
    .two{
      margin-top:50px;
    }
   
    .time{
      position: relative;

      top:0px;
    }
   
   .postcontent{
    background-color: ;
    align-content: center; 
    }
   #seacrh{
    position: relative;
    
    width: 200px;
   }
   .complain{
    resize: none;
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
.postall{
    ;border-radius:50px; 
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
    <title>HOME</title>
    
  </head>
  
  <body class="uk-background-primary">
 
<br><br>

 <!--MODAL-->
 



<!--MODAL-->


<br>


<br>


<br>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      <link href='https://fonts.googleapis.com/css?family=Shadows Into Light' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  
     
      <link rel="stylesheet" href="css/uikit.min.css"/>
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>
    


    <div class=" container border border-dark border-bottom-0 postall" id="postall">
          <center>
      <div class="row">
        <div class="col">
         <a  class="badge badge-success mode" id="textmode" uk-toggle="target: .toggle">swtich to image mode</a> <span id="modeicon" uk-icon="image"></span>




        </div>
      </div>
    </center>

      <form method="POST" class="postform" enctype="multipart/form-data">
           <div class="toggle">
      <div class="row-fluid">
        <center>
          <div class="col-md-8" style=" position:   relative; top:  10px;padding-bottom:  5px;">
          <div class="input-group input-group-sm mb-3">
  
  <input type="text" class="form-control" id="texttitle" name="texttitle"  placeholder="title of content...">
</div>
        
        </div>
      </center>
        </div>
  <div class="row">
    <div class="col-md-auto">
        <textarea class="form-control" id="textposts" name="textpost" aria-label="With textarea" placeholder="Write Something.." rows="6" cols="180" ></textarea>
        <div class="col">
             <center>
          <div class="form-group col-md-4">
      
      <select id="inputState" name="aligns" class="form-control">
        
        <option value="left" SELECTED>Align:LEFT</option>
        <option value="center">Align:CENTER</option>
        <option value="right">Align:RIGHT</option>
      </select>
    </div>
   
        </center>  
   
           
          
      </div>
    </div>
 
  </div>
  </div>
  <div class="toggle" hidden>
  <div class="row two" style="position: relative">
      <div class="col">
        <input type="text"  id="imgtitle"  name="imagetitle" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="title of your picture">
      </div>
    <div class="col-md-9">
      <div class="input-group mb-3">

  <div class="custom-file">
    <input type="file" class="custom-file-input"  name="imagepost" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" onchange="file(this.value);">
    <label class="custom-file-label" id="choosevalue" for="inputGroupFile01">Upload</label>
  </div>
</div>
</div>  
</div> 
</div>
<center>
<div class="row 3">
  
  <div class="col-md">
<input type="submit" id="datapost" class="uk-button uk-button-secondary post" name="postdata" id="submit" style="width:  100px; border-radius: 20px;" value="post"> 
</div>

</div>
</center>
</form>
</div>
  <div class="container">
      <center>
          
          <div id="img-error"></div>
      </center>
      </div>
      
    <div class="container " style="margin-top:40px">
        <?php
        $dp_or_not="SELECT profile_pic FROM user2 WHERE id='$userid'";
       if( $dp_result=mysqli_query($conn,$dp_or_not))
       {
         $profile_o=mysqli_fetch_array($dp_result);
        if($profile_o['profile_pic']=="")
        {
            echo '<center><div class="alert alert-danger" role="alert" style="max-width">without your profile picture you wil not be recognized,click <a href="updateinfo.php" >here </a>to set one</div></center>';
        }
        
           
       }
       
        
        ?>
    </div>  
<br><br>
<!--
<div class=" container media"  style="margin-top:50px;margin-bottom:50px;">
  <div class="media-body ">
    <h5 class="mt-0">Username</h5>
    <center>
    <h6 class="card-subtitle mb-2 text-muted">Title of The content</h6>
    <div class="col" align="right">time</div>
  </center>
  <div class="container content">
   <p>this is gonna be your content</p>
  </div>
  <div class="container" align="center" style="background-color: red">
    <a href="">like</a>
  </div>
  </div>
  
</div>
</div>
-->
<?php


showPosts();


?>

  <div class=" container-fluid uk-background-secondary uk-text-bold " style=";height: 100px;position: relative;bottom: -90px;margin-top:50px; ">

<div class="container">
 <center>
 <div class="row row-cols-3 links ">
      <div class="col"><a href="about.php" target="_blank" class="text-white">About</a></div>
      <div class="col"><a href="privacy.php"  target="_blank" class="text-white">Privacy</a></div>  
      <div class="col"><a href="contact.php" target="_blank" class="text-white">Contact</a></div>

</div>
<br>
<div class="row-cols-1">
<div class="col"><b><h4 class="text-white">A <span class="badge badge-secondary" style="font-family:Shadows Into Light">deaDshot </span> production </h4></b></div>
  </div>

</center>
</div>





  </div>
<script type="text/javascript">
  window.textareaval="";
  window.imageval="";
  window.text_error="";
  window.error="";
  window.img_error="";  
  window.c=0;
  window.glag=false;
  window.img_error="";
  
     $('.mode').click(function(){

    var a=$('.mode').attr('id');
    if(a=="textmode")
    {
      $('.mode').attr("id","imagemode");
    $('.mode').html("switch to text mode");
     $("#modeicon").attr("uk-icon","file-edit");
    }
    else
    {
      $('.mode').attr("id","textmode");
      $('.mode').html("switch to image mode");
     $("#modeicon").attr("uk-icon","image");
    }
  });
  //check if file extenstion is suitable
  function file(a)
  { 
           var oFile = document.getElementById("inputGroupFile01").files[0];
           var size=oFile.size;
              
            

      $("#choosevalue").html(a);
    var allowed_extensions=Array("jpg","png","gif","jpeg","mp4","avi","3gp","mkv");
    window.file_extension = a.split('.').pop().toLowerCase();
    
for(var i = 0; i<allowed_extensions.length; i++)
    {
        if(file_extension==allowed_extensions[i])
        {
            flag=true;
            img_error="";
            


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


  $("#img-error").html('<center><div class="alert alert-danger imgerror" role="alert"  ><p>' + img_error + '</p></div></center>');
}
else
{
 $("#img-error").html(""); 
}

  }


 $(".postform").submit(function(e){


if($("#textposts").val()=="" && $("#inputGroupFile01").val()=="")
{
  error="Select any field";
  $("#img-error").html('<div class="alert alert-danger imgerror" role="alert"  ><p>' +  error + '</p></div>');
   flag=false;
}




if($("#inputGroupFile01").val()!="")
{
  if($("#imgtitle").val()=="")
  {
      error="Title cannot be empty";
 $("#img-error").html('<center><div class="alert alert-danger imgerror" role="alert"  ><p>' +  error + '</p></div></center>');
   flag=false;
  }
}
error="enter title of the images"


if($("#textposts").val()!="")

    {
    if($("#texttitle").val()=="")
      {
        error="Title cannot be empty";
        $("#img-error").html('<center><div class="alert alert-danger imgerror" role="alert"  ><p>' +  error + '</p></div></center>');
        flag=false;
      }
}

if(($("#textposts").val()!="" && $("#texttitle").val()!="") || ($("#inputGroupFile01").val()!="" && $("#imgtitle").val()!=""))
{
  if(img_error=="" && error==""){

  flag=true;
  }
  
}

return flag;
 });




   $("#searchbar").submit(function(e)
   {
    var sp=false;
if($('#searchinput').val()=="")
{

sp=false;
  alert('empty');
} 
else
{
  sp=true;
}
return sp;
   });
</script>
  </body>
</html>



       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

<!-- inserting likes -->
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
