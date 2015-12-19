<?php
$username = $_POST['username'];
$password = $_POST['password'];

if($password == "")
{
	echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=login.html'>";
	exit("<p style='font-size:12pt;text-align:center'>密码不能为空！<p>");
}

if($username == "")
{
	echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=login.html'>";
	exit("<p style='font-size:12pt;text-align:center'>用户名不能为空！<p>");
}

//link mysql
$host = "localhost";
$user = "root";
$password = "";
$dbname = "tms";
$connection = mysqli_connect($host,$user,$password,$dbname);

if($connection)
{
	$sql = "SELECT * FROM `userinfo` WHERE `Username`='$username' AND `Log_state`='1'";
	$result = mysqli_query($connection,$sql);
	if($result->num_rows > 0)
	{
		echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=login.html'>";
		exit("<p style='font-size:12pt;text-align:center'>用户名已经登录，登录失败！<p>");
	}

	$password = md5($password);
    $sql = "SELECT * FROM `userinfo` WHERE `Username` = '$username' AND `Password` = '$password'";
	$result = mysqli_query($connection,$sql);
	
	if($result->num_rows > 0)
	{
		$sqlupdate = "UPDATE `userinfo` SET `Log_state`=1 WHERE `Username` = '$username'";
		$resultupdate = mysqli_query($connection,$sqlupdate);
		if($resultupdate)
		{
			echo "<p style='font-size:12pt;text-align:center'>$username 登录成功！<p>";
			echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=index.html'>";
		}
	}
	
	else
	{
		echo("<p style='font-size:12pt;text-align:center'>用户不存在或者密码错误！<p>");
		echo("<p style='font-size:12pt;text-align:center'>登录失败！<p>");
		echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=login.html'>";
	}
}

mysqli_close($connection);

?>
