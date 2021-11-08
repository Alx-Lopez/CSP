<?php
$host = "localhost";
$username = "root";
$passwd = "COSC4343";
$dbname = "userAccount";
$conn =mysqli_connect($host,$username,$passwd,$dbname) or die('Error connecting to MySQL server.');
$message="";
if(count($_POST)>0) {
    $result = mysqli_query($conn,"SELECT * FROM UserAccounts WHERE username='" . $_POST["userName"] . "' and password = SHA1('". $_POST["password"]."')");
    $count  = mysqli_num_rows($result);
    if($count==0) {
        $message = "Invalid Username or Password!";
    } else {
        $row=mysqli_fetch_array($result);
        if($row['clearance'] =='T'){
            header("Location: http://104.131.110.71/TopSecret.html");
        }
        if($row['clearance'] =='S'){
            header("Location: http://104.131.110.71/Secret.html");
        }
        if($row['clearance'] =='C'){
            header("Location: http://104.131.110.71/Classified.html");
        }
        if($row['clearance'] =='U'){
            header("Location: http://104.131.110.71/Unclassified.html");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>HW4</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<form name="frmUser" method="post" action="" onsubmit="return checkform(this)">

    <div>Enter Login Details</div>

    <input type="text" name="userName" placeholder="User Name"  class="login-input">

    <input type="password" name="password" placeholder="Password"  class="login-input">


    <input type="submit" name="submit" value="Submit" class="btnSubmit">

    </tr>
    </table>
    <div class="message"><?php if($message!="") { echo $message; } ?></div>
    <!-- START CAPTCHA -->
    <br>
    <div class="capbox">
        <div>Captcha</div>
        <div id="CaptchaDiv"></div>

        <div class="capbox-inner">
            Type the number:<br>

            <input type="hidden" id="txtCaptcha">
            <input type="text" name="CaptchaInput" id="CaptchaInput" size="15"><br>

        </div>
    </div>
    <br><br>
    <!-- END CAPTCHA -->
</form>
</body>
</html>
<script type="text/javascript">

    // Captcha Script

    function checkform(theform){
        var why = "";

        if(theform.CaptchaInput.value == ""){
            why += "- Please Enter CAPTCHA Code.\n";
        }
        if(theform.CaptchaInput.value != ""){
            if(ValidCaptcha(theform.CaptchaInput.value) == false){
                why += "- The CAPTCHA Code Does Not Match.\n";
            }
        }
        if(why != ""){
            alert(why);
            return false;
        }
    }

    var a = Math.ceil(Math.random() * 9)+ '';
    var b = Math.ceil(Math.random() * 9)+ '';
    var c = Math.ceil(Math.random() * 9)+ '';
    var d = Math.ceil(Math.random() * 9)+ '';
    var e = Math.ceil(Math.random() * 9)+ '';

    var code = a + b + c + d + e;
    document.getElementById("txtCaptcha").value = code;
    document.getElementById("CaptchaDiv").innerHTML = code;

    // Validate input against the generated number
    function ValidCaptcha(){
        var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
        var str2 = removeSpaces(document.getElementById('CaptchaInput').value);
        if (str1 == str2){
            return true;
        }else{
            return false;
        }
    }

    // Remove the spaces from the entered and generated code
    function removeSpaces(string){
        return string.split(' ').join('');
    }
</script>

