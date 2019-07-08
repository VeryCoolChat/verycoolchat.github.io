<?php
if (isset($_GET['enSubmit']) && isset($_GET['uname']) && isset($_GET['rname'])){
	echo'<meta http-equiv="refresh" content="1000000000000000000">';
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
<meta http-equiv="Content-Type" content="text/html; charset= utf-8">

<script>

function myFunction(){
	alert("testing123");
};

</script>

</head>
<body OnLoad="document.myform.txt.focus()" style="font-family: sans-serif">
<form action="" method="post" name="myform">
<table style=";width: 752px" align="center">
	<tr>
		<td style="font-family: sans-serif;font-size: 17pt;text-align: center;width: 537; color: #2214B9;border-style: solid;border-width: 1px; height: 350px;">
		<div id="hehe">	<textarea readonly="readonly" name="txtchat" style="width: 581px; color: #000000; height: 365px; background-color: #F4F8D1; font-family: 'times New Roman', Times, serif; font-size: 12pt;"><?php echo "Welcome to the $room chatroom... (Remember to be sweet and short, or else the device will know- and your message will be deleted.)&#13;&#10;&#13;&#10;\n$contents"?> </textarea></div>
		</td>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: center;color: #2214B9;border-style: solid;border-width: 1px; height: 349px; width: 143px;">
			<textarea readonly="readonly" contenteditable="true" overflow="true" name="txtusers" style=";width: 163px; height: 365px; background-color: #D1F8D8; font-family: 'times New Roman', Times, serif; font-size: 12pt; font-weight: bold; text-align: center;">Users Online:&#13;&#10;<?php echo $users?></textarea></td>
	</tr>
	<tr>
		<td style="width: 537; border-style: solid;border-width: 1px;text-align: left; height: 39px; font-size: 14pt;">
		<textarea id="time" contentEditable="false" id="myInput" id="txtt"  name="txt" style="width: 581px; height: 99px; font-family: 'times New Roman', Times, serif; font-size: 12pt"></textarea></td>
		<td style="border-style: solid;border-width: 1px; height: 39px;padding-left: 8px; width: 143px; text-align: center;">
		<input  id="myBtn" name="Send" style="width: 118px; height: 63px; font-size: 30pt; font-family: 'Times New Roman', Times, serif; color: #19B024;" type="submit" value="Send">
        </td>
	</tr>
</table>
</form>

<div class="orange">
<button onclick="window.location.href = 'https://ickyalphanumericwebpages.roycea.repl.co';" style="font-size:24px; top: 1%;left:1%; position: fixed;"> <i class="fa fa-hand-o-left"></i></button>

 
<?php
}else {
?>
<form method="get" action="">


<div id="royce" style="background-color: lightyellow; color: red; height: 5%; width: 100%; position: fixed; bottom: 0; font-size: 20px;">
<center>

Notice: Changes are still being done, from CSS Edits to PHP backserver changes, Sorry for the inconvenience.</center>


</div>
<table style="border: 1px solid #000000;width: 452px" align="center">
	<tr>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: left; width: 432px; color: #2214B9;;border-style: solid;border-width: 1px;">Nick Name:</td>
		<td style="border-style: solid; border-width: 1px; font-family: 'Times New Roman', Times, serif; font-size: 17pt; text-align: left; color: #2214B9; width: 430px;">
		<input name="uname" style="font-size: medium; width: 260px; color: #B01919;" required></td>
	</tr>
	<tr>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: left; width: 432px; color: #2214B9;border-style: solid;border-width: 1px;">Select Room:</td>
		<td style="border-style: solid; border-width: 1px; font-family: 'Times New Roman', Times, serif; font-size: 17pt; text-align: left; color: #2214B9; width: 430px;">
		<select name="rname" style="width: 260px; font-size: medium; color: #B01919;">
		<option selected="">Group 1</option>
		<option>Group 2</option>
		</select></td>
	</tr>
	<tr>
		<td style="font-family: 'Times New Roman', Times, serif;font-size: 17pt;text-align: center; color: #2214B9; border-left-style: solid; border-left-width: 1px; border-right-style: none; border-right-width: medium; border-top-style: solid; border-top-width: 1px; border-bottom-style: solid; border-bottom-width: 1px; padding-top:10px;padding-bottom:10px" colspan="2">
		<input name="enSubmit" style="width: 118px; height: 63px; font-size: 30pt; font-family: 'Times New Roman', Times, serif; color: #19B024;" type="submit" value="Enter"></td>
	</tr>
</table>
</form>
<?php
}
?>


<head>
<meta http-equiv="Page-Enter" content="blendTrans(Duration=0.2)">
<meta http-equiv="Page-Exit" content="blendTrans(Duration=0.2)">
<title> Chat room </title>
<link rel="icon" type="image/ico" href="images/oof.png" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
var input = document.getElementById("myInput");
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

</body>