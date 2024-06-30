<?php
//TASK b - create variables named usr, psw, pswErr, and usrErr and initialize them to empty values

$logErr = true;
$display = "display:none;";
$usr = "";
$psw = "";
$pswErr = "";
$usrErr = "";

//TASK c - replace "aaaa" with the proper superglobal variable to capture all the post array elements
if ($_POST  == "POST") {

  $display = "display:block;";

//TASK d - replace "bbbb" with the proper superglobal variable to capture the username field
  $usr = validate_fields("usr");  
  $pattern = "/^[a-zA-Z ]*$/";
  if (empty($usr)) {
    $usrErr = "Username is required";
    $logErr = true;
  } elseif (!preg_match($pattern,$usr)) {
     $usrErr = "Only letters allowed"; 
     $logErr = true;
  } else {
     $logErr = false;
  }
 
 
//Task e - replace "cccc" with the proper superglobal variable to capture the password field
  $psw = validate_fields("psw");
//TASK f - using the pattern above, create a new pattern to validate the password field 
$pattern = '/^(?=.*[!@#$%^&*-])(?=.*\d)(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{15,}$/';    
  if (empty($psw)) {
    $pswErr = "Password is required";
    $logErr = true;
  } elseif (!preg_match($pattern,$psw)) {
     $pswErr = "Invalid Password"; 
     $logErr = true;
  } else {
    $logErr = false; 
  }    
}

if ( !$logErr)  {
//TASK g - Issue a Session ID
session_start();    
echo "This is the Session Id ",session_id();
}


//TASK h - create a function called validate_fields() that accepts the data field checks for new lines, leading and trailing spaces, removes backslashes, and encodes HTML and return the cleaned data back
function validate_fields($data) {
    return htmlentities(trim(str_replace(array("\n", "\r", "\\"), '', $data)));
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <title>Login Form</title>
   <meta charset="utf-8">
</head>


<body>    
   <div class="container">
      <form name="loginform" id="loginform" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
      <label for="loginform">Username</label>
         <input type="text" id="usr" name="usr" required></p>
         
	     <label for="psw">Password</label>
         <input type="password" id="psw" name="psw"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[_$^!]).{15,}" title="Must contain at least one number, one special character, one uppercase and lowercase letter, and at least 15 total characters" required>
	     </p>
         <input type="submit" id="sub" name="sub" value="Log In" class="Log In" >
         
      </form>
    </div>
</body>  
<body>   
  
   </p>
   <div id="message" style="<?php echo $display; ?>">
     <?php if (!empty($usrErr)) { ?>
     <p class="invalid"><?php echo $usrErr; ?></p>
     <?php } ?>
     <?php if (!empty($pswErr)) { ?>
     <p class="invalid"><?php echo $pswErr; ?></p>
     <?php } ?>
    
     <p>Username: <?php echo $usr; ?> <?php echo $_POST["usr"]; ?> </p>
     <p>Password: <?php echo $psw; ?> <?php echo $_POST["psw"]; ?> </p>
     <p>Session ID: <?php echo session_id() ; ?> <?php  session_start(); echo "" . session_id();?> </p>  
   
      <h3>Password must contain the following:</h3>
      <p id="letter" class="invalid">A <b>Password is required</b> <br><br><br> A <b>lowercase</b> letter</p> 
      <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
      <p id="number" class="invalid">A <b>number</b></p>
	  <p id="special" class="invalid">A <b>special character</b>	  
      <p id="length" class="invalid">Minimum <b>15 characters</b></p>

   </div>


   <style>
/* Style all input fields */
input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

/* Style the submit button */
#sub {
  background-color: Blue;
  color: White;
  font-weight: bold;
}

/* Style the container for inputs */
.container {
  width: 300px;
  margin: 0 auto;
  background-color: #f1f1f1;
  padding: 20px;
  font-weight: bold;
  font-size: 25px;
}

/* The message box is shown only when the user clicks on the password field */
#message {
  display:none;
  width: 300px;
  margin: 0 auto;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 10px 35px;
  font-size: 18px;
  
}

/* Add a green text color when the requirements are right */
.valid {
  color: green;
}

/* Add a red text color when the requirements are wrong */
.invalid {
  color: red;
}
</style>

<script>
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var special = document.getElementById("special");
var length = document.getElementById("length");


// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {


  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
 }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) { 
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate special characters
  //TASK k - replace xxxx with the proper regex pattern to match the special characters
  var specialCharacters = /[_$^!]/g;
  if(myInput.value.match(specialCharacters)) { 
    special.classList.remove("invalid");
    special.classList.add("valid");
  } else {
    special.classList.remove("valid");
    special.classList.add("invalid");
  }

  // Validate length
  //TASK l = replace yyyy with the correct value to check the string length
  if(myInput.value.length >= 15) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>

</body>
</html>