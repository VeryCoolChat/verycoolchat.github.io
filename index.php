<?php
if (isset($_GET['enSubmit']) && isset($_GET['uname']) && isset($_GET['rname'])){
	echo'<meta http-equiv="refresh" content="30">';
	$room=$_GET['rname']; 
	$uname=$_GET['uname'];
	if (!is_dir($room)) mkdir($room);
	$files = scandir($room);  
	foreach ($files as $user){
		if ($user=='.' || $user=='..') continue;
		$handle=fopen("$room/$user",'r');
		$time = fread($handle, filesize("$room/$user"));
		fclose($handle);
		if ((time()-$time)>20) unlink("$room/$user"); 
	}
	$contents='';
	$filename="$room.txt";
	if (file_exists($filename)){
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		fclose($handle);	
	}
	$handle = fopen("$room/$uname", "w");
	fwrite($handle, time());
	fclose($handle);

	$files = scandir($room);
	$users='';
	foreach ($files as $user) if ($user!='.' && $user!='..') $users.=$user."\n";
	
	if (isset($_POST['Send'])){
		$text=$_POST['txt'];
		$contents.="$uname: $text";
		$handle = fopen("$filename", "a");
		fwrite($handle, "$uname: $text\n");
		fclose($handle);
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset= utf-8">

<script>

function myFunction(){
	alert("testing123");
};

</script>

</head>

<body OnLoad="document.myform.txt.focus()" style="font-family: sans-serif">
<form action="" method="post" name="myform" style="position: fixed; width:100%; height: 100%;">
<table style="width: 250px; padding: none; height: 100%;" align="right">
	<tr style="margin: 0;">
		<td style="font-family: sans-serif; border: none; color: white; font-size: 150%; margin: 0; padding: 2%; background-color: #31A4E1">
			<p><?php echo " $room Chat"?></p>
		</td>
	</tr>
	<tr style="margin: 0;">
		<td style="height: 100%;margin: 0;">
		<div id="hehe" style="height: 100%;">	<textarea readonly="readonly" id="btw" name="txtchat" style="width: 100%; color: #31A4E1; height: 100%; background-color: #EDEDED; font-family: 'times New Roman', Times, serif; font-size: 12pt;"><?php echo "Chat: \n$contents"?> </textarea></div>
		</td>
	</tr>
	<tr style="margin: 0;">
		<td style="margin: 0">
	<input id="time" contentEditable="false" id="txtt" autocomplete="off" name="txt" style="width: 100%; padding: 5%; height: 50px; color: gray; background-color: white; font-family: sans-serif; font-size: 12pt;"></textarea></td>
		<td style="border-style: solid;border-width: 1px; height: 39px;padding-left: 8px; width: 143px; text-align: center; display: none;">
		<input  id="myBtn" name="Send" style="width: 118px; height: 63px; font-size: 30pt; font-family: 'Times New Roman', Times, serif; color: #19B024;" type="submit" value="Send">
       </td>
	</tr>
</table>
</form>

<div class="pizza">

  <form method="get" action="">

    <table style="border: none;background-color: #31A4E1; width: 100%; height: 100%;" align="center">
      <thead>
      <center style="background-color: #31A4E1;"><p style="font-size:200%; font-family: sans-serif; color: white; margin:0;">Chat</p>Have an account? <a href="https://verycoolthanksforsharing.firebaseapp.com/">Sign In</a></center>
      </thead>
      <tbody>

        <tr>
          <td style="font-family: sans-serif;font-size: 17pt;text-align: left; width: 502px; color: white;"><center>Name:</center></td>
          <td style="font-family: sans-serif; font-size: 17pt; text-align: left; color: white; width: 500px;">
          <center><input id="name" maxlength="15" id="nickname" name="uname" style="font-size: medium; width: 100px; color: #31A4E1;" required></center></td>
        </tr>
        
        <tr>

          <td style="font-family: sans-serif;font-size: 17pt;text-align: left; width: 432px; color: white;">
            <center>Select:</center>
          </td>
          <td style="font-family: sans-serif; font-size: 17pt; text-align: left; color: #31A4E1; width: 100px;">
            <center>
              <select name="rname" style="width: 100%; font-size: medium; color: #31A4E1;">
                <option selected="">Website</option>
                <option>Games</option>
              </select>
            </center>
          </td>
          
        </tr>
        
        <tr>
          <td style="font-family: sans-serif;font-size: 17pt;text-align: center; color: #31A4E1; padding-top:10px;padding-bottom:10px" colspan="2">
          <input name="enSubmit" style="width: 118px;border: none;background-color: white; height: 63px; font-size: 30pt; font-family: sans-serif; color: #31A4E1" type="submit" onclick="store()" value="Enter" ></td>
        </tr>
        
        </tbody>
    </table>
  </form>

</div>


<head>
<title>Chat </title>
<link rel="icon" type="image/ico0.2ref="images/oof.png" />

<link rel="stylesheet" href="index.css">
<style>

textarea > span{
    font-style: italic;
}

</style>
</head>
<script>
el=document.myform.txtt
    if (typeof el.selectionStart == "number") {
        el.selectionStart = el.selectionEnd = el.value.length;
    } else if (typeof el.createTextRange != "undefined") {
        el.focus();
        var range = el.createTextRange();
        range.collapse(false);
        range.select();
    }</script>
 


<script>
var input = document.getElementById("txtt");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   document.getElementById("myBtn").click();
  }
});

