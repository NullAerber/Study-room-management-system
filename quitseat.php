<?php
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

if($resultuser->num_rows > 0)
{
	$rowuser = mysqli_fetch_array($resultuser);
	$username = $rowuser{"Username"};
	if($rowuser["Seat_state"] == '0')
	{
		echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=index.html'>";
		exit("<p style='font-size:12pt;text-align:center'>没有座位可以退还，退还失败！<p>");
	}
	
	$sqlone = "SELECT * FROM `seatone` WHERE `User` = '$username'";
	$resultone = mysqli_query($connection,$sqlone);
	$sqltwo = "SELECT * FROM `seattwo` WHERE `User` = '$username'";
	$resulttwo = mysqli_query($connection,$sqltwo);
	
	if($resultone->num_rows > 0)
	{
		$sqlupdate = "UPDATE `seatone` SET `User`='0',`Startdate`='0',`Enddate`='0' WHERE `User` = '$username'";
	    $resultupdate = mysqli_query($connection,$sqlupdate);
		$sqlupdateuser = "UPDATE `userinfo` SET `Seat_state`='0' WHERE `Log_state` = '1'";
	    $resultupdateuser = mysqli_query($connection,$sqlupdateuser);

        if($resultupdate && $resultupdateuser)
	    {
			echo("<p style='font-size:12pt;text-align:center'>退还座位成功！<p>");
	    }
	}
	
	if($resulttwo->num_rows > 0)
	{
		$sqlupdate = "UPDATE `seattwo` SET `User`='0',`Startdate`='0',`Enddate`='0' WHERE `User` = '$username'";
	    $resultupdate = mysqli_query($connection,$sqlupdate);
		$sqlupdateuser = "UPDATE `userinfo` SET `Seat_state`='0' WHERE `Log_state` = '1'";
	    $resultupdateuser = mysqli_query($connection,$sqlupdateuser);
		
        if($resultupdate && $resultupdateuser)
	    {
			echo("<p style='font-size:12pt;text-align:center'>退还座位成功！<p>");
	    }
	}
}

else
{
	echo("<p style='font-size:12pt;text-align:center'>退还座位失败！<p>");
}

echo "<META HTTP-EQUIV=REFRESH CONTENT='1;URL=index.html'>";

mysqli_close($connection);

?>
