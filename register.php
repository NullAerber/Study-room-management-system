<?php

$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

//var_dump($username,$password,$password2);

if($password != $password2)
{
	exit("<p style='font-size:12pt;text-align:center'>两次密码不一样！<p>");
}

if($username == "")
{
    echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=register.html'>";
	echo("<p style='font-size:12pt;text-align:center'>错误信息<p>");
	exit("<p style='font-size:12pt;text-align:center'>用户名不能为空！<p>");
}

if($password == "")
{
    echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=register.html'>";
	echo("<p style='font-size:12pt;text-align:center'>错误信息<p>");
	exit("<p style='font-size:12pt;text-align:center'>密码不能为空！<p>");
}

//push cage
$host = "localhost";
$user = "root";
$password = "";
$dbname = "tms";
$connection = mysqli_connect($host,$user,$password,$dbname);

if(!$connection)
{
	echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=seatlist.php'>";
	exit("<p style='font-size:12pt;text-align:center'>连接mysql数据失败！<p>");
}

else
{	
	$sqluser = "SELECT * FROM `userinfo` WHERE `Username`='$username'";
	$resultuser = mysqli_query($connection,$sqluser);
	if($resultuser->num_rows > 0)
	{
		echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=register.html'>";
		exit("<p style='font-size:12pt;text-align:center'>用户名已经存在，注册失败！<p>");
	}
	
	$password = md5($password);
	$sql = "INSERT INTO `userinfo` (`Username`,`Password`,`Seat_state`,`Log_state`) VALUES ('$username','$password','0','1')";
	$result = mysqli_query($connection,$sql);
	
	if($result)
	{
		echo("<p style='font-size:12pt;text-align:center'>注册成功！<p>");
		echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=index.html'>";
	}
	
	else
	{
		echo("<p style='font-size:12pt;text-align:center'>注册失败！<p>");
		echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=register.html'>";
	}
}

mysqli_close($connection);

?>
