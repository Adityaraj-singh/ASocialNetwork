<?php



function otp($mail) {
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    $randomString=strtoupper($randomString);
    
     

    $subject = "OTP IS : ".$randomString;

    $body = "I think you're great!";

    $headers = "From: mail@champa.com";

    if (mail($mail, $subject, $body, $headers)) {
        
        echo "The email was sent successfully"."<br>";
        
    } else {
        
        echo "The email could not be sent.";
        
    }
    
    
    
    return $randomString;
}

if(isset($_POST['go']))
{
    $s=$_POST['email'];
    echo $s;
    echo "<br>";
    $a=otp($s);
    echo $a;
}
?>
<center><br><br>
<form  method="POST">
<input type="text" name="email">
<input type="submit" name="go">
</form>
</center>