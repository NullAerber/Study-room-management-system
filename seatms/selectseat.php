<?php
$fullid = $_POST['fullid'];
$enddate = $_POST['enddate'];
$startdate = date('Y-m-d H:i:s',strtotime("+7 hours"));

$id = str_split($fullid,2);
$roomid = $id[0];
$seatid = $id[1];

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


$sqluser = "SELECT * FROM `userinfo` WHERE `Log_state` = '1'";
$resultuser = mysqli_query($connection,$sqluser);

if($resultuser->num_rows == 1)
{
	$rowuser = mysqli_fetch_array($resultuser);
	$username = $rowuser["Username"];
	if($roomid == '01')
    {
		$sqlone = "SELECT * FROM `seatone` WHERE `Id`='$seatid' AND `User`!='0'";
		$resultone = mysqli_query($connection,$sqlone);
		if($resultone->num_rows > 0)
		{
			echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=seatone.php'>";
			exit("<p style='font-size:12pt;text-align:center'>座位已经被申请，请重新选择！<p>");
		}
		
		$sqlupdate = "UPDATE `userinfo` SET `Seat_state`='1' WHERE `Username`='$username'";//在userinfo表中把Seat_state标记为已经占座
		$resultupdate = mysqli_query($connection,$sqlupdate);
		$sqlupdateone = "UPDATE `seatone` SET `User`='$username',`Startdate`='$startdate',`enddate`='$enddate' WHERE `Id` = '$seatid'";//在seatone表中把占座的用户名填上，把时间填上
		$resultupdateone = mysqli_query($connection,$sqlupdateone);

		if($resultupdate && $resultupdateone)
		{
			echo("<p style='font-size:12pt;text-align:center'>提交座位申请成功！<p>");
		}
    }
	
	if($roomid == '02')
    {
		$sqltwo = "SELECT * FROM `seattwo` WHERE `Id`='$seatid' AND `User`!='0'";
		$resulttwo = mysqli_query($connection,$sqltwo);
		if($resulttwo->num_rows > 0)
		{
			echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=seattwo.php'>";
			exit("<p style='font-size:12pt;text-align:center'>座位已经被申请，请重新选择！<p>");
		}

		$sqlupdate = "UPDATE `userinfo` SET `Seat_state`='1' WHERE `Username`='$username'";//在userinfo表中把Seat_state标记为已经占座
		$resultupdate = mysqli_query($connection,$sqlupdate);
		$sqlupdatetwo = "UPDATE `seattwo` SET `User`='$username',`Startdate`='$startdate',`enddate`='$enddate' WHERE `Id` = '$seatid'";//在seatone表中把占座的用户名填上，把时间填上
		$resultupdatetwo = mysqli_query($connection,$sqlupdatetwo);

		if($resultupdate && $resultupdatetwo)
		{
			echo("<p style='font-size:12pt;text-align:center'>提交座位申请成功！<p>");
		}
    }
	echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=index.html'>";
}

else if($resultuser->num_rows > 1)
{
	echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=index.html'>";
	echo("<p style='font-size:12pt;text-align:center'>多人登录，请注销后重新登录！<p>");
	exit("<p style='font-size:12pt;text-align:center'>提交座位申请失败！<p>");
}
else
{
	echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=login.html'>";
	echo("<p style='font-size:12pt;text-align:center'>未登录！<p>");
	exit("<p style='font-size:12pt;text-align:center'>提交座位申请失败！<p>");
}
mysqli_close($connection);

?>