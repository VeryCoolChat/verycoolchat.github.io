<?php
if (isset($_GET['enSubmit']) && isset($_GET['uname']) && isset($_GET['rname'])){
	echo'<meta http-equiv="refresh" content="100000">';
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
<link rel="manifest" href="/manifest.json">
<!--Another head and style thing...-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset= utf-8"
<style>
</style>
</head>

<body OnLoad="document.myform.txt.focus()" style="font-family: sans-serif">
<form action="" method="post" name="myform">
<table align="left">
<tr>
<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: center;color: #2214B9; height: 80%; width: 100%;">
		
      </tr>
	<tr>

		<td style="font-family: sans-serif;font-size: 17pt;text-align: center; color: #2214B9;">
		<div style="height:70%;" id="hehe">	<textarea readonly="readonly" id="btw" name="txtchat" style="width: 100%; color: white; height: 500px; background-color: navy; font-family: 'times New Roman', Times, serif; font-size: 12pt;"><?php echo " $room &#13;&#10;&#13;&#10;\n$contents"?> </textarea></div>
		</td>
	</tr>
	<tr>
	<div style="width:100%;">
		
	</div>
	</tr>
</table>
</form>



 
<?php
}else {
?>
<form method="get" action="">

<div class="pizza">
<table style="border: 1px solid #000000;width: 100%; height: 100%;" align="center">
<center>ADMIN CHANGING ANNOUNCEMENTS' PAGE</center>
	<tr>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: left; width: 432px; color: #2214B9;;border-style: solid;border-width: 1px;">Date of corresponding announcement:</td>
		<td style="border-style: solid; border-width: 1px; font-family: 'Times New Roman', Times, serif; font-size: 17pt; text-align: left; color: #2214B9; width: 430px;">
		<input type="date" id="nickname" name="uname" style="font-size: medium; width: 260px; color: #B01919;" required></td>
	</tr>
	<tr>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: left; width: 432px; color: #2214B9;border-style: solid;border-width: 1px;">Select Room:</td>
		<td style="border-style: solid; border-width: 1px; font-family: 'Times New Roman', Times, serif; font-size: 17pt; text-align: left; color: #2214B9; width: 430px;">
		<select name="rname" style="width: 260px; font-size: medium; color: #B01919;">
		<option selected="">ANNOUNCEMENTS</option>
		
		</select></td>
	</tr>
	<tr>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: center; color: #2214B9; border-left-style: solid; border-left-width: 1px; border-right-style: none; border-right-width: medium; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px; padding-top:10px;padding-bottom:10px" colspan="2">
		<input name="enSubmit" style="width: 118px; height: 63px; font-size: 30pt; font-family: 'Times New Roman', Times, serif; color: #19B024;" type="submit" onclick="store()" value="Enter" ></td>
	</tr>
</table>
</form>

</div>
<div class="ad1">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Something placed over here </div>
<div class="ad2">          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Something placed over here </div>
<?php
}
?>


<head>
<title> Chat room </title>
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
  top: 10;
  background-color: lightyellow;
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

</style>
</head>

</html>