</script>
<script>
  $("document").ready(function(){
  var interval = setInterval(refresh_box(), 1000);
  function refresh_div() {
    $("hehe").load('index.php');
  }
}) /*<= The closer ) bracket is missing in this line*/
</script>
<script>
$(document).ready(function() {

  $("#refresh").click(function() {
     $("#hehe").load("index.php");
  
	return false;
	});
});
</script>
<script>
var inputElement = document.getElementById("nickname");

persistInput(inputElement);
 
function persistInput(input)
{
  var key = "input-" + input.id;

  var storedValue = localStorage.getItem(key);

  if (storedValue)
      input.value = storedValue;

  input.addEventListener('input', function ()
  {
      localStorage.setItem(key, input.value);
  });
}
</script>

<script>
$(document).ready(function(){
    var $textarea = $('btw');
    $textarea.scrollTop($textarea[0].scrollHeight);
});
</script>



</body>
<head>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.pizza {
  position: fixed;
  top: 200;
  background-color: lightgrey;
    width: 100%
}
.w3-animate-left {
  position: fixed;
  top:0;
  left:0;
  height: 100%;
  width: 10%;
  background-color: blue;
}
.w3-animate-right {
  position: fixed;
  top:0;
  right:0;
  height: 100%;
  width: 10%;
  background-color: blue;
}
.ad1 {
position: relative;
top:300;
right: 50;
height:15%;
background-color: navy;
color: white;
}
.ad2 {
position: relative;
top:400;
right: 50;
height:15%;
background-color: navy;
color: white;
}
.a {
  bottom: 0;
  position: fixed;
  right:300;
}
.b {
  bottom: 0;
  position: fixed;
  right: 600;
}
.c {
  position: fixed;
  bottom: 10;
  left: 300;
  background-color: lightyellow;
  height: 20%;
  width: 40%
}
.classy {
  width: 100px;
  height: 50px;
  background-color: red;
  font-weight: bold;
  position: relative;
  -webkit-animation: mymove 5s infinite; /* Safari 4.0 - 8.0 */
  animation: mymove 5s infinite;
}

/* Safari 4.0 - 8.0 */
#div1 {-webkit-animation-timing-function: linear;}
#div2 {-webkit-animation-timing-function: ease;}



/* Standard syntax */
#div1 {animation-timing-function: linear;}
#div2 {animation-timing-function: ease;}


/* Safari 4.0 - 8.0 */
@-webkit-keyframes mymove {
  from {left: 400px;}
  to {left: 1400px;}
}

/* Standard syntax */
@keyframes mymove {
  from {left: 400px;}
  to {left: 1400px;}
}
</style>
</head>

</html